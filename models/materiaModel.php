<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 15/01/2018
 * Time: 15:45
 */
class materiaModel extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getMaterias(){
        $post = $this->_db->query("SELECT materia.id as idmateria,dia,maquina.nombre AS maquina_nombre, operadores.nombres AS operador_nombre, fincas.nombre AS finca_nombre,
variedad.nombre AS variedad_nombre, materia.cepa, materia.tierra,materia.cogollo, materia.verdes,materia.secas
FROM materia
LEFT JOIN fincas  ON fincas.id= materia.finca
LEFT JOIN maquina on maquina.id= materia.maquina
LEFT JOIN operadores ON operadores.int = materia.operador
LEFT JOIN variedad ON variedad.id= materia.variedad
ORDER BY materia.id");
        return $post->fetchAll();
    }

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
    public function insertarMateria($dia ,$maquina ,$operador  ,$finca ,$variedad ,$peso, $cepa ,$tierra  ,$verdes ,$secas )
    {
        $this->_db->prepare("INSERT INTO materia (dia ,maquina ,operador  ,finca ,variedad ,cogollo,cepa ,tierra  ,verdes ,secas ) 
            VALUES(:dia ,:maquina ,:operador ,:finca ,:variedad ,:cogollo,:cepa ,:tierra ,:verdes ,:secas)")
            ->execute(array(
                ':dia'=>$dia,
                ':maquina'=>$maquina,
                ':operador'=>$operador,
                ':finca'=>$finca,
                ':variedad'=>$variedad,
                ':cogollo'=>$peso,
                ':cepa'=>$cepa,
                ':tierra'=>$tierra,
                ':verdes'=>$verdes,
                ':secas'=>$secas,
            ));
    }
    public function insertarArchivo($nombre ,$titulo ,$contenido ,$tipo)
    {
        $this->_db->prepare("INSERT INTO archivosm (nombre ,titulo ,contenido ,tipo)  
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
        $post = $this->_db->query("SELECT * FROM rendimiento WHERE id_post =$id");
        return $post->fetch();
    }
    ///Metodos de Download
    public function getFilesMateria(){
        $post = $this ->_db->query("SELECT * FROM archivosm");
        return $post->fetchAll();
    }
    public function getFileMateria($id){
        $post = $this ->_db->query("SELECT * FROM archivosm WHERE id= $id");
        return $post->fetch();
    }
}