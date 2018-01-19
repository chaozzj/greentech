<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 17/01/2018
 * Time: 13:47
 */
class Sessions{
    public static function init(){
        session_start();
    }
    public static function destroy($clave = false){
        if($clave){
            if(is_array($clave)){
                for($i =0; $i<count($clave);$i++){
                    if(isset($_SESSION[$clave[$i]])){
                        unset($_SESSION[$clave[$i]]);
                    }
                }
            }else{
                if(isset($_SESSION[$clave])){
                    unset($_SESSION[$clave]);
                }
            }
        }
        else{
            session_destroy();
        }
    }
    public static function set($clave, $valor){
        if(!empty($clave)){
            $_SESSION[$clave]= $valor;
        }
    }
    public static function get($clave){
        if(isset($_SESSION[$clave])){
            return $_SESSION[$clave];
        }
    }
    public static function acceso($level){
        if(!Sessions::get('autenticado')){
            header('location: '. BASE_URL .'error/access/5050');
            exit;
        }

        Sessions::tiempo();

        if(Sessions::getLevel($level)>Sessions::getLevel(Sessions::get('level'))){
            header('location: '. BASE_URL .'error/access/5050');
            exit;
        }
    }
    public static function accesoView($level){
        if(!Sessions::get('autenticado')){
            return false;
        }
        if(Sessions::getLevel($level)>Sessions::getLevel(Sessions::get('level'))){
            return false;
        }
        else{
            return true;
        }
    }
    public static function getLevel($level){
        $role['Administrador']=3;
        $role['Gerente']=2;
        $role['Digitador']=1;

        if(!array_key_exists($level,$role)){
            throw new Exception('Error de acceso');
        }
        else{
            return $role[$level];
        }
    }
    public static function tiempo(){
        if(!Sessions::get('tiempo')|| !defined('SESSION_TIME')){
            throw new Exception('Constante no definida');
        }
        if(SESSION_TIME==0){
            return;
        }
        if(time()- Sessions::get('tiempo')>(SESSION_TIME*60)){
            Sessions::destroy();
            header('location:'.BASE_URL.'error/access/8080');
        }else{
            Sessions::set('tiempo',time());
        }
    }
}