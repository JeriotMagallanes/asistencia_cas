<?php
class PapeletaModel
{
    private $con;
    public function __construct(){
        $this->con = new pdo_conexion;
    }  
    public function select_papeletas(){
        $qry = $this->con->prepare("SELECT papeletas.motivo,cas.id_personal,cas.apaterno,cas.amaterno,cas.nombres,papeletas.cargo,
        papeletas.id,papeletas.fecha,papeletas.hora_salida,papeletas.hora_regreso 
        FROM papeletas inner join personal_administrativo cas on papeletas.id_personal=cas.id_personal");
        $qry->execute();
        return $qry->fetchAll();
    }
    public function insert_papeleta($put){
        $qry = $this->con->prepare("INSERT INTO papeletas (id_personal,cargo,fecha,hora_salida,hora_regreso,motivo) 
        values (:id_personal,:cargo,:fecha,:hora_salida,:hora_regreso,:motivo)");
        $qry->bindParam(":cargo",$put["cargo"]);
        $qry->bindParam(":fecha",$put["fecha"]);
        $qry->bindParam(":hora_salida",$put["hora_salida"]);
        $qry->bindParam(":hora_regreso",$put["hora_regreso"]);
        $qry->bindParam(":motivo",$put["motivo"]);
        $qry->bindParam(":id_personal",$put["id_personal"]);
        if ( $qry->execute() ){
            return 1;
        }
        return 0;
    }
    public function update_papeleta($post){
        $qry1 = $this->con->prepare("UPDATE personal_administrativo SET puesto=:cargo WHERE id_personal = :id_personal");
        $qry1->bindParam(":cargo",$post["cargo"]);
        $qry1->bindParam(":id_personal",$post["id_personal"]);
        if ( $qry1->execute() ) {
            $qry = $this->con->prepare("UPDATE papeletas SET cargo=:cargo,fecha=:fecha,hora_salida=:hora_salida,hora_regreso=:hora_regreso,motivo=:motivo WHERE id=:id");
            $qry->bindParam(":cargo", $post["cargo"]);
            $qry->bindParam(":fecha", $post["fecha"]);
            $qry->bindParam(":fecha", $post["fecha"]);
            $qry->bindParam(":hora_salida", $post["hora_salida"]);
            $qry->bindParam(":hora_regreso", $post["hora_regreso"]);
            $qry->bindParam(":motivo", $post["motivo"]);
            $qry->bindParam(":id", $post["id"]);
            if ($qry->execute()) {
                return 1;
            }
        }
        return 2;
    }
}
