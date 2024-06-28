<?php
class PapeletaController
{
    private $papeletamodel;
    public function __construct(){
        $this->papeletamodel = new PapeletaModel;
    }
    public function dt_todas_papeletas(){
        $datos = [];
        $papeletas = $this->papeletamodel->select_papeletas();
        if ($papeletas) {
            foreach ($papeletas as $papeleta) {
                $item = [
                    $papeleta["id"],
                    $papeleta["apaterno"]." ".$papeleta["amaterno"]." ".$papeleta["nombres"],
                    $papeleta["cargo"],
                    $papeleta["hora_salida"],
                    $papeleta["hora_regreso"],
                    "<button class='btn btn-sm btn-warning' type='button' onclick='editar_papeleta(".json_encode($papeleta).")'><i class='fa fa-edit'></i></button>"
                ] ;
                array_push($datos, $item);
            }
        }
        return $datos;
    }
    public function guardar_nueva_papeleta($post){
        return $this->papeletamodel->insert_papeleta($post);
    }
    public function actualizar_papeleta($post){
        return $this->papeletamodel->update_papeleta($post);
    }
}
