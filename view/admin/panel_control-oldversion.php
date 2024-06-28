<?php
include "./models/transmisor.model.php";
include "./models/personal.model.php";
include "./controllers/transmisor.controller.php";
$transmisor = new TransmisorController;
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Panel de Control</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Administradores</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <h4>Marcaciones</h4>
        <div class="table-responsive table-wrapper-scroll-y" style="overflow:auto;position: relative;height: 400px;">
            <table class="table table-hover">
                <thead style="background-color:#000064;color:white">
                    <th>Local</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Datos del Personal</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(1); ?></td>
                        <?php  
                            $reglocal1 = $transmisor->ultimos_registros("1");
                        ?>
                        <td id="marc_fec_local1"><?php echo FormatoFecha::formato_fecha($reglocal1["fec_reg"]); ?></td>
                        <td id="marc_hor_local1"><?php echo $reglocal1["hora_reg"]; ?></td>
                        <td id="marc_per_local1"><?php echo $reglocal1["personal"]; ?></td>

                    </tr>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(2); ?></td>
                        <?php  
                            $reglocal2 = $transmisor->ultimos_registros("2");
                        ?>
                        <td id="marc_fec_local2"><?php echo FormatoFecha::formato_fecha($reglocal2["fec_reg"]); ?></td>
                        <td id="marc_hor_local2"><?php echo $reglocal2["hora_reg"]; ?></td>
                        <td id="marc_per_local2"><?php echo $reglocal2["personal"]; ?></td>

                    </tr>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(3); ?></td>
                        <?php  
                            $reglocal3 = $transmisor->ultimos_registros("3");
                        ?>
                        <td id="marc_fec_local3"><?php echo FormatoFecha::formato_fecha($reglocal3["fec_reg"]); ?></td>
                        <td id="marc_hor_local3"><?php echo $reglocal3["hora_reg"]; ?></td>
                        <td id="marc_per_local3"><?php echo $reglocal3["personal"]; ?></td>

                    </tr>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(4); ?></td>
                        <?php  
                            $reglocal4 = $transmisor->ultimos_registros("4");
                        ?>
                        <td id="marc_fec_local4"><?php echo FormatoFecha::formato_fecha($reglocal4["fec_reg"]); ?></td>
                        <td id="marc_hor_local4"><?php echo $reglocal4["hora_reg"]; ?></td>
                        <td id="marc_per_local4"><?php echo $reglocal4["personal"]; ?></td>

                    </tr>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(5); ?></td>
                        <?php  
                            $reglocal5 = $transmisor->ultimos_registros("5");
                        ?>
                        <td id="marc_fec_local5"><?php echo FormatoFecha::formato_fecha($reglocal5["fec_reg"]); ?></td>
                        <td id="marc_hor_local5"><?php echo $reglocal5["hora_reg"]; ?></td>
                        <td id="marc_per_local5"><?php echo $reglocal5["personal"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h4>Transmisión</h4>
        <div class="table-responsive" style="overflow:auto">
            <table class="table table-hover">
                <thead style="background-color:#000064;color:white">
                    <th>Local</th>
                    <th>Fecha</th>
                    <th>Ultima transmisión</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(1); ?></td>
                        <?php  
                            $local1 = $transmisor->ultimo_cron_local("1");
                        ?>
                        <td><?php echo FormatoFecha::formato_fecha2($local1["fecha"]); ?></td>
                        <td><?php echo $local1["hora"]; ?></td>
                        

                    </tr>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(2); ?></td>
                        <?php  
                            $local2 = $transmisor->ultimo_cron_local("2");
                        ?>
                        <td><?php echo FormatoFecha::formato_fecha2($local2["fecha"]); ?></td>
                        <td><?php echo $local2["hora"]; ?></td>
                       

                    </tr>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(3); ?></td>
                        <?php  
                            $local3 = $transmisor->ultimo_cron_local("3");
                        ?>
                        <td><?php echo FormatoFecha::formato_fecha2($local3["fecha"]); ?></td>
                        <td><?php echo $local3["hora"]; ?></td>
                        

                    </tr>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(4); ?></td>
                        <?php  
                            $local4 = $transmisor->ultimo_cron_local("4");
                        ?>
                        <td><?php echo FormatoFecha::formato_fecha2($local4["fecha"]); ?></td>
                        <td><?php echo $local4["hora"]; ?></td>
                       

                    </tr>
                    <tr>
                        <td><?php echo LocalUndc::nombre_local(5); ?></td>
                        <?php  
                            $local5 = $transmisor->ultimo_cron_local("5");
                        ?>
                        <td><?php echo FormatoFecha::formato_fecha2($local5["fecha"]); ?></td>
                        <td><?php echo $local5["hora"]; ?></td>
                       
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
<script>
    setInterval(() => {
        actualizar_marcaciones()       
    }, 10000);
    function actualizar_marcaciones(){
        console.log("actualizando ...")
    }
</script>