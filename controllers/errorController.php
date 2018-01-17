<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 17/01/2018
 * Time: 13:59
 */
class errorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->_view->titulo= 'Error';
        $this->_view->mensaje=$this->_getError();
        $this->_view->renderizar('index');
    }
    private function _getError($codigo = false){
        if($codigo){
            $codigo=$this->filtrarInt($codigo);
            if(is_int($codigo)){
                $codigo= $codigo;
            }
        } else{
            $codigo ='default';
        }

        $error['default']="Ha ocurrido un error y la plataforma no puede completar la solicitud";
        $error['5050']="Acceso Retringido";
        if(array_key_exists($codigo,$error)){
            return $error[$codigo];
        }else{
            return $error['default'];
        }
    }
}