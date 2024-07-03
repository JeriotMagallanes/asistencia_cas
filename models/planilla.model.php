<?php
class PlanillaModel extends pdo_conexion
{
    private $con;
    public function __construct(){
        $this->con = new pdo_conexion;
    }
    public function get_planilla(){
        //obtener todos los personales
        $qry = $this->con->prepare("SELECT * FROM descuentos_asistencia");
        $qry->execute();
        return $qry->fetchAll();
    }

    public function get_planilla_fecha($mes, $anio){
    $qry = $this->con->prepare("CALL GenerarPlanillaFecha(:mes, :anio)");
    $qry->bindParam(':mes', $mes, PDO::PARAM_INT);
    $qry->bindParam(':anio', $anio, PDO::PARAM_INT);
    $qry->execute();
    return $qry->fetchAll();
    }

}