<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 16/11/2017
 * Time: 23:59
 */
define ('DS', DIRECTORY_SEPARATOR);
define ('ROOT', realpath(dirname(__FILE__)). DS );
define ('APP_PATH',ROOT.'application'.DS);
error_reporting(0);

require_once  APP_PATH . 'Config.php';
require_once  APP_PATH . 'Request.php';
require_once  APP_PATH . 'Controller.php';
require_once  APP_PATH . 'Model.php';
require_once  APP_PATH . 'Registro.php';
require_once  APP_PATH . 'View.php';
require_once  APP_PATH . 'Bootstrap.php';
require_once  APP_PATH . 'Database.php';

try{
    Bootstrap::run( new Request);
}
catch (Exception $e){
    echo $e->getMessage();
}