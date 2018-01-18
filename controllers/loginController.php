<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 17/01/2018
 * Time: 15:04
 */

class loginController extends Controller
{
    private $_login;
    public function __construct()
    {
        parent::__construct();
        $this->_login=$this->loadModel('login');
    }

    public function index()
    {
        //$this->_view->setJs(array('maruti.login'));
        $this->_view->titulo= 'Inicio de Sesión';
        $this->_view->tagline = APP_SLOGAN;
        $this->_view->company = APP_COMPANY;

        if($this->getInt('enviar')==1){
            $this->datos=$_POST;

            $row = $this->_login->getLogin('mUsuario','mPassword');
            if(!$row){
                $this->_view->_error = 'Usuario y/o Contraseña incorrecto.';
                exit;
            }
            else{
                Sessions::set('level',$row['nombre']);
                Sessions::set('tiempo',time());
                $this->redireccionar('index');
            }
        }

        $this->_view->renderizar('index');
    }
    public function mostrar(){
        echo 'Nivel: '.Sessions::get('level') . '<br>';
        echo 'Estado: '.Sessions::get('autenticado') . '<br>';
    }
    public function logout(){
        Sessions::destroy();
        $this->redireccionar();
    }
}