<?php
class TransmisorController
{
    private $transmisormodel, $personalmodel;
    public function __construct(){
        $this->transmisormodel = new TransmisorModel;
        $this->personalmodel = new PersonalModel;
    }
    public function ultimo_cron_local($local){
        $cron = $this->transmisormodel->select_last_cron($local);
        $marcacion = $this->transmisormodel->select_ultima_marcacion($local);
        if ($cron) {
            return [
                "fecha"=>$cron[0]["fecha"], 
                "hora"=>$cron[0]["hora"],
                "marcacion" => ($marcacion) ? '<a target="_blank" href="?busqueda=asistencia&dni='.$marcacion[0]["dni_doce"].'">'.$marcacion[0]["dni_doce"].'</a>' : '<span class="badge badge-danger">Error</span>' ,
            ];
        }else{
            return [
                "fecha"=>'', 
                "hora"=>'<span class="badge badge-danger">Error</span>',
                "marcacion" => ($marcacion) ? $marcacion[0]["dni_doce"] : '<span class="badge badge-danger">Error</span>' ,
            ];
        }
    }
    public function ultimos_registros($local){
        $marc = $this->transmisormodel->select_ultima_marcacion($local);
        $personal = $this->personalmodel->buscar_datos($marc[0]["dni_doce"]);
        if ($marc) {
            $dt_per = ($personal) ? : "No hay datos";
            return [
                "personal" => ($personal) ? $personal[0]["apaterno"]." ".$personal[0]["amaterno"]." ".$personal[0]["nombres"] : "No hay datos del personal",
                "fec_reg" => $marc[0]["fecha_registro"],
                "hora_reg" => $marc[0]["hora_registro"],
                "dia_semana" => $marc[0]["dia_semana"]
            ];
        }
        return [
            "personal"=>"",
            "fec_reg"=>"",
            "hora_reg"=>"",
            "dia_semana"=>""
        ] ;
    }
    public function registro_por_dia($fecha){
        $registros = [];
        $data = $this->transmisormodel->select_asistencia_por_dia($fecha);
        if ($data) {
            foreach ($data as $data) {
                $personal = $this->personalmodel->buscar_datos($data["dni_doce"]);
                $marcacion = [
                    FormatoFecha::formato_fecha($data["fecha_registro"]),
                    $data["hora_registro"],
                    AsistenciaHelper::tipo_asi($data["registro"]),
                    ($personal) ? $personal[0]["apaterno"]." ".$personal[0]["amaterno"]." ".$personal[0]["nombres"]." (".$data["dni_doce"].")" : $data["dni_doce"],
                    LocalUndc::nombre_local($data["local"])
                ];
                array_push($registros, $marcacion);
            }
        }
        return $registros;
    }
}