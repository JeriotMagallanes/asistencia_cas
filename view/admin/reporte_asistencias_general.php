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
    $('#asistencia_general').DataTable();
});
</script>
