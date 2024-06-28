<?php
class TransmisorModel 
{
    private $con;
    public function __construct(){
        $this->con = new pdo_conexion();
    }
    public function select_last_cron($local){
        $fecha_actual = date("Y-m-d");
        $qry = $this->con->prepare("SELECT * FROM cron_asi_cas WHERE local_undc=:local_undc and fecha=:fecha order by hora DESC LIMIT 1");
        $qry->bindParam(":local_undc", $local);
        $qry->bindParam(":fecha",$fecha_actual);
        $qry->execute();    
        return $qry->fetchAll();
        return true;
    }
    public function select_ultima_marcacion($localundc){
        // $qry = $this->con->prepare("SELECT * FROM `registro_asistencia_administrativos` WHERE local=:localundc order by hora_registro DESC limit 1 ");
        $qry = $this->con->prepare("SELECT * FROM `registro_asistencia_administrativos` 
        where local = :localundc order by date_format(str_to_date(fecha_registro,'%d-%m-%Y'),'%Y-%m-%d') DESC,hora_registro DESC;");
        $qry->bindParam(":localundc", $localundc);
        $qry->execute();
        return $qry->fetchAll();
        return true;
    }
    public function select_asistencia_por_dia($fecha){
        $qry = $this->con->prepare("SELECT * FROM registro_asistencia_administrativos WHERE fecha_registro=:fecha_registro and error<>1 order by hora_registro DESC");
        $qry->bindParam(":fecha_registro", $fecha);
        $qry->execute();
        return $qry->fetchAll();
        return true;
    }
}
