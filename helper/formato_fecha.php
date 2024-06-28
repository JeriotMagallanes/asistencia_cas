<?php
class FormatoFecha
{
    public static function formato_fecha($fecha){
        //solo fecha en formato dia-mes-año
        if ($fecha === "") {
            return "";
        }
        $fec = explode("-",$fecha);
        $mes = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"];
        //return $fec[0]." de ".$mes[$fec[1]-1]." del ".$fec[2];
        return $fec[0]." de ".$mes[$fec[1]-1]." del ".$fec[2];
    }
    public static function formato_fecha2($fecha){
        //solo fecha en formato año-mes-dia
        if ($fecha === "") {
            return "";
        }
        $fec = explode("-",$fecha);
        $mes = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre"];
        //return $fec[0]." de ".$mes[$fec[1]-1]." del ".$fec[2];
        return $fec[2]." de ".$mes[$fec[1]-1]." del ".$fec[0];
    }
    public static function formato_dmy($fecha){
        if ($fecha === "") {
            return "";
        }
        $fec = explode("-",$fecha);
        return $fec[2]."-".$fec[1]."-".$fec[0];
    }
    public static function formato_barras($fecha){ // recibe m/d/y
        if ($fecha === "") {
            return "";
        }
        $fec = explode("/",$fecha);
        return $fec[2]."-".$fec[0]."-".$fec[1]; // devuelve y-m-d
    }
    public static function dia_semana($dia){
        $dias_sem = [
            "Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"
        ];
        return $dias_sem[$dia];
    }
    // public function formato_hora($hora){
    //     if ($hora == "") {
    //         return "";
    //     }
    //     $hra = explode(":",$hora);
    //     $turno = ($hra[0] < 12) ? "am" : "pm";
    //     $hr_rtn = $hra[0];
    //     if ($hra[0] > 12) {
    //         $hr_rtn = $hr_rtn - 12;
    //     }
    //     return $hr_rtn.":".$hra[1].":".$hra[2]." ".$turno;
    // }
}