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
        $this->_view->desperdicio = $this->_desperdicio->getdesperdicio();
        $this->_view->titulo = APP_NAME;
        $this->_view->tagline = APP_SLOGAN;
        $this->_view->company = 'Desperdicio';
        $this->_view->renderizar('index');
    }


    public function nuevo(){
        $this->_view->setJs(array('nuevo'));

        $this->_view->titulo="Agregar Rendimiento";
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company=APP_COMPANY;
        if($this->getInt('guardar')==1)
        {
            $this->_view->datos=$_POST;
            if(!$this->getInt('Turno'))
            {
                $this->_view->_error='Registre un dia válido';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getInt('mTocones'))
            {
                $this->_view->_error='Toccones es obligatorio.';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getInt('mCañaL'))
            {
                $this->_view->_error='Caña Larga es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getInt('mCañaPic'))
            {
                $this->_view->_error='Caña Picada es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }

            if(!$this->getInt('mPuntas'))
            {
                $this->_view->_error='Puntas es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }

            if(!$this->getInt('mRendimiento'))
            {
                $this->_view->_error='Rendimiento es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }

            $this->redireccionar('rendimiento');
        }
        $this->_view->renderizar('nuevo','rendimiento');
    }

    public function nuevo()
    {
        //$this->_view->setJs(array('nuevo'));
        $this->_view->titulo = "Desperdicio";
        if ($this->getInt('guardar') == 1) {
            $this->_view->datos = $_POST;
            if (!$this->getTexto('correo')) {
                $this->_view->_error = 'Registre un correo válido';
                $this->_view->renderizar('nuevo', 'desperdicio');
                exit;
            }
            if (!$this->getTexto('pnombre')) {
                $this->_view->_error = 'Primer nombre es obligatorio.';
                $this->_view->renderizar('nuevo', 'desperdicio');
                exit;
            }
            if (!$this->getTexto('papellido')) {
                $this->_view->_error = 'Primer apellido es obligatorio';
                $this->_view->renderizar('nuevo', 'desperdicio');
                exit;
            }
            if (!$this->getTexto('cedula')) {
                $this->_view->_error = 'El documento de identidad es obligatorio';
                $this->_view->renderizar('nuevo', 'desperdicio');
                exit;
            }

            $this->_usuarios->insertarUsuario(
                $this->getTexto('correo'),
                $this->getTexto('pnombre'),
                $this->getTexto('snombre'),
                $this->getTexto('papellido'),
                $this->getTexto('sapellido'),
                $this->getInt('msexo'),
                $this->getTexto('cedula')
            );

            $this->redireccionar('usuarios');
        }
        $this->_view->renderizar('nuevo', 'desperdicio');
    }
}