<?php
$currentMonth = date('n'); // Obtener el mes actual en formato numérico
$currentYear = date('Y'); // Obtener el año actual en formato numérico
$selectedMonth = isset($_GET['sel_mes_ini']) ? $_GET['sel_mes_ini'] : $currentMonth;
$selectedYear = isset($_GET['sel_anio']) ? $_GET['sel_anio'] : $currentYear;

include "./models/planilla.model.php";
include "./controllers/planilla.controller.php";

$planilla = new PlanillaController();
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Reporte Planilla</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Personal CAS</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <!-- Selectores de mes y año -->
            <div class="form-row mb-3">
              <div class="col-md-3">
                <!-- Selector de mes -->
                <select class="form-control" id="sel_mes_ini" name="sel_mes_ini">
                  <?php for ($i = 1; $i <= 12; $i++): ?>
                    <?php
                      $nombre_mes = date('F', mktime(0, 0, 0, $i, 1));
                      $num_dias_mes = date('t', mktime(0, 0, 0, $i, 1));
                    ?>
                    <option value="<?php echo $i; ?>" <?php echo ($i == $selectedMonth) ? 'selected' : ''; ?>>
                      <?php echo $nombre_mes . " - " . $num_dias_mes; ?>
                    </option>
                  <?php endfor; ?>
                </select>
              </div>
              <div class="col-md-3">
                <!-- Selector de año -->
                <select class="form-control" id="sel_anio" name="sel_anio">
                    <?php for ($i = $currentYear; $i >= 2023; $i--): ?>
                      <option value="<?php echo $i; ?>" <?php echo ($i == $selectedYear) ? 'selected' : ''; ?>>
                        <?php echo $i; ?>
                      </option>
                    <?php endfor; ?>
                </select>
              </div>
              <div class="col-md-3">
                <!-- Botón para listar -->
                <button class="btn btn-success" id="btn_listar" onclick="listarPlanillaFecha()"><i class="fa fa-list"></i> Listar</button>
              </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover text-center" id="dtable_planilla">
                    <thead style="background-color:#000063;color:white">
                        <th>Año</th>
                        <th>Mes</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Fecha Ingreso</th>
                        <th>Sueldo Base</th>
                        <th>DS Nº 311-2022-EF</th>SNP/AFP
                        <th>Tardanza Horas (Desc)</th>
                        <th>Días Inasistidos (Desc)</th>
                        <th>Remuneración Bruta</th>
                        <th>SNP/AFP</th>
                        <th>Tipo AFP</th>
                        <th>Aporte ONP (13%)</th>
                        <th>Aporte AFP (10%)</th>
                        <th>Prima Seguro (1.7%)</th>
                        <th>Renta 4ta</th>
                        <th>Remuneracion Neta</th>
                    </thead>
                    
                    <tbody>
                        <?php
                        $planilla = $planilla->listar_planilla_fecha($selectedMonth, $selectedYear);

                        if ($planilla) {
                            foreach ($planilla as $pla) {
                                $sueldoBase = $pla["sueldo_base"];
                                $sueldoBase = str_replace(",", "", $sueldoBase); // Elimina comas si las hay
                                $sueldoBase = floatval($sueldoBase); // Convierte a float
                                
                                $N311 = 114.19;

                                $descuentoHoras = ($sueldoBase / 240 * $pla["total_tardanza_horas"]);
                                $descuentoHoras = number_format($descuentoHoras, 2, '.', ''); // Formatea a 2 decimales

                                $descuentoDiasInasistidos = ($sueldoBase / 30 * $pla["total_dias_inasistidos"]);
                                $descuentoDiasInasistidos = number_format($descuentoDiasInasistidos, 2, '.', ''); // Formatea a 2 decimales

                                // Calcula la remuneración bruta
                                $remuneracionBruta = $sueldoBase + $N311 - $descuentoHoras - $descuentoDiasInasistidos;
                                $remuneracionBruta = number_format($remuneracionBruta, 2, '.', ''); // Formatea a 2 decimales
                                $primaSeguro=0;
                                $aporte=$pla["afp"];
                                $aporteONP = 0;
                                $aporteAFP = 0;
                                $rentaCuarta=$pla["retencion_4cat"];
                                $descuentoRenta=0;
                                if($aporte==='ONP'){
                                  $aporteONP=$remuneracionBruta*0.13;
                                  $aporteONP = number_format($aporteONP, 2, '.', ''); // Formatea a 2 decimales
                                }else{
                                  $aporteAFP=$remuneracionBruta*0.10;
                                  $aporteAFP = number_format($aporteAFP, 2, '.', ''); // Formatea a 2 decimales
                                  $primaSeguro=$remuneracionBruta*0.017;
                                  $primaSeguro = number_format($primaSeguro, 2, '.', ''); // Formatea a 2 decimales
                                }   
                                if($rentaCuarta==='SI'){
                                  $descuentoRenta=$remuneracionBruta*0.08;
                                  $descuentoRenta = number_format($descuentoRenta, 2, '.', ''); // Formatea a 2 decimales
                                }  
                                $remuneracionNeta=$remuneracionBruta-$descuentoRenta-$primaSeguro-$aporteAFP-$aporteONP;               
                                
                        
                        ?>
                                <tr>
                                    <td><?php echo $pla["anio"]; ?></td>
                                    <td>
                                        <?php
                                        $numero_mes = $pla["mes"];
                                        
                                        // Array asociativo para los nombres de los meses en español
                                        $meses = array(
                                            1 => "Enero", 2 => "Febrero", 3 => "Marzo",
                                            4 => "Abril", 5 => "Mayo", 6 => "Junio",
                                            7 => "Julio", 8 => "Agosto", 9 => "Septiembre",
                                            10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
                                        );
                                        
                                        // Obtener el nombre del mes en español
                                        $nombre_mes = $meses[$numero_mes];
                                        
                                        echo $nombre_mes;
                                        ?>
                                    </td>
                                    <td><?php echo $pla["dni"]; ?></td>
                                    <td><?php echo $pla["nombres"]; ?></td>
                                    <td><?php echo $pla["apaterno"] . ' ' . $pla["amaterno"]; ?></td>
                                    <td><?php echo $pla["fecha_ingreso"]; ?></td>
                                    <td><?php echo 'S/.' . number_format($sueldoBase, 2, '.', ''); ?></td>
                                    <td><?php echo 'S/.' . number_format($N311, 2, '.', ''); ?></td>
                                    <td><?php echo $pla["total_tardanza_horas"] . ' (S/.' . $descuentoHoras . ')'; ?></td>
                                    <td><?php echo $pla["total_dias_inasistidos"] . ' (S/.' . $descuentoDiasInasistidos . ')'; ?></td>
                                    <td><?php echo 'S/.' . $remuneracionBruta; ?></td>
                                    <td><?php echo $pla["t_aportacion"];?></td>
                                    <td><?php echo $pla["afp"];?></td>
                                    <td><?php echo 'S/.' .$aporteONP;?></td>
                                    <td><?php echo 'S/.' .$aporteAFP;?></td>
                                    <td><?php echo 'S/.' .$primaSeguro;?></td>
                                    <td><?php echo 'S/.' .$descuentoRenta;?></td>
                                    <td><?php echo 'S/.' .$remuneracionNeta;?></td>
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="11"><span class="text-center">No se encontraron datos</span></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<script>
function listarPlanillaFecha() {
    var mes = document.getElementById('sel_mes_ini').value;
    var anio = document.getElementById('sel_anio').value;
    window.location.href = 'index.php?busqueda=reporte_planilla&sel_mes_ini=' + mes + '&sel_anio=' + anio;
}

$(document).ready(function() {
    $('#dtable_planilla').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    });
});
</script>
