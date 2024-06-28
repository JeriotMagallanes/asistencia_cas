<?php
class ReporteController
{
    private $repmodel;
    public function __construct(){
        $this->repmodel = new ReporteModel;
    }
    public function listar_personal_by_fecha($fecha){
        $data = [];
        $rows = $this->repmodel->select_personal_asistio($fecha);
        if ($rows) {
            foreach ($rows as $row) {
                array_push($data, [
                    "dni_pa" => $row["dni_pa"],
                    "apaterno" => $row["apaterno"],
                    "amaterno" => $row["amaterno"],
                    "nombres" => $row["nombres"],
                    "hora_reg" => $row["hora_registro"],
                    "fecha_reg" => $row["fecha_registro"],
                    "fecha_registro" => $row["fecha_registro"],
                    "id" => $row["id_registro"],
                    "local" => $row["local"],
                    "dia_sem" => $row["dia_semana"],
                ]);
            }
        }
        return $data;
    }
}
