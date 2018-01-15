<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 10/12/2017
 * Time: 22:49
 */
class postModel extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getPost(){
        $post = $this->_db->query("SELECT * FROM post");
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
        $post = $this->_db->query("SELECT * FROM post WHERE id_post =$id");
        return $post->fetch();
    }
}