<?php
/**
 * Created by PhpStorm.
 * User: Angel de Jesus Lopez
 * Date: 15/01/2018
 * Time: 16:52
 */

class desperdicioController extends Controller
{
    private $_desperdicio;

    public function __construct()
    {
        parent::__construct();
        $this->_desperdicio = $this->loadModel('desperdicio');
    }

    public function index()
    {
        Sessions::acceso('Digitador');
        $this->_view->desperdicio = $this->_desperdicio->getDesperdicio();
        $this->_view->titulo = APP_NAME;
        $this->_view->tagline = APP_SLOGAN;
        $this->_view->company = 'Desperdicio';
        $this->_view->renderizar('index');
    }
    public function upload(){
        Sessions::acceso('Administrador');
        $this->_view->_error='';
        $this->_view->titulo=APP_NAME;
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company='Desperdicio';

        if($this->getInt('guardar')==1){
            if (empty($_FILES['mArchivo']['name'])){
                $this->_view->_error='Seleccione Archivo';
                $this->_view->renderizar('upload','desperdicio');
                exit;
            }
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $binario_contenido =  mysqli_real_escape_string($con,(file_get_contents($_FILES['mArchivo']['tmp_name'])));
            $binario_nombre=$_FILES['mArchivo']['name'];
            $binario_tipo=$_FILES['mArchivo']['type'];
            $titulo= $_POST['mTitulo'];
            //$this->_view->_error=  $binario_nombre.' ' .$binario_tipo . ' ' .$binario_contenido;

            $this->_desperdicio->insertarArchivo(
                $binario_nombre,
                $titulo,
                $binario_contenido,
                $binario_tipo
            );

            $this->redireccionar('desperdicio');
        }
        $this->_view->renderizar('upload');
    }
    public function nuevo(){
        Sessions::acceso('Digitador');

        $this->_view->setJs(array('nuevo'));

        $this->_view->titulo="Agregar Desperdicio";
        $this->_view->maquinas = $this->_desperdicio->getMaquinas();
        $this->_view->operador = $this->_desperdicio->getOperadores();
        $this->_view->fincas = $this->_desperdicio->getFincas();
        $this->_view->variedad = $this->_desperdicio->getVariedades();
        $this->_view->turnos = $this->_desperdicio->getTurnos();
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company=APP_COMPANY;
        if($this->getInt('guardar')==1)
        {
            $this->_view->datos=$_POST;
            if(!$this->getInt('mTurno'))
            {
                $this->_view->_error='Registre un turno válido';
                $this->_view->renderizar('nuevo','desperdicio');
                exit;
            }
            if(!$this->getDec('mTocones'))
            {
                $this->_view->_error='Toccones es obligatorio.';
                $this->_view->renderizar('nuevo','desperdicio');
                exit;
            }
            if(!$this->getDec('mCañaL'))
            {
                $this->_view->_error='Caña Larga es obligatorio';
                $this->_view->renderizar('nuevo','desperdicio');
                exit;
            }
            if(!$this->getDec('mCañaPic'))
            {
                $this->_view->_error='Caña Picada es obligatorio';
                $this->_view->renderizar('nuevo','desperdicio');
                exit;
            }

            if(!$this->getDec('mPuntas'))
            {
                $this->_view->_error='Puntas es obligatorio';
                $this->_view->renderizar('nuevo','desperdicio');
                exit;
            }

            if(!$this->getDec('mRendimiento'))
            {
                $this->_view->_error='Rendimiento es obligatorio';
                $this->_view->renderizar('nuevo','desperdicio');
                exit;
            }
            $this->_desperdicio->insertarDesperdicio(
                $this->getInt('mDia'),
                $this->getInt('mMaquina'),
                $this->getInt('mOperador'),
                $this->getInt('mTurno'),
                $this->getInt('mFinca'),
                $this->getInt('mVariedad'),
                $this->getDec('mTocones'),
                $this->getDec('mCañaL'),
                $this->getDec('mCañaPic'),
                $this->getDec('mPuntas'),
                $this->getDec('mRendimiento')
            );

            $this->redireccionar('desperdicio');
        }
        $this->_view->renderizar('nuevo','desperdicio');

    }
}