<?php
$currentMonth = date('n'); // Obtener el mes actual en formato numérico
$currentYear = date('Y'); // Obtener el año actual en formato numérico
$selectedMonth = isset($_GET['sel_mes_ini']) ? $_GET['sel_mes_ini'] : $currentMonth;
$selectedYear = isset($_GET['sel_anio']) ? $_GET['sel_anio'] : $currentYear;

include "./models/personal.model.php";
include "./controllers/personal.controller.php";

$personal = new PersonalController();
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Personal CAS</h1>
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
                <button class="btn btn-success" id="btn_listar" onclick="listarAsistencias()"><i class="fa fa-list"></i> Listar</button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-hover text-center" id="asistencia_general">
                <thead style="background-color:#000063;color:white">
                  <tr>
                    <th>#</th>
                    <th class="col">Nombres</th>
                    <th class="col">Apellidos</th>
                    <th class="col">Dni</th>
                    <?php for ($i = 1; $i <= 31; $i++): ?>
                      <th class="col"><?php echo $i; ?></th>
                    <?php endfor; ?>
                    <th class="col">Total Tardanza (min)</th>
                    <th class="col">Total Tardanza descuento</th>
                    <th class="col">Total Tardanza horas</th>
                    <th class="col">Total días inasistidos</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $asistencias = $personal->listar_asistencias_personal($selectedMonth, $selectedYear);
                  if ($asistencias):
                    foreach ($asistencias as $index => $per):
                      // Inicializar contadores de tardanza y descuento
                      $totalTardanza = 0;
                      $totalTardanzaDescuento = 0;
                      $totalDiasInasistidos = 0; // Contador de días inasistidos
                      $semanaTardanza = 0; // Contador semanal de tardanza

                      // Variables para controlar la semana anterior
                      $semanaActual = 1;
                      $tardanzaSemana = 0;

                      for ($i = 1; $i <= 31; $i++) {
                        $horaIngreso = $per["dia_$i"];
                        if ($horaIngreso !== 'S' && $horaIngreso !== 'D' && $horaIngreso !== 'I' && $horaIngreso !== 'F') {
                          // Calcular tardanza solo si es una hora válida (no 'S', 'D', 'I', 'F')
                          $horaIngresoDateTime = DateTime::createFromFormat('h:i:s A', $horaIngreso);
                          $horaReferencia = DateTime::createFromFormat('h:i:s A', '08:00:00 AM');
                          if ($horaIngresoDateTime > $horaReferencia) {
                            $intervalo = $horaReferencia->diff($horaIngresoDateTime);
                            $minutosTardanza = ($intervalo->h * 60) + $intervalo->i;
                            $totalTardanza += $minutosTardanza;

                            // Determinar semana y aplicar descuento si corresponde
                            $diaDelMes = $i;
                            $semanaDelMes = ceil($diaDelMes / 7); // Obtener la semana del mes

                            if ($semanaDelMes != $semanaActual) {
                              // Almacenar el descuento de la semana anterior
                              if ($tardanzaSemana > 5) {
                                $totalTardanzaDescuento += $tardanzaSemana - 5;
                              }
                              // Reiniciar contadores para la nueva semana
                              $semanaActual = $semanaDelMes;
                              $tardanzaSemana = 0;
                            }
                            // Acumular la tardanza semanal
                            $tardanzaSemana += $minutosTardanza;
                          }
                        } elseif ($horaIngreso === 'I') {
                          // Contabilizar los días inasistidos
                          $totalDiasInasistidos++;
                        }
                      }

                      // Procesar la última semana del mes
                      if ($tardanzaSemana > 5) {
                        $totalTardanzaDescuento += $tardanzaSemana - 5;
                      }

                  ?>
                      <tr id="tr_percas_<?php echo $per['dni_pa']; ?>">
                        <td><?php echo $index + 1; ?></td>
                        <td class="text-left"><?php echo $per["nombres"]; ?></td>
                        <td class="text-left"><?php echo $per["apaterno"] . ' ' . $per["amaterno"]; ?></td>
                        <td><?php echo $per["dni_pa"]; ?></td>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                          $horaIngreso = $per["dia_$i"];
                          // Mostrar hora de ingreso en la tabla
                          echo '<td>' . $horaIngreso . '</td>';
                        }
                        $totalTardanzaEnHoras = $totalTardanzaDescuento / 60;
                        ?>
                        <td><?php echo $totalTardanza; ?></td>
                        <td><?php echo $totalTardanzaDescuento; ?></td>
                        <td><?php echo number_format($totalTardanzaEnHoras, 2); ?></td>
                        <td><?php echo $totalDiasInasistidos; ?></td>
                      </tr>
                  <?php
                    endforeach;
                  else:
                  ?>
                    <tr>
                      <td colspan="36"><span class="text-center">No se encontraron datos</span></td>
                    </tr>
                  <?php endif; ?>
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
function listarAsistencias() {
    var mes = document.getElementById('sel_mes_ini').value;
    var anio = document.getElementById('sel_anio').value;
    window.location.href = 'index.php?busqueda=asistencia_general&sel_mes_ini=' + mes + '&sel_anio=' + anio;
}

$(document).ready(function() {
    $('#asistencia_general').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    });
});
</script>
