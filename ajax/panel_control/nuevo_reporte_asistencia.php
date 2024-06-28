<?php
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
// header("Allow: GET, POST, OPTIONS, PUT, DELETE");
// $json = file_get_contents("php://input");
// $post = json_decode($json);
date_default_timezone_set("America/Lima");
include "../../conexion/pdo_conexion.php";
include "../../helper/asistencia.php";
include "../../helper/formato_fecha.php";
include "../../helper/local_undc.php";
include "../../models/personal.model.php";
include "../../controllers/personal.controller.php";
$personal = new PersonalController;
$data["fecha_enciada"] = $_POST["fec_asi"];
$data["registros"] = $personal->asistencia_por_fecha(FormatoFecha::formato_dmy($_POST["fec_asi"]));
echo json_encode($data);
// $html = "";
// $data["html"] = "";
// if ($asistencias) {
//     foreach ($asistencias as $asistencias) {
//         $fecha = FormatoFecha::formato_dmy($asistencias["fecha_registro"]);
//         if ( $asistencias["cant_local"] > 1 ){//tiene mas de 1 registro en un local
//             // $html .= "<tr>";
//             // $html .= "<td rowspan='".$asistencias["cant_local"]."'><span title='".$asistencias["puesto"]."'>".substr($asistencias["puesto"],0,15)." ...</span></td>";
//             $html .= "<td rowspan='".$asistencias["cant_local"]."'><a href='index.php?busqueda=info&dni=".$asistencias["dni"]."'>".$asistencias["personal"]."</a></td>";
//             $i = 1;
//             foreach ($asistencias["asistencias"] as $marca) {
//                 $html .= ($i == 1) ? "":"<tr>";
//                 $html .= "<td>".$marca["local"]."</td>";
//                 foreach ($marca["registros"] as $hora) {
//                     $html .= "<td>".$hora["hora"]."</td>";
//                 }
//                 $html .= "<td></td>";
//                 $html .= ($i == 1) ? "":"</tr>";
//                 $i += 1;
//             }
//             $html .= "</tr>";
//         }else{
//             // $total_manana = ($asistencias["asistencias"][0]["registros"][2]["hora"] == "") ? AsistenciaHelper::tiempo_transcurrido($fecha, "08:00:12", date("H:i:s")) : AsistenciaHelper::tiempo_transcurrido($fecha, "08:00", "13:00");
//             // $total_tarde = ($asistencias["asistencias"][0]["registros"][4]["hora"] == "") ? AsistenciaHelper::tiempo_transcurrido($fecha, "15:00:00", "18:00:00") : AsistenciaHelper::tiempo_transcurrido($fecha, "15:00:00","18:00:00");
//             $total_manana = ($asistencias["asistencias"][0]["registros"][2]["hora"] == "") ? ["horas"=>0,"minutos"=>0] : AsistenciaHelper::tiempo_transcurrido($fecha, $asistencias["asistencias"][0]["registros"][1]["hora"], $asistencias["asistencias"][0]["registros"][2]["hora"]);
//             $total_tarde = ($asistencias["asistencias"][0]["registros"][4]["hora"] == "") ? ["horas"=>0,"minutos"=>"0"] : AsistenciaHelper::tiempo_transcurrido($fecha, $asistencias["asistencias"][0]["registros"][3]["hora"],$asistencias["asistencias"][0]["registros"][4]["hora"]);
//             $total_hora_dia = $total_manana["horas"] + $total_tarde["horas"];
//             $total_minutos_dia = $total_manana["minutos"] + $total_tarde["minutos"];
//             $total = AsistenciaHelper::procesar_total_hr_min_trabajo($total_hora_dia,$total_minutos_dia);
//             $html .= "<tr>";
//             // $html .= "<td><span title='".$asistencias["puesto"]."'>".substr($asistencias["puesto"],0,10)." ...</span></td>";
//             $html .= "<td><a href='index.php?busqueda=info&dni=".$asistencias["dni"]."'>".$asistencias["personal"]."</a></td>";
//             $html .= "<td>".$asistencias["asistencias"][0]["local"]."</td>";
//             $html .= "<td>".$asistencias["asistencias"][0]["registros"][1]["hora"]."</td>";
//             $html .= "<td>".$asistencias["asistencias"][0]["registros"][2]["hora"]."</td>";
//             $html .= "<td>".$asistencias["asistencias"][0]["registros"][3]["hora"]."</td>";
//             $html .= "<td>".$asistencias["asistencias"][0]["registros"][4]["hora"]."</td>";
//             $html .= "<td>".$total["horas"]." horas con ".$total["minutos"]." minutos"."</td>";
//             $html .= "</tr>";
//         }
//     }
// }else{
//     $html = '<tr><td colspan="7">No se encontraron datos</td></tr>';
// // }
// $data["html"] = $html;
// echo json_encode($data);