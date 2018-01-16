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
        $this->_view->materias= $this->_materias->getMaterias();

        $this->_view->titulo=APP_NAME;
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company='Materia Extraña';
        $this->_view->renderizar('index');
    }

    public function nuevo(){
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
            $this->_view->datos=$_POST;
            if(!$this->getInt('mDia'))
            {
                $this->_view->_error='Registre un dia válido';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }

            if(!$this->getDec('mCepa'))
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
            }

            $this->_materias->insertarMateria(
                $this->getInt('mDia'),
                $this->getInt('mMaquina'),
                $this->getInt('mOperador'),
                $this->getInt('mFinca'),
                $this->getInt('mVariedad'),
                $this->getDec('mCepa'),
                $this->getDec('mTierra'),
                $this->getDec('mHojas'),
                $this->getDec('mRaices')
            );

            $this->_view->renderizar('nuevo','materia');
        }
        $this->_view->renderizar('nuevo','materia');
    }
}