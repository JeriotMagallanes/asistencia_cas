<?php
class ReporteModel
{
    private $con;
    public function __construct(){
        $this->con = new pdo_conexion;
    }
    public function select_personal_asistio($fecha){
        $qry = $this->con->prepare("SELECT rad.fecha_registro,rad.local,rad.dia_semana,rad.id_registro,rad.hora_registro,pa.dni_pa,pa.apaterno,pa.amaterno,pa.nombres FROM personal_administrativo pa inner join registro_asistencia_administrativos rad on pa.dni_pa=rad.dni_doce where rad.fecha_registro =:fecha ORDER BY pa.apaterno,pa.amaterno,pa.nombres ASC");
        $qry->bindParam(":fecha",$fecha);
        $qry->execute();
        return $qry->fetchAll();
    }
}
