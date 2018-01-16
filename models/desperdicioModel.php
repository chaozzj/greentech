<?php
/**
 * Created by PhpStorm.
 * User: Angel de Jesus Lopez
 * Date: 15/01/2018
 * Time: 16:46
 */
class desperdicioModel extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getdesperdicio(){
        //$post = $this->_db->query("SELECT * FROM ");
        $post = $this ->_db->query("SELECT * FROM operadores");
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