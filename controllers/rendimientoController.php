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
        $this->_view->rendimientos= $this->_rendimientos->getRendimientos();
        $this->_view->titulo=APP_NAME;
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company='Rendimiento';
        $this->_view->renderizar('index');
    }

    public function nuevo(){
        //$this->_view->setJs(array('nuevo'));
        $this->_view->titulo="Rendimiento";
        if($this->getInt('guardar')==1)
        {
            $this->_view->datos=$_POST;
            if(!$this->getTexto('correo'))
            {
                $this->_view->_error='Registre un correo válido';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getTexto('pnombre'))
            {
                $this->_view->_error='Primer nombre es obligatorio.';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getTexto('papellido'))
            {
                $this->_view->_error='Primer apellido es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
                exit;
            }
            if(!$this->getTexto('cedula'))
            {
                $this->_view->_error='El documento de identidad es obligatorio';
                $this->_view->renderizar('nuevo','rendimiento');
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
        $this->_view->renderizar('nuevo','rendimiento');
    }
}