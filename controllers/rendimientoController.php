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
}