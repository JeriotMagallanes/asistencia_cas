<?php
class AsistenciaModel 
{
    private $con;
    
    public function __construct(){
        $this->con = new pdo_conexion;
    }

    public function importarAsistencia($data, $mes, $anio) {
        $sql = "INSERT INTO descuentos_asistencia (dni, mes, anio, total_tardanza_min, total_tardanza_descuento, total_tardanza_horas, total_dias_inasistidos)
                VALUES (:dni, :mes, :anio, :total_tardanza_min, :total_tardanza_descuento, :total_tardanza_horas, :total_dias_inasistidos)";
        $stmt = $this->con->prepare($sql);

        foreach ($data as $row) {
            $stmt->execute([
                ':dni' => $row['Dni'],
                ':mes' => $mes,
                ':anio' => $anio,
                ':total_tardanza_min' => $row['Total Tardanza (min)'],
                ':total_tardanza_descuento' => $row['Total Tardanza descuento'],
                ':total_tardanza_horas' => $row['Total Tardanza horas'],
                ':total_dias_inasistidos' => $row['Total días inasistidos']
            ]);
        }
    }

    public function select_asistencia_group_fecha($dni){
        $qry = $this->con->prepare("SELECT * FROM registro_asistencia_administrativos rad inner join personal_administrativo pa on rad.dni_doce=pa.dni_pa 
        WHERE rad.dni_doce=:dni group by rad.fecha_registro order by date_format(str_to_date(fecha_registro,'%d-%m-%Y'),'%Y-%m-%d') desc");
        $qry->bindParam(":dni", $dni);
        $qry->execute();
        return $qry->fetchAll();
    }

    public function select_marcaciones($fecha,$dni){
        $qry = $this->con->prepare("SELECT * FROM registro_asistencia_administrativos rad WHERE rad.fecha_registro=:fecha and rad.dni_doce=:dni and rad.error<>1 order by hora_registro asc");
        $qry->bindParam(":dni",$dni);
        $qry->bindParam(":fecha",$fecha);
        $qry->execute();
        return $qry->fetchAll();
    }

    public static function select_asistencia_by_fecha($fecha1,$fecha2,$email){
        $con = new pdo_conexion;
        $qry = $con->prepare("SELECT rad.fecha_registro,rad.dia_semana,rad.hora_registro,rad.local,rad.registro FROM registro_asistencia_administrativos rad inner join personal_administrativo pa on rad.dni_doce=pa.dni_pa WHERE pa.cor_inst=:email and rad.error<>1
        and date_format(str_to_date(rad.fecha_registro,'%d-%m-%Y'),'%Y-%m-%d') between (:fec1) and (:fec2) order by date_format(str_to_date(rad.fecha_registro,'%d-%m-%Y'),'%Y-%m-%d') desc, rad.hora_registro asc");
        $qry->bindParam(":email", $email);
        $qry->bindParam(":fec1", $fecha1);
        $qry->bindParam(":fec2", $fecha2);
        $qry->execute();
        return $qry->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
