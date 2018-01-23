<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 15/01/2018
 * Time: 15:26
 */
class materiaController extends Controller
{
    private $_materias;
    public function __construct()
    {
        parent::__construct();
        $this->_materias=$this->loadModel('materia');
    }
    public function index(){
        Sessions::acceso('Digitador');
        $this->_view->materias= $this->_materias->getMaterias();

        $this->_view->titulo=APP_NAME;
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company='Materia Extraña';
        $this->_view->renderizar('index');
    }
    public function upload(){
        Sessions::acceso('Administrador');
        $this->_view->_error='';
        $this->_view->titulo=APP_NAME;
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company='Materia';

        if($this->getInt('guardar')==1){
            if (empty($_FILES['mArchivo']['name'])){
                $this->_view->_error='Seleccione Archivo';
                $this->_view->renderizar('upload','materia');
                exit;
            }
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $binario_contenido =  mysqli_real_escape_string($con,(file_get_contents($_FILES['mArchivo']['tmp_name'])));
            $binario_nombre=$_FILES['mArchivo']['name'];
            $binario_tipo=$_FILES['mArchivo']['type'];
            $titulo= $_POST['mTitulo'];
            //$this->_view->_error=  $binario_nombre.' ' .$binario_tipo . ' ' .$binario_contenido;

            $this->_materias->insertarArchivo(
                $binario_nombre,
                $titulo,
                $binario_contenido,
                $binario_tipo
            );

            $this->redireccionar('materia');
        }
        $this->_view->renderizar('upload');
    }
    public function nuevo(){
        Sessions::acceso('Digitador');
        $this->_view->setJs(array('nuevo'));

        $this->_view->titulo="Agregar Materia Extraña";
        $this->_view->maquinas = $this->_materias->getMaquinas();
        $this->_view->operador = $this->_materias->getOperadores();
        $this->_view->fincas = $this->_materias->getFincas();
        $this->_view->variedad = $this->_materias->getVariedades();
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company=APP_COMPANY;

        if($this->getInt('guardar')==1)
        {
            Sessions::acceso('Digitador');
            $this->_view->datos=$_POST;
            if(!$this->getInt('mDia'))
            {
                $this->_view->_error='Registre un dia válido';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }
            /*if(!$this->getDec('mCepa'))
            {
                $this->_view->_error='Cepa es obligatorio.';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }
            if(!$this->getDec('mTierra'))
            {
                $this->_view->_error='Tierra es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }
            if(!$this->getDec('mPeso'))
            {
                $this->_view->_error='Peso es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }
            if(!$this->getDec('mHojas'))
            {
                $this->_view->_error='Hojas es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }

            if(!$this->getDec('mRaices'))
            {
                $this->_view->_error='Raices es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }*/

            $this->_materias->insertarMateria(
                $this->getInt('mDia'),
                $this->getInt('mMaquina'),
                $this->getInt('mOperador'),
                $this->getInt('mFinca'),
                $this->getInt('mVariedad'),
                $this->getDec('mPeso'),
                $this->getDec('mCepa'),
                $this->getDec('mTierra'),
                $this->getDec('mHojas'),
                $this->getDec('mRaices')
            );

            $this->_view->datos['mPeso']=0;
            $this->_view->datos['mCepa']=0;
            $this->_view->datos['mTierra']=0;
            $this->_view->datos['mHojas']=0;
            $this->_view->datos['mRaices']=0;

            $this->_view->renderizar('nuevo','materia');
        }
        $this->_view->renderizar('nuevo','materia');
    }
    public function download(){
        Sessions::acceso('Gerente');
        $this->_view->desperdiciofile = $this->_materias->getFilesMateria();
        $this->_view->titulo = APP_NAME;
        $this->_view->tagline = APP_SLOGAN;
        $this->_view->company = 'Materia Extraña';
        $this->_view->renderizar('download');
    }
    public function getfile($id){
        Sessions::acceso('Gerente');

        if(!$this->filtrarInt($id))
        {
            $this->redireccionar('materia/download');
        }

        $filedata = $this->_materias->getFileMateria($this->filtrarInt($id));
        $type = $filedata['tipo'];
        $file= $filedata['titulo'];
        header("Content-type: $type");
        header("Content-Disposition: attachment; filename=$file");
        echo $filedata['contenido'];
    }
}