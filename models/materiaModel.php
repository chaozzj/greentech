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
        $post = $this->_db->query("SELECT dia,c.nombre AS maquina_nombre, d.nombres AS operador_nombre, e.nombre AS turno_nombre, b.nombre AS finca_nombre,
f.nombre AS variedad_nombre, A.cepa, A.tierra,A.cogollo,A.verdes,A.secas
FROM materia A
INNER JOIN fincas B ON B.id= A.finca
inner JOIN maquina C on C.id= A.maquina
INNER JOIN operadores D ON d.int = A.operador
inner JOIN turno E ON E.id= A.turno
INNER JOIN variedad F ON F.id= a.variedad");
        return $post->fetchAll();

        /*$post = array(
            'id'=>1,
            'titulo'=> 'Test de post',
            'contenido'=>'test test test'
        );
        return $post;*/
    }

    public function insertarMateria($dia ,$cosechando ,$girando ,$volquete ,$transporte ,$reparacion ,$revision ,$distraido )
    {
        $this->_db->prepare("INSERT INTO rendimiento (dia ,cosechando ,girando ,volquete ,transporte ,reparacion ,revision ,distraido ) 
            VALUES(:dia,:cosechando,:girando,:volquete,:transporte,:reparacion,:revision,:distraido)")
            ->execute(array(
                ':dia'=>$dia,
                ':cosechando'=>$cosechando,
                ':girando'=>$girando,
                ':volquete'=>$volquete,
                ':transporte'=>$transporte,
                ':reparacion'=>$reparacion,
                ':revision'=>$revision,
                ':distraido'=>$distraido
            ));
    }

    public function getPostID($id)
    {
        $id=(int)$id;
        $post = $this->_db->query("SELECT * FROM rendimiento WHERE id_post =$id");
        return $post->fetch();
    }
}