<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 15/01/2018
 * Time: 15:45
 */
class rendimientoModel extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getRendimientos(){
        $post = $this->_db->query("SELECT * FROM rendimiento");
        return $post->fetchAll();

        /*$post = array(
            'id'=>1,
            'titulo'=> 'Test de post',
            'contenido'=>'test test test'
        );
        return $post;*/
    }

    public function getPostID($id)
    {
        $id=(int)$id;
        $post = $this->_db->query("SELECT * FROM rendimiento WHERE id_post =$id");
        return $post->fetch();
    }
}