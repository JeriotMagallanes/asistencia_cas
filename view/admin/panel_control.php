<?php
include "./helper/asistencia.php";
include "./models/transmisor.model.php";
include "./models/personal.model.php";
include "./controllers/transmisor.controller.php";
$transmisor = new TransmisorController;
$fec_hoy_fto2 = date("Y-m-d");
$fec_hoy_fto1 = date("d-m-Y");
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
        <div class="card">
            <div class="card-header ui-sortable-handle">
                <h4 class="card-title">
                <i class="fa fa-calendar mr-1"></i>
                    Marcaciones
                </h4>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#asistencias" data-toggle="tab">Asistecias</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#horas_trabajo" data-toggle="tab">Horas de trabajo</a>
                        </li> -->
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="asistencias">
                    <div class="row mb-2">
                        <div class="col-lg-3 float-right">
                            <input class="form-control" type="date" name="marc_sel_fecha1" id="marc_sel_fecha1" value="<?php echo $fec_hoy_fto2; ?>">
                        </div>
                    </div>
                    <div class="table-responsive table-wrapper-scroll-y" style="overflow:auto;">
                        <table class="table table-hover responsive no-wrap w-100" id="dtable_marcaciones">
                            <thead style="background-color:#000064;color:white;position: sticky; top: 0; z-index: 1;">
                                <th>Fecha de Registro</th>
                                <th>Hora</th>
                                <th>Tipo Asistencia</th>
                                <th>Datos del Personal</th>
                                <th>Sede</th>
                            </thead>
                        </table>
                    </div>
                    </div>
                    <div class="tab-pane" id="horas_trabajo">
                        <div class="row mb-2">
                            <div class="col-lg-3 float-right mb-3">
                                <input class="form-control" type="date" name="marc_sel_fecha" id="marc_sel_fecha" value="<?php echo $fec_hoy_fto2; ?>">
                            </div>
                        </div>
                        <table class="table-bordered w-100 table-hover" id="table_panel">
                            <thead class="text-center" style="justify-content:center;background-color:#000064;color:white">
                                <tr>
                                    <!-- <td rowspan="2">Puesto</td> -->
                                    <td class="text-center" rowspan="2">Personal</td>
                                    <td class="text-center" rowspan="2">Local</td>
                                    <td class="text-center" colspan="2">Mañana</td>
                                    <td class="text-center" colspan="2">Tarde</td>
                                    <td class="text-center" rowspan="2">TOTAL</td>
                                </tr>
                                <tr>
                                    <td>Entrada</td>
                                    <td>Salida</td>
                                    <td>Entrada</td>
                                    <td>Salida</td>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="tbody_nuevo_panel">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="mt-4">Transmisión</h4>
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
                        <td><?php echo LocalUndc::nombre_local(6); ?></td>
                        <?php
                        $local3 = $transmisor->ultimo_cron_local("6");
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
                </tbody>
            </table>
        </div>

    </div>
    </div>
    <script src="./js/datatable.js"></script>
    <script>
        var datatable_marcaciones = "";

        async function cargar_datos_nueva_tabla(){
            $("#tbody_nuevo_panel").html('<tr><td colspan="7"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></td></tr>');
            
            let fecha = $("#marc_sel_fecha").val()
            console.log(fecha);
            await $.ajax({
                url : "./ajax/panel_control/nuevo_reporte_asistencia.php",
                type:"POST",
                dataType:"JSON",
                data:{
                    "fec_asi": fecha
                },
                success:function(res){
                    let html = "";
                    if(res.length > 0){
                        res.forEach(item => {
                            if (item.cant_local == 1) {
                                html += "<tr>";
                                html += "<td "+(item.cant_local > 1 ? "rowspan='"+item.cant_local+"'" : "" )+">";
                                html += item.personal+"("+item.dni+")" 
                                html += "</td>";
                                item.asistencias.forEach(asistencia => {
                                    html += "<td>"
                                    html += asistencia.local
                                    html += "</td>"
                                    html += "<td id='td_"+asistencia.registros[1].id+"'>"
                                    html += asistencia.registros[1].hora
                                    html += "</td>"
                                    html += "<td id='td_"+asistencia.registros[2].id+"'>"
                                    html += asistencia.registros[2].hora
                                    html += "</td>"
                                    html += "<td id='td_"+asistencia.registros[3].id+"'>"
                                    html += asistencia.registros[3].hora
                                    html += "</td>"
                                    html += "<td id='td_"+asistencia.registros[4].id+"'>"
                                    html += asistencia.registros[4].hora
                                    html += "</td>"
                                    console.log(asistencia.registros)
                                    // asistencia.registros.forEach(list => {
                                    //     html += "<td>"
                                    //     html += list[0].hora
                                    //     html += "</td>"
                                    //     console.log(list)
                                    // });
                                });
                                html += "</tr>";
                            }
                        });
                    }else{
                        console.log("No hay registro")
                    }
                    $("#tbody_nuevo_panel").html(html)
                }
            })
        }
        $(document).ready(function() {
            cargar_data_table()
            cargar_datos_nueva_tabla()
        })
        $("#marc_sel_fecha").change(function(e) {
            cargar_datos_nueva_tabla();
        })

        function imprimir_fecha(fecha) {
            $.ajax({
                url: "./ajax/imprimir_fecha.php",
                type: "POST",
                dataType: "json",
                data: {
                    "fecha": fecha
                },
                success: function(res) {
                    $("#inp_fec_act").val(res.fecha)
                }
            })
        }

        function cargar_data_table() {
            let fecha = $("#marc_sel_fecha").val();

            datatable_marcaciones = $("#dtable_marcaciones").DataTable({
                paging: false,
                responsive: true,
                ajax: {
                    type: "POST",
                    url: "./ajax/panel_marcaciones.php",
                    data: {
                        "fecha": fecha
                    },
                }
            })
        }
        $(document).ready(function() {
            $(".tbtn").click(function() {
                // $(this).parents(".custom-table").find(".toggler1").aria-expanded();
                // $(this).parents("tbody").find(".toggler").addClass("toggler1");
                // $(this).parents(".custom-table").find(".fa-minus-circle").removeClass("fa-minus-circle");
                // $(this).parents("tbody").find(".fa-plus-circle").addClass("fa-minus-circle");
                $(this).parents()
            });
        });
        $("#marc_sel_fecha1").change(function (e) {
            $("#dtable_marcaciones").dataTable().fnDestroy();
            cargar_data_table()
        })
        async function cargar_data_table(){
            console.log("actualizando tabla")
            let fecha = $("#marc_sel_fecha1").val();
            datatable_marcaciones = await $("#dtable_marcaciones").DataTable({
                paging:false,
                responsive : true ,
                ajax : {
                    type : "POST",
                    url : "./ajax/panel_marcaciones.php",
                    data : {"fecha":fecha},
                }
            })
        }
    </script>