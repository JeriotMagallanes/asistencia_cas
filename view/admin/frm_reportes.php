<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Generar Reporte</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Reportes</li>
                    <li class="breadcrumb-item active">Generar</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-row mb-3">
                            <div class="col-md-3 mb-3">
                                <input class="form-control" id="sel_fecha" type="date" value="<?php echo date("Y-m-d");?>"
                                    id="inpt_fec_ini" name="inpt_fec_ini">
                            </div>
                            <div class="col-md-3 sm:text-center" style="display:block">
                                <button title="Actualizar tabla, lista de personal que asistió en la fecha indicada" class="btn btn-sm btn-warning" id="btn_generar_bkup">
                                    <i class="fa fa-refresh"></i>
                                    Actualizar
                                </button>
                                <button title="Guardar reporte" class="btn btn-sm btn-success" id="btn_generar_bkup">
                                    <i class="fa fa-save"></i>
                                    Guardar
                                </button>
                                <button title="Ver listado de reportes guardados o generados" class="btn btn-sm btn-danger" id="btn_add_per_cas">
                                    <i class="fa fa-eye"></i>
                                    Reportes
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-auto">
                        <table class="table">
                            <thead style="background-color:#000064;color:white">
                                <th>N°</th>
                                <th>Personal</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Total Hora</th>
                                <th>Total Minuto</th>
                            </thead>
                            <tbody id="tbody_asistencia">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<script src="./view/admin/tabla.js"></script>
<script>
    // listar_personal()
    // async function listar_personal(){
    //     const fecha = $("#sel_fecha").val()
    //     let registros_fecha = {}

    //     const response = await $.ajax({
    //         url : "./ajax/admin/reporte/listar_personal_by_fecha.php",
    //         type: "POST",
    //         data : {"fecha":fecha}
    //     })
    //     const registros = JSON.parse(response)
    //     if (registros.length > 0) {
    //         registros.forEach(element => {
    //             fec_reg = element.
    //         });
    //     }else{
    //         $("#tbody_asistencia").html("<tr><td colspan='8' class='text-center'>No se encontraron datos</td></tr>")
    //     }
    // }
    // $("#sel_fecha").change(function(){
    //     listar_personal()
    // })
</script>