<?php
class PersonalController{
    private $personalmodel,$localundc;
    public function __construct(){
        $this->personalmodel = new PersonalModel();
    }
    public function listar_personal(){
        return $this->personalmodel->get_personal();
    }
    public function listar_asistencias_personal($mes, $anio){
        return $this->personalmodel->get_asistencias_personal($mes, $anio);
    }
    public function buscar_info_personal($dni){
        return $this->personalmodel->buscar_datos($dni);
    }
    public function listar_asistencia($dni){
        $reg_asistencias = [];
        $reg_fec = $this->personalmodel->get_asi_reg_grp_by_fec_reg($dni);//get todas las asistencias registradas, agrupados por fecha de registro
        $contador = 1;
        if ($reg_fec) {//si hay registros
            foreach ($reg_fec as $reg_fec) {
                $asis_fecha = $this->personalmodel->get_asi_reg_por_fec_reg($dni, $reg_fec["ndate_fec_reg"]);
                $asistencias_reg = [];
                if ($asis_fecha) {
                    foreach ($asis_fecha as $asi_fecha) {
                        $nom_local = LocalUndc::nombre_local($asi_fecha["local"]);
                        $asi_hra = [
                            "hora"=>$asi_fecha["hora_registro"],
                            "local"=>$nom_local,
                        ];
                        array_push($asistencias_reg,$asi_hra);
                    }
                }
                $reg_asi_fec = [
                    $contador,
                    $reg_fec["ndate_fec_reg"],
                    $reg_fec["dia_semana"],
                    "<button class='btn btn-info btn-sm' 
                    onclick='ver_asistencias(`".FormatoFecha::formato_fecha2($reg_fec["ndate_fec_reg"])."`,`".json_encode($asistencias_reg,true)."`)'>
                    <i class='fa fa-check'></i> Asistencias</button>"
                ];
                array_push($reg_asistencias, $reg_asi_fec);
                $contador += 1;
            }
        }
        return json_encode($reg_asistencias);
    }
    public function create_employed($postdata){
        //verificar si ya existe
        if ($this->personalmodel->buscar_datos($postdata["dni"])) {
            return ["estado"=>3, "mensaje"=> "Ya existe un PERSONAL CAS con este número de DNI"];
        }
        if ( $this->personalmodel->create_personal_cas($postdata) == 1 ) {
            return ["estado"=>1, "mensaje"=>"PERSONAL CAS creado correctamente"] ;
        }
        return ["estado"=>2,"mensaje"=>"Error al guardar."];
    }
    public function update_employed($data){
        if ($this->personalmodel->update_personal_cas($data) == 1) {
            return ["estado"=>1,"mensaje"=>"Datos actualizados correctamente"];
        }
        return ["estado"=>2,"mensaje"=>"Error al actualizar"];
    }
    public function mi_asistencia($fecha){
        $datos = [];
        $dni = ($_SESSION["dni"]) ? $_SESSION["dni"] : "" ;
        $asistencias = $this->personalmodel->get_asi_reg_por_fec_reg($dni, $fecha);
        if ($asistencias) {
            foreach ($asistencias as $asistencia) {
                $registro = [
                    "hora" => $asistencia["hora_registro"]." - ".AsistenciaHelper::tipo_asi($asistencia["registro"]),
                    "fecha" => FormatoFecha::formato_fecha($asistencia["fecha_registro"]),
                    "dia_semana" => $asistencia["dia_semana"],
                    "local" => LocalUndc::nombre_local($asistencia["local"])
                ];
                array_push($datos, $registro);
            }
        }
        return $datos;
    }
    public function buscar_info_personal_by_id($id){
        return $this->personalmodel->buscar_datos_by_id($id);
    }
    //nuevo panel
    public function asistencia_por_fecha($fecha){
        $data = [];
        $registro = $this->personalmodel->select_asistencia_group_dni($fecha);
        if ($registro){
            $cont = 1;
            foreach ($registro as $registro) {
                $asistencia = [
                    "personal" => $registro["apaterno"]." ".$registro["amaterno"]." ".$registro["nombres"],
                    "dni" => $registro["dni_doce"],
                    "fecha_registro"=> $registro["fecha_registro"],
                    "asistencias" => "",
                    "cant_local"=>1
                ];
                $asi_local = $this->personalmodel->select_asistencia_group_local($fecha,$registro["dni_doce"]);
                if ($asi_local["data"]) {
                    // array_push($asistencia,["cant_local"=>$cont]);
                    $asistencia["cant_local"] = $asi_local["cant_local"];
                    $reg_asistencias = [];
                    foreach ($asi_local["data"] as $asi_local) {
                        $hora_registro = $this->personalmodel->select_asistencias_local($fecha, $asi_local["dni_doce"],$asi_local["local"]);
                        if ($hora_registro) {
                            $asi_por_local = [
                                "1"=>["tipo"=>"","hora"=>""],
                                "2"=>["tipo"=>"","hora"=>""],
                                "3"=>["tipo"=>"","hora"=>""],
                                "4"=>["tipo"=>"","hora"=>""],
                            ];
                            $i = 1;
                            foreach ($hora_registro as $hora_registro) {
                                $hr_xpld = explode(" ",$hora_registro["hora_registro"]);
                                // $fecha_hora = new DateTime($fecha." ".$hr_xpld[0]);
                                if ($hr_xpld[0] >= "13:00:00" && $hora_registro["registro"] == 1){ //registro mayor de la 1pm y tipo entrada
                                    $i = 3;    
                                }
                                $asi_por_local[$i]["tipo"] = $hora_registro["registro"];
                                $asi_por_local[$i]["hora"] = $hora_registro["hora_registro"];
                                $i += 1;
                            }
                            array_push($reg_asistencias, [
                                "local"=>LocalUndc::nombre_local($asi_local["local"]),
                                "registros"=>$asi_por_local
                            ]);
                        }
                    }
                    // array_push($asistencia, ["asistencias"=>$reg_asistencias]);
                    $asistencia["asistencias"] = $reg_asistencias;
                }
                array_push($data,$asistencia);
            }
        }
        return $data;
    }
    public function subir_foto_estudiante($post,$file){//subir foto al servidor y modificar tabla usuario
        $archivo = $file["file_foto"];
        if (FileValidate::fileIsImage($archivo) == 0){
            return ["estado" => 2, "mensaje" => "La foto seleccionada no está en formato imagen."];
        }
        $file_archivo = explode(".", $archivo["name"]);
        $ext_archivo = strtolower(end($file_archivo));//obtener la extensión del archivo
        $new_archivo = $post["id_per"]."-".$post["dni_per"].date("Y-m-d-H-i-s").".".$ext_archivo;
        $path_archivo = "../../upload/foto/".$new_archivo;
        if ( move_uploaded_file($archivo["tmp_name"], $path_archivo) ) {
            if ( $this->personalmodel->update_foto_usuario($post["id_per"],$new_archivo) == 1) {
                return ["estado"=>1,"mensaje"=>"Foto actualizada correctamente."];
            }
        }
        return ["estado"=>2,"mensaje"=>"Error al actualizar la foto."];
    }
    //24-05-2023
    public function trabajo_hora($fecha){
        $data = [];
        $asistentes = $this->personalmodel->select_asistencia_group_dni($fecha);
        foreach ($asistentes as $asistente) {
            $datos = [
                "dni" => $asistente["dni_doce"],
                // "personal"=>$asistente["apaterno"]." ".$asistente["amaterno"]." ".$asistente["nombres"],
                "fecha" => $fecha,
                "asistencias" => [],
                "cant_reg" => "",
                "total_hora" => "",
            ];
            $registros = $this->personalmodel->select_registros($fecha,$asistente["dni_doce"]);
            if ($registros){
                foreach ($registros as $registro) {
                    $hr_xplode = explode(",",$registro["registros"]);
                    $total = 0;
                    foreach ($hr_xplode as $hr) {
                        $local_xplode = explode("-",$hr);
                        array_push($datos["asistencias"], [
                            "hora" => $local_xplode[0],
                            "local" => LocalUndc::nombre_local($local_xplode[1]),
                            "tipo" => AsistenciaHelper::tipo_asi($local_xplode[2])
                        ]);
                        $total += 1;
                    }
                    $inicio = reset($datos["asistencias"])["hora"];
                    $fin = end($datos["asistencias"])["hora"];
                    $tiempo_bruto = AsistenciaHelper::tiempo_transcurrido($fecha,$inicio,$fin);
                    $datos["total_hora"] = AsistenciaHelper::procesar_total_hr_min_trabajo($tiempo_bruto["horas"],$tiempo_bruto["minutos"]);
                }
            }
            $datos["cant_reg"] = $total;
            array_push($data,$datos);
        }
        return $data;
    }   
}