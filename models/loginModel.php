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

    public function getUser($user, $pass){
        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $querystr=("SELECT * FROM usuario inner join roles on roles.id = usuario.id_rol".
            " WHERE login ='$user'".
            "and password ='$pass'");
        if($con->connect_errno>0){
           die( Sessions::set('error',$con->connect_error));
        }

        $userinfo =array();

        if(!$post = $con->query($querystr)){
            Sessions::set('error','no hay usuario'. $querystr);
            exit;
        }

        if($post = $con->query($querystr)){
            while($row = $post->fetch_array()){
            Sessions::set('level',$row["nombre"]);
            }
        }

        $con->close();
    }
}