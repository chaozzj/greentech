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
        $this->_view->desperdicio = $this->_desperdicio->getDesperdicio();
        $this->_view->titulo = APP_NAME;
        $this->_view->tagline = APP_SLOGAN;
        $this->_view->company = 'Desperdicio';
        $this->_view->renderizar('index');
    }


    public function nuevo(){
        $this->_view->setJs(array('nuevo'));

        $this->_view->titulo="Agregar Desperdicio";
        $this->_view->maquinas = $this->_desperdicio->getMaquinas();
        $this->_view->operador = $this->_desperdicio->getOperadores();
        $this->_view->fincas = $this->_desperdicio->getFincas();
        $this->_view->variedad = $this->_desperdicio->getVariedades();
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