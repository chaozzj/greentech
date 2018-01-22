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
//Para Index
    public function getDesperdicio(){
        $post = $this ->_db->query("SELECT captura.id as idcaptura,dia,turno.nombre as turno,maquina.nombre AS maquina_nombre, operadores.nombres AS operador_nombre, fincas.nombre AS finca_nombre,
variedad.nombre AS variedad_nombre, captura.tocones, captura.cana_larga,captura.cana_picada,captura.puntas,captura.rendimiento
FROM captura
INNER JOIN fincas  ON fincas.id= captura.finca
inner JOIN maquina on maquina.id= captura.maquina
INNER JOIN operadores ON operadores.int = captura.operador
INNER JOIN variedad ON variedad.id= captura.variedad
INNER JOIN turno ON turno.id= captura.turno 
 ORDER BY captura.id");
        return $post->fetchAll();
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
    public function insertarDesperdicio($dia ,$maquina ,$operador ,$turno ,$finca ,$variedad ,$tocones ,$cana_larga, $cana_picada, $puntas, $rendimiento)
    {
        $this->_db->prepare("INSERT INTO captura (dia ,maquina ,operador ,turno ,finca ,variedad ,tocones ,cana_larga ,cana_picada ,puntas ,rendimiento ) 
VALUES(:dia ,:maquina ,:operador ,:turno ,:finca ,:variedad ,:tocones ,:cana_larga ,:cana_picada ,:puntas ,:rendimiento)")
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
///Metodos de Upload
    public function insertarArchivo($nombre ,$titulo ,$contenido ,$tipo)
    {
        $this->_db->prepare("INSERT INTO archivos (nombre ,titulo ,contenido ,tipo)  
            VALUES(:nombre ,:titulo ,:contenido ,:tipo)")
            ->execute(array(
                ':nombre'=>$nombre,
                ':titulo'=>$titulo,
                ':contenido'=>$contenido,
                ':tipo'=>$tipo
            ));
    }
    public function getPostID($id)
    {
        $id=(int)$id;
        $post = $this->_db->query("SELECT * FROM captura WHERE id_post =$id");
        return $post->fetch();
    }
///Metodos de Download
    public function getFilesDesperdicio(){
        $post = $this ->_db->query("SELECT * FROM archivos");
        return $post->fetchAll();
    }
    public function getFileDesperdicio($id){
        $post = $this ->_db->query("SELECT * FROM archivos WHERE id= $id");
        return $post->fetch();
    }
}