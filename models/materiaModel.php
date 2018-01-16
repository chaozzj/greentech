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
        $post = $this->_db->query("SELECT dia,maquina.nombre AS maquina_nombre, operadores.nombres AS operador_nombre, fincas.nombre AS finca_nombre,
variedad.nombre AS variedad_nombre, materia.cepa, materia.tierra,materia.cogollo, materia.verdes,materia.secas
FROM materia
INNER JOIN fincas  ON fincas.id= materia.finca
inner JOIN maquina on maquina.id= materia.maquina
INNER JOIN operadores ON operadores.int = materia.operador
INNER JOIN variedad ON variedad.id= materia.variedad");
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
    public function insertarMateria($dia ,$maquina ,$operador  ,$finca ,$variedad ,$cepa ,$tierra  ,$verdes ,$secas )
    {
        $this->_db->prepare("INSERT INTO materia (dia ,maquina ,operador  ,finca ,variedad ,cepa ,tierra  ,verdes ,secas ) 
            VALUES(:dia ,:maquina ,:operador ,:finca ,:variedad ,:cepa ,:tierra ,:verdes ,:secas)")
            ->execute(array(
                ':dia'=>$dia,
                ':maquina'=>$maquina,
                ':operador'=>$operador,
                ':finca'=>$finca,
                ':variedad'=>$variedad,
                ':cepa'=>$cepa,
                ':tierra'=>$tierra,
                ':verdes'=>$verdes,
                ':secas'=>$secas,
            ));
    }

    public function getPostID($id)
    {
        $id=(int)$id;
        $post = $this->_db->query("SELECT * FROM rendimiento WHERE id_post =$id");
        return $post->fetch();
    }
}