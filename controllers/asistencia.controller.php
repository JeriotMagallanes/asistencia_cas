<?php
class AsistenciaController
{
    private $asimodel;
    public function __construct(){
        $this->asimodel = new AsistenciaModel;
    }
    // Función para importar asistencias desde un archivo Excel
    public function importarAsistencias($datos_asistencia) {
        $resultados = [
            'estado' => 0,
            'mensaje' => ''
        ];

        foreach ($datos_asistencia as $asistencia) {
            // Extraer datos del array de asistencia
            $dni = $asistencia[0]; // Ajusta según la estructura de tu archivo Excel
            $total_tardanza_min = $asistencia[1]; // Ajusta según la estructura de tu archivo Excel
            $total_tardanza_descuento = $asistencia[2]; // Ajusta según la estructura de tu archivo Excel
            $total_tardanza_horas = $asistencia[3]; // Ajusta según la estructura de tu archivo Excel
            $total_dias_inasistidos = $asistencia[4]; // Ajusta según la estructura de tu archivo Excel
            $mes = $asistencia[5]; // Extraído del formulario de importación
            $anio = $asistencia[6]; // Extraído del formulario de importación

            // Insertar asistencia en la base de datos
            $resultado = $this->asimodel->insertarAsistencia($dni, $mes, $anio, $total_tardanza_min, $total_tardanza_descuento, $total_tardanza_horas, $total_dias_inasistidos);

            if ($resultado) {
                $resultados['estado'] = 1;
            } else {
                $resultados['mensaje'] = 'Error al insertar la asistencia para el DNI: ' . $dni;
                break;
            }
        }

        return $resultados;
    }
    public function listar_mi_asistencia($dni){
        $data = [];
        $registros = $this->asimodel->select_asistencia_group_fecha($dni);
        if ( $registros ){
            $contador = 1;
            foreach ($registros as $registro) {
                array_push($data,[
                    $contador,
                    FormatoFecha::formato_fecha($registro["fecha_registro"]),
                    $registro["dia_semana"],
                    '<button onclick="ver_asistencias(`'.$registro["fecha_registro"].'`,`'.$dni.'`)" class="btn btn-sm btn-info" style="display:flex"><i class="fa fa-clock"></i> <span>Marcaciones</span></button>'
                ]);
                $contador ++ ;
            }
        }
        return $data;
    }
    public function ver_marcaciones($fecha,$dni){
        $data = [
            "asistencia" => [],
            "total_horas" => "No tiene 4 marcaciones",
        ];
        $marcaciones = [
            1 => "",
            2 => "",
            3 => "",
            4 => "",
        ];
        $contador = 1 ;
        $registros = $this->asimodel->select_marcaciones($fecha,$dni);
        if ($registros) {
            foreach ($registros as $registro) {
                $hora_xplode = explode(" ",$registro["hora_registro"]);
                array_push($data["asistencia"], [
                    "local" => LocalUndc::nombre_local($registro["local"]),
                    "tipo" => AsistenciaHelper::tipo_asi($registro["registro"]),
                    "hora" => $hora_xplode[0],
                    "id" => $registro["id_registro"],
                    "fecha" => FormatoFecha::formato_dmy($registro["fecha_registro"]),
                ]);
                $marcaciones[$contador] = $hora_xplode[0];
                $contador ++;
            }
        }   
        if ($contador == 5 || $contador == 3) {
            $horas_entrada = [];
            $horas_salida = [];
            // Recorre el arreglo de marcaciones y separa las horas de entrada y salida
            foreach ($marcaciones as $clave => $hora) {
                if ($clave % 2 === 1) {
                    // Si la clave es impar, es una hora de entrada
                    $horas_entrada[] = $hora;
                } else {
                    // Si la clave es par, es una hora de salida
                    $horas_salida[] = $hora;
                }
            }
            // Inicializa una variable para almacenar el total de horas trabajadas
            $total_horas_trabajadas = 0;
            // Calcula el total de horas trabajadas
            for ($i = 0; $i < count($horas_entrada); $i++) {
                $entrada = strtotime($horas_entrada[$i]);
                $salida = strtotime($horas_salida[$i]);
                $diferencia = $salida - $entrada;
                $total_horas_trabajadas += $diferencia;
            }
            // Convierte el total de segundos trabajados a horas, minutos y segundos
            $horas = floor($total_horas_trabajadas / 3600);
            $minutos = floor(($total_horas_trabajadas % 3600) / 60);
            $segundos = $total_horas_trabajadas % 60;
            $data["total_horas"] = $horas." horas,".$minutos." minutos, ".$segundos." segundos";
        }
        // usort($data, "AsistenciaHelper::ordenar_asistencia");
        return $data;
    }
}
