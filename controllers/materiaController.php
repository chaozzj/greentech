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
            if(!$this->getInt('mCosechado'))
            {
                $this->_view->_error='Cosechando es obligatorio.';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }
            if(!$this->getInt('mGirando'))
            {
                $this->_view->_error='Girando es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }
            if(!$this->getInt('mVolquete'))
            {
                $this->_view->_error='Sin Volquete es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }

            if(!$this->getInt('mTransporte'))
            {
                $this->_view->_error='Transporte es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }

            if(!$this->getInt('mReparacion'))
            {
                $this->_view->_error='Reparación es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }

            if(!$this->getInt('mRevision'))
            {
                $this->_view->_error='Revisión es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }

            if(!$this->getInt('mDistraido'))
            {
                $this->_view->_error='Distraido es obligatorio';
                $this->_view->renderizar('nuevo','materia');
                exit;
            }
            $this->_materias->insertarMateria(
                $this->getInt('mDia'),
                $this->getInt('mCosechado'),
                $this->getInt('mGirando'),
                $this->getInt('mVolquete'),
                $this->getInt('mTransporte'),
                $this->getInt('mReparacion'),
                $this->getInt('mRevision'),
                $this->getInt('mDistraido')
            );

            $this->_view->renderizar('nuevo','materia');
        }
        $this->_view->renderizar('nuevo','materia');
    }
}