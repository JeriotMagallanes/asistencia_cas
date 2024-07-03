<?php
  $haceunmes = new DateTime($fec_hoy);
  $haceunmes->modify("-1 month");
  $currentMonth = date('n'); // Obtener el mes actual en formato numérico
  $currentYear = date('Y'); // Obtener el año actual en formato numérico
  $selectedMonth = isset($_GET['sel_mes_ini']) ? $_GET['sel_mes_ini'] : $currentMonth;
  $selectedYear = isset($_GET['sel_anio']) ? $_GET['sel_anio'] : $currentYear;
?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Importar Asistencias</h1>
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
                <!-- <div class="text-right">
                  <a class="btn btn-success mb-3" href="./excel/back_up_general.php">Generar Backup</a>
                </div> -->
                <form method="post" action="./procesos/admin/importar_asistencia.php" enctype="multipart/form-data">
                    <div class="form-row mb-3">
                        
                        <div class="col-md-1">
                            <label for="">Mes: </label>
                        </div>
                        <div class="col-md-3">
                            <!-- Selector de mes -->
                            
                            <select class="form-control" id="mes" name="mes">
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
                    </div>
                    
                    <div class="form-row mb-3">
                        <div class="col-md-1">
                            <label for="">Año: </label>
                        </div>
                        <div class="col-md-3">
                            <!-- Selector de año -->
                            <select class="form-control" id="anio" name="anio">
                                <?php for ($i = $currentYear; $i >= 2023; $i--): ?>
                                <option value="<?php echo $i; ?>" <?php echo ($i == $selectedYear) ? 'selected' : ''; ?>>
                                    <?php echo $i; ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row mb-3">
                        <div class="col-md-2">
                            <label for="">Archivo Excel: </label>
                        </div>
                        <div class="col-md-3">
                            <!-- Selector de año -->
                            <input type="file" name="excelFile" id="excelFile" required>
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <button class="btn btn-primary" type="submit">Importar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>