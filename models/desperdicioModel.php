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
        $post = $this ->_db->query("SELECT dia,turno,maquina.nombre AS maquina_nombre, operadores.nombres AS operador_nombre, fincas.nombre AS finca_nombre,
variedad.nombre AS variedad_nombre, captura.tocones, captura.cana_larga,captura.cana_picada,captura.puntas,captura.rendimiento
FROM captura
INNER JOIN fincas  ON fincas.id= captura.finca
inner JOIN maquina on maquina.id= captura.maquina
INNER JOIN operadores ON operadores.int = captura.operador
INNER JOIN variedad ON variedad.id= captura.variedad");
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