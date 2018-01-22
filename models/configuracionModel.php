<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 21/01/2018
 * Time: 23:12
 */

class configuracionModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    ///Metodos de form Nuevo
    public function getMaquinas(){
        $post = $this->_db->query("SELECT * FROM maquina");
        return $post->fetchAll();
    }
    public function getFincas(){
        $post = $this->_db->query("SELECT * FROM fincas");
        return $post->fetchAll();
    }
    public function getOperadores(){
        $post = $this->_db->query("SELECT * FROM operadores");
        return $post->fetchAll();
    }
    public function getVariedades(){
        $post = $this->_db->query("SELECT * FROM variedad");
        return $post->fetchAll();
    }
    public function getTurnos(){
        $post = $this->_db->query("SELECT * FROM turno");
        return $post->fetchAll();
    }
}