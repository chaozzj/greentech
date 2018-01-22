<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 21/01/2018
 * Time: 21:47
 */

class configuracionController extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        Sessions::acceso('Administrador');
        $this->_view->titulo = APP_NAME;
        $this->_view->tagline = APP_SLOGAN;
        $this->_view->company = 'Configuraciónes';
        $this->_view->renderizar('index');
    }

    public function maquinas(){
        Sessions::acceso('Administrador');

        $this->_view->setJs(array('nuevo'));

        $this->_view->titulo="Agregar Desperdicio";
        $this->_view->maquinas = $this->_desperdicio->getMaquinas();
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company=APP_COMPANY;
        if($this->getInt('guardar')==1)
        {
            $this->_view->datos=$_POST;
            if(!$this->getInt('mTurno'))
            {
                $this->_view->_error='Registre un turno válido';
                $this->_view->renderizar('maquinas','configuracion');
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

            $this->redireccionar('configuracion/maquinas');
        }
        $this->_view->renderizar('maquinas','configuracion');

    }
}