<?php
class PersonalModel extends pdo_conexion
{
    private $con;
    public function __construct(){
        $this->con = new pdo_conexion;
    }
    public function get_personal(){
        //obtener todos los personales
        $qry = $this->con->prepare("SELECT * FROM personal_administrativo WHERE tip_per='CAS' ");
        $qry->execute();
        return $qry->fetchAll();
    }

    public function get_asistencias_personal($mes, $anio){
    $qry = $this->con->prepare("CALL GenerarReporteAsistencia(:mes, :anio)");
    $qry->bindParam(':mes', $mes, PDO::PARAM_INT);
    $qry->bindParam(':anio', $anio, PDO::PARAM_INT);
    $qry->execute();
    return $qry->fetchAll();
    }

    public function get_asi_reg($dni){
        //obtener registro de asistencia por dni
        $qry = $this->con->prepare("SELECT * FROM `registro_asistencia_administrativos` WHERE dni_doce=:dni_doce ORDER BY fecha_registro,hora_registro DESC;");
        $qry->bindParam(":dni_doce",$dni);
        $qry->execute();
        return $qry->fetchAll();
    }
    public function asi_filtr_fec($dni, $fecini, $fecfin){
        // $qry = $this->con->prepare("SELECT * FROM `registro_asistencia_administrativos` 
        // WHERE dni_doce=:dni_doce and  fecha_registro between :fecfin and :fecini 
        // GROUP BY hora_registro ORDER BY fecha_registro,hora_registro DESC;");
        $qry = $this->con->prepare("SELECT * FROM `registro_asistencia_administrativos` 
        WHERE error<>1 and dni_doce=:dni_doce and date_format(str_to_date(fecha_registro,'%d-%m-%Y'),'%Y-%m-%d') between (:fecini) and (:fecfin) GROUP BY hora_registro ORDER BY date_format(str_to_date(fecha_registro,'%d-%m-%Y'),'%Y-%m-%d') DESC ,hora_registro ASC;");
        $qry->bindParam(":dni_doce",$dni);
        $qry->bindParam(":fecini",$fecini);
        $qry->bindParam(":fecfin",$fecfin);
        $qry->execute();
        return $qry->fetchAll();
    }
    public function buscar_datos($dni){
        $qry = $this->con->prepare("SELECT * FROM personal_administrativo WHERE dni_pa=:dni_pa");
        $qry->bindParam(":dni_pa", $dni);
        $qry->execute();
        return $qry->fetchAll();
    }
    public function buscar_datos_by_id($id){
        $qry = $this->con->prepare("SELECT * FROM personal_administrativo WHERE id_personal=:id_personal");
        $qry->bindParam(":id_personal", $id);
        $qry->execute();
        return $qry->fetchAll();
    }
    public function get_asi_reg_grp_by_fec_reg($dni){
        $qry = $this->con->prepare("SELECT dia_semana,local,hora_registro,date_format(str_to_date(fecha_registro,'%d-%m-%Y'),'%Y-%m-%d') as ndate_fec_reg FROM `registro_asistencia_administrativos` WHERE dni_doce=:dni_doce GROUP BY fecha_registro ORDER BY ndate_fec_reg DESC;");
        $qry->bindParam(":dni_doce",$dni);
        $qry->execute();
        return $qry->fetchAll();
    }
    public function get_asi_reg_por_fec_reg($dni,$fec){
        $qry = $this->con->prepare("SELECT fecha_registro,dia_semana,hora_registro,local,registro FROM `registro_asistencia_administrativos` WHERE dni_doce=:dni and date_format(str_to_date(fecha_registro,'%d-%m-%Y'),'%Y-%m-%d')=:fecha GROUP BY hora_registro ORDER BY hora_registro ASC;");
        $qry->bindParam(":dni",$dni);
        $qry->bindParam(":fecha",$fec);
        $qry->execute();
        return $qry->fetchAll();
    }
    public function create_personal_cas($postdata){
        try {
        $this->con->beginTransaction();
        $qry1 = $this->con->prepare("INSERT INTO personal_administrativo(apaterno,amaterno,nombres,dni_pa,cor_inst,cor_per,puesto,dependencia,cel_pa) 
        VALUES(UPPER(:apaterno),UPPER(:amaterno),UPPER(:nombres),:dni_pa,:cor_inst,:cor_per,UPPER(:puesto),UPPER(:dependencia),:cel_pa)");
        $qry1->bindParam(":apaterno", $postdata["apaterno"]);
        $qry1->bindParam(":amaterno", $postdata["amaterno"]);
        $qry1->bindParam(":nombres", $postdata["nombres"]);
        $qry1->bindParam(":puesto", $postdata["puesto"]);
        $qry1->bindParam(":dependencia", $postdata["dependencia"]);
        $qry1->bindParam(":dni_pa", $postdata["dni"]);
        $qry1->bindParam(":cel_pa", $postdata["celular"]);
        $qry1->bindParam(":cor_per", $postdata["cor_per"]);
        $qry1->bindParam(":cor_inst", $postdata["cor_inst"]);
        $qry1->execute();
    // NUEVOS PERSONAL CAS PARA SINCRONIZAR CON LAS SEDES
        $qry2 = $this->con->prepare("INSERT INTO personal_administrativo_nuevos(apaterno,amaterno,nombres,dni_pa,cor_inst,cor_per,puesto,dependencia,cel_pa) 
        VALUES(UPPER(:apaterno),UPPER(:amaterno),UPPER(:nombres),:dni_pa,:cor_inst,:cor_per,UPPER(:puesto),UPPER(:dependencia),:cel_pa)");
        $qry2->bindParam(":apaterno", $postdata["apaterno"]);
        $qry2->bindParam(":amaterno", $postdata["amaterno"]);
        $qry2->bindParam(":nombres", $postdata["nombres"]);
        $qry2->bindParam(":puesto", $postdata["puesto"]);
        $qry2->bindParam(":dependencia", $postdata["dependencia"]);
        $qry2->bindParam(":dni_pa", $postdata["dni"]);
        $qry2->bindParam(":cel_pa", $postdata["celular"]);
        $qry2->bindParam(":cor_per", $postdata["cor_per"]);
        $qry2->bindParam(":cor_inst", $postdata["cor_inst"]);
        $qry2->execute();
        $this->con->commit();
        return 1; 
        } catch (Exception $e) {
            $this->con->rollback();
            error_log("Error al insertar: " . $e->getMessage());
            return 2;
        }
    }
    public function update_personal_cas($data){
        $qry = $this->con->prepare("UPDATE personal_administrativo SET amaterno=UPPER(:amaterno),apaterno=UPPER(:apaterno),nombres=UPPER(:nombres),dni_pa=:dni_pa,cel_pa=:cel_pa,cor_per=:cor_per,
        cor_inst=:cor_inst,puesto=UPPER(:puesto),dependencia=UPPER(:dependencia),Cod_AIRHSP=UPPER(:Cod_AIRHSP),sueldo_base=UPPER(:sueldo_base),retencion_4cat=UPPER(:retencion_4cat),
        t_aportacion=UPPER(:t_aportacion),afp=UPPER(:afp),fecha_ingreso=UPPER(:fecha_ingreso),meta=UPPER(:meta)
        WHERE id_personal=:id_personal");
        $qry->bindParam(":apaterno", $data["ed_apaterno"]);
        $qry->bindParam(":amaterno", $data["ed_amaterno"]);
        $qry->bindParam(":nombres", $data["ed_nombres"]);
        $qry->bindParam(":dni_pa", $data["ed_dni"]);
        $qry->bindParam(":cel_pa", $data["ed_celular"]);
        $qry->bindParam(":cor_per", $data["ed_cor_per"]);
        $qry->bindParam(":cor_inst", $data["ed_cor_inst"]);
        $qry->bindParam(":puesto", $data["ed_puesto"]);
        $qry->bindParam(":dependencia", $data["ed_dependencia"]);
        $qry->bindParam(":Cod_AIRHSP", $data["cod_airhsp"]);
        $qry->bindParam(":sueldo_base", $data["su_base"]);
        $qry->bindParam(":retencion_4cat", $data["renta"]);
        $qry->bindParam(":t_aportacion", $data["t_pension"]);
        $qry->bindParam(":afp", $data["pension"]);
        $qry->bindParam(":fecha_ingreso", $data["f_ingreso"]);
        $qry->bindParam(":id_personal", $data["ed_id_personal"]);
        $qry->bindParam(":meta", $data["meta"]);
        if ($qry->execute()) {
            return 1;
        }
        return 2;
    }
    public function select_asistencia_group_dni($fecha){
        $qry = $this->con->prepare('SELECT rad.dni_doce,pa.apaterno,pa.amaterno,pa.nombres,rad.fecha_registro FROM registro_asistencia_administrativos rad INNER JOIN personal_administrativo pa on rad.dni_doce=pa.dni_pa WHERE rad.fecha_registro=:fecha group by rad.dni_doce ORDER BY pa.apaterno,pa.amaterno,pa.nombres');
        $qry->bindParam(":fecha",$fecha);
        $qry->execute();
        return $qry->fetchAll();
    }
    public function select_asistencia_group_local($fecha,$dni){
        $qry = $this->con->prepare('SELECT rad.dni_doce,rad.local FROM registro_asistencia_administrativos rad INNER JOIN personal_administrativo pa on rad.dni_doce=pa.dni_pa WHERE rad.dni_doce=:dni and rad.fecha_registro=:fecha group by rad.local ORDER BY rad.hora_registro ASC;');
        $qry->bindParam(":dni",$dni);
        $qry->bindParam(":fecha",$fecha);
        $qry->execute();
        return ["data"=>$qry->fetchAll(),"cant_local"=>$qry->rowCount()];
    }
    public function select_asistencias_local($fecha, $dni, $local){
        $qry = $this->con->prepare('SELECT rad.hora_registro,rad.registro FROM registro_asistencia_administrativos rad INNER JOIN personal_administrativo pa on rad.dni_doce=pa.dni_pa WHERE rad.dni_doce=:dni and rad.fecha_registro=:fecha and rad.local=:local ORDER BY rad.hora_registro ASC;');
        $qry->bindParam(":dni",$dni);
        $qry->bindParam(":local",$local);
        $qry->bindParam(":fecha",$fecha);
        $qry->execute();
        return $qry->fetchAll();
    }
    public function update_foto_usuario($id,$url){
        $qry = $this->con->prepare("UPDATE personal_administrativo SET url_avatar=:url_avatar WHERE id_personal=:id_personal");
        $qry->bindParam(":id_personal", $id);
        $qry->bindParam(":url_avatar", $url);
        if ($qry->execute()) {
            return 1;
        }
        return 2;
    }
    public function select_registros($fecha,$dni){
        $qry = $this->con->prepare('SELECT rad.dni_doce, GROUP_CONCAT(rad.hora_registro,"-",rad.local,"-",rad.registro order by rad.hora_registro asc ) AS registros
        FROM registro_asistencia_administrativos rad
        WHERE rad.fecha_registro=:fecha and rad.dni_doce=:dni');
        $qry->bindParam(":fecha",$fecha);
        $qry->bindParam(":dni",$dni);
        $qry->execute();
        return $qry->fetchAll();
    }
}