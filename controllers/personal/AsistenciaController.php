<?php

class AsistenciaController{
    public function mostrar_mi_asistencia($rango_fecha){
        $email = $_SESSION['cor_inst'];
        $extraer_fecha = explode(' - ',$rango_fecha);
        $fecha1 =  FormatoFecha::formato_barras($extraer_fecha[0]);
        $fecha2 = FormatoFecha::formato_barras($extraer_fecha[1]);
        
        $data = AsistenciaModel::select_asistencia_by_fecha($fecha1,$fecha2,$email);
        if ($data) {
            return ['estado'=>1,'data'=>$data];
        }
        return ['estado'=>2,'data'=>[]];
    }
}