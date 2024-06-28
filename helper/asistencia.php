<?php
class AsistenciaHelper
{
    public static function procesar_asistencia($fecha,$hora,$tiporegistro){
        $hra_actual = date("H:i:S");
        if ($hra_actual >= "05:00:00" && $hra_actual < "12:50:00"){
            echo "Hora de entrada en la mañana<br>";
        }else{
            echo "Salida<br>";
        }
        $entrada = new DateTime($fecha." 07:30:00");
        $separar_hora = explode(" ",$hora);
        $parametro = $fecha." ".$separar_hora[0] ;
        echo $parametro."<br>";
        $marcacion = new DateTime($parametro);
        $calc = $entrada->diff($marcacion);
        $hra_explode = explode(":",$hora);
        $hra_min = $hra_explode[0].":".$hra_explode[1];
        // echo $hra_min."<br>";
        if ( $hora >= "07:31" ){ // tardanza
            echo "<span style='color:red'>- ".$calc->i."</span";
        }else if($hra_min == "07:30"){
            echo $calc->i;
        }else{
            echo "<span style='color:green'>+ ".$calc->i."</span";
        }
    }
    public static function tiempo_transcurrido($fecha,$hra_inicial, $hra_final){
        $hraini_explode = explode(":",$hra_inicial);
        $hra_min_ini = $hraini_explode[0].":".$hraini_explode[1];
        $entrada = new DateTime($fecha." ".$hra_min_ini);

        $hrafin_explode = explode(":",$hra_final);
        $hra_min_fin = $hrafin_explode[0].":".$hrafin_explode[1];
        $salida = new DateTime($fecha." ".$hra_min_fin);
        
        $tiempo = $salida->diff($entrada);
        // return $tiempo->h." horas con ".$tiempo->i." minutos";
        return [
            "horas" => $tiempo->h,
            "minutos" => $tiempo->i
        ];
    }
    public static function procesar_total_hr_min_trabajo($hora,$minutos){
        $min_a_hora = floor($minutos/60);
        $min_restante = $minutos;
        if ($minutos >= 60) {
            $min_restante = $minutos % 60;
        }
        $total_hora = $min_a_hora+$hora;
        return ["horas"=>$total_hora, "minutos"=>$min_restante];
    }
    public static function tipo_asi($tipo){
        if ($tipo == "1") {
            return "Entrada";
        }else if($tipo == 2){
            return "Salida";
        }else{
            return "";
        }
    }
}
