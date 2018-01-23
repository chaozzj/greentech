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
        $this->_view->_error= '';
        //$niveluser;
        if($this->getInt('enviar')==1){
            $this->_view->datos=$_POST;
            if(!$this->getAlphaNum('mUsuario')){
                $this->_view->_error='Usuario no válido';
                $this->_view->renderizar('index','login');
                exit;
            }
            if(!$this->getSql('mPassword')){
                $this->_view->_error='Contraseña no válida';
                $this->_view->renderizar('index','login');
                exit;
            }

            /*while($row = $this->_login->getUser(
                $this->getAlphaNum('mUsuario'),
                $this->getSql('mPassword'))->fetch_array()){
                $niveluser=$row['nombre'];
            }*/
            /*if(($this->_login->getUser($this->getAlphaNum('mUsuario'),
                $this->getSql('mPassword')))){
                Sessions::set('autenticado',true);
                Sessions::set('tiempo',time());

            }else{
                $this->_view->_error = 'Usuario y/o Contraseña incorrecto.' . $this->getSql('mPassword') ;
                $this->_view->renderizar('index', 'login');
                exit;
            }*/
            $this->_login->getUser(
                $this->getAlphaNum('mUsuario'),
                $this->getSql('mPassword'));

            if(!Sessions::get('level')){
                $this->_view->_error = 'Usuario y/o Contraseña incorrecto.' . $this->getSql('mPassword') ;
                $this->_view->renderizar('index', 'login');
                exit;
            }
            /*if(!$row){
                $this->_view->_error = 'Usuario y/o Contraseña incorrecto.';
                $this->_view->renderizar('index', 'login');
                //exit;
            }*/
            Sessions::set('autenticado',true);
            //Sessions::set('level',$niveluser);
            //Sessions::set('level',$row['nombre']);
            Sessions::set('tiempo',time());
            $this->redireccionar('index');
            //print_r($_SESSION);
        }

        $this->_view->renderizar('index','login');
    }
    public function mostrar(){
        echo 'Nivel: '.Sessions::get('level') . '<br>';
        echo 'Estado: '.Sessions::get('autenticado') . '<br>';
        echo 'Conect: '.Sessions::get('error') . '<br>';
    }
    public function logout(){
        Sessions::destroy();
        $this->redireccionar();
    }
}