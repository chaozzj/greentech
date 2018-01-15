<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 17/11/2017
 * Time: 00:15
 */
abstract class Controller
{
    protected $_view;

    public function __construct()
    {
        $this->_view= new View(new Request());
    }

    abstract public function index();

    protected function loadModel($modelo){
        $modelo= $modelo.'Model';
        $rutaModel= ROOT. 'models'.DS.$modelo.'.php';
        if(is_readable($rutaModel)){
            require_once $rutaModel;
            $modelo = new $modelo;
            return $modelo;
        }
        else{
            throw new Exception('Error de Modelo');
        }
    }

    protected function getLibrary($libreria)
    {
        $rutaLibreria= ROOT_PATH.'libs'.DS.$libreria.'.php';

        if(is_readable($rutaLibreria))
        {
            require_once $rutaLibreria;
        }
        else
        {
            throw new Exception('Error, Library not found');
        }
    }
    /*Funciones que validan por POST*/
    protected function getTexto($valor)
    {
        if(isset($_POST[$valor])&&!empty($_POST[$valor]))
        {
            $_POST[$valor]=htmlspecialchars($_POST[$valor],ENT_QUOTES);
            return $_POST[$valor];
        }
        return'';
    }

    protected function getInt($valor)
    {
        if(isset($_POST[$valor])&&!empty($_POST[$valor]))
        {
            $_POST[$valor]=filter_input(INPUT_POST,$valor,FILTER_VALIDATE_INT);
            return $_POST[$valor];
        }
        return 0;
    }
    /*Funciones por metodo GET*/
    protected  function filtrarInt($int)
    {
        $int=(int) $int;
        if(is_int($int)){
            return $int;
        }
        else{
            return 0;
        }
    }
    /*Funcion para redireccionamiento*/
    protected function redireccionar($ruta=false)
    {
        if($ruta)
        {
            header('location:'.BASE_URL.$ruta);
            exit;
        }
        else
        {
            header('location:'.BASE_URL);
            exit;
        }
    }
}