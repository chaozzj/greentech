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
        $post = $this ->_db->query("SELECT * FROM captura");
        return $post->fetchAll();

        /*$post = array(
            'id'=>1,
            'titulo'=> 'Test de post',
            'contenido'=>'test test test'
        );
        return $post;*/
    }

    public function insertarDesperdicio($dia ,$maquina ,$operador ,$turno ,$finca ,$variedad ,$tocones ,$cana_larga, $cana_picada, $puntas, $rendimiento)
    {
        $this->_db->prepare("INSERT INTO captura (dia ,maquina ,operador ,turno ,finca ,variedad ,tocones ,cana_larga, cana_picada, puntas, rendimiento ) 
            VALUES(:dia,:maquina,:turno,:finca,:variedad,:tocones,:cana_larga,:cana_picada,:puntas,:rendiemiento)")
            ->execute(array(
                ':dia'=>$dia,
                ':maquina'=>$maquina,
                ':operador'=>$operador,
                ':turno'=>$turno,
                ':finca'=>$finca,
                ':variedad'=>$variedad,
                ':tocones'=>$tocones,
                ':cana_larga'=>$cana_larga,
                ':cana_picada'=>$cana_picada,
                ':puntas'=>$puntas,
                  ':rendimiento'=>$rendimiento
            ));
    }



    public function getPostID($id)
    {
        $id=(int)$id;
        $post = $this->_db->query("SELECT * FROM captura WHERE id_post =$id");
        return $post->fetch();
    }
}