<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 18/01/2018
 * Time: 12:15
 */
class loginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLogin($user, $pass){
        $post = $this->_db->query("SELECT * FROM usuarios".
        "WHERE login ='$user'".
        "and password ='$pass'");
        return $post->fetch();
    }
}