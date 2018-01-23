<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 15/01/2018
 * Time: 15:26
 */
class rendimientoController extends Controller
{
    private $_rendimientos;
    public function __construct()
    {
        parent::__construct();
        $this->_rendimientos=$this->loadModel('rendimiento');
    }

    public function index(){
        Sessions::acceso('Digitador');
        $this->_view->rendimientos= $this->_rendimientos->getRendimientos();
        $this->_view->titulo=APP_NAME;
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company='Rendimiento';
        $this->_view->renderizar('index');
    }
    public function upload(){
        Sessions::acceso('Administrador');
        $this->_view->_error='';
        $this->_view->titulo=APP_NAME;
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company='Rendimiento';

        if($this->getInt('guardar')==1){
            if (empty($_FILES['mArchivo']['name'])){
                $this->_view->_error='Seleccione Archivo';
                $this->_view->renderizar('upload','rendimiento');
                exit;
            }
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $binario_contenido =  mysqli_real_escape_string($con,(file_get_contents($_FILES['mArchivo']['tmp_name'])));
            $binario_nombre=$_FILES['mArchivo']['name'];
            $binario_tipo=$_FILES['mArchivo']['type'];
            $titulo= $_POST['mTitulo'];
            //$this->_view->_error=  $binario_nombre.' ' .$binario_tipo . ' ' .$binario_contenido;

            $this->_rendimientos->insertarArchivo(
                $binario_nombre,
                $titulo,
                $binario_contenido,
                $binario_tipo
            );

            $this->redireccionar('rendimiento');
        }
        $this->_view->renderizar('upload');
    }
    public function nuevo(){
        Sessions::acceso('Digitador');

        $this->_view->setJs(array('nuevo'));

        $this->_view->titulo="Agregar Rendimiento";
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company=APP_COMPANY;
        if($this->getInt('guardar')==1)
        {
            $this->_view->datos=$_POST;
            if(!$this->getInt('mDia'))
            {
                $this->_view->_error='Registre un dia válido';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getInt('mCosechado'))
            {
                $this->_view->_error='Cosechando es obligatorio.';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getInt('mGirando'))
            {
                $this->_view->_error='Girando es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getInt('mVolquete'))
            {
                $this->_view->_error='Sin Volquete es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }

            if(!$this->getInt('mTransporte'))
            {
                $this->_view->_error='Transporte es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }

            if(!$this->getInt('mReparacion'))
            {
                $this->_view->_error='Reparación es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }

            if(!$this->getInt('mRevision'))
            {
                $this->_view->_error='Revisión es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }

            if(!$this->getInt('mDistraido'))
            {
                $this->_view->_error='Distraido es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            $this->_rendimientos->insertarRendimiento(
                $this->getInt('mDia'),
                $this->getInt('mCosechado'),
                $this->getInt('mGirando'),
                $this->getInt('mVolquete'),
                $this->getInt('mTransporte'),
                $this->getInt('mReparacion'),
                $this->getInt('mRevision'),
                $this->getInt('mDistraido')
            );

            $this->redireccionar('rendimiento');
        }
        $this->_view->renderizar('nuevo','rendimiento');
    }
    public function download(){
        Sessions::acceso('Gerente');
        $this->_view->desperdiciofile = $this->_rendimientos->getFilesRendimiento();
        $this->_view->titulo = APP_NAME;
        $this->_view->tagline = APP_SLOGAN;
        $this->_view->company = 'Rendimiento';
        $this->_view->renderizar('download');
    }
    public function getfile($id){
        Sessions::acceso('Gerente');

        if(!$this->filtrarInt($id))
        {
            $this->redireccionar('rendimiento/download');
        }

        $filedata = $this->_rendimientos->getFileRendimiento($this->filtrarInt($id));
        $type = $filedata['tipo'];
        $file= $filedata['titulo'];
        header("Content-type: $type");
        header("Content-Disposition: attachment; filename=$file");
        echo $filedata['contenido'];
    }
}