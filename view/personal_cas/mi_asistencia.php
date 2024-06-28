<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Mi Asistencia</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Personal Cas</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3 d-flex">
                            <input type="text" class="form-control" id="sel_fec_reg" name="sel_fec_reg" value="">
                            <button onclick="cargar_asistencias()" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="table-responsive table-wrapper-scroll-y" style="overflow:auto">
                        <table class="table table-sm table-striped table-hover table-border">
                            <thead style="background-color:#000064;color:white">
                                <th>N°</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Tipo</th>
                                <th>Dia de la Semana</th>
                                <th>Local</th>
                            </thead>
                            <tbody id="tbody_asistencias">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
    $(document).ready(function(){
        $('#sel_fec_reg').daterangepicker();
        $(function () {
            $('#sel_fec_reg').daterangepicker({
                "locale": {
                    "format": "MM/DD/YYYY",
                    "separator": " - ",
                    "applyLabel": "Guardar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "Hasta",
                    "customRangeLabel": "Personalizar",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Setiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                },
                "maxDate" :  "<?php echo date('m/d/Y'); ?>",
                "startDate" : "<?php echo date('m/d/Y'); ?>",
                "endDate" : "<?php echo date('m/d/Y'); ?>",
                "minYear" : "2023",
                "opens": "center"
            });
        });
        cargar_asistencias();
    })

    async function cargar_asistencias(){
        let rango_fecha = $('#sel_fec_reg').val()
        const response = await $.ajax({
            url : './ajax/personal/mi_asistencia/mostrar_asistencia.php',
            type: 'POST',
            dataType:'JSON',
            data:{'rango_fecha':rango_fecha}
        })
        let html ='';
        let cont = 1;
        if (response.estado == 1) {
            response.data.forEach(item => {
                html += `
                <tr>
                    <td>${cont++}</td>
                    <td>${item.fecha_registro}</td>
                    <td>${item.hora_registro}</td>
                    <td>${tipo_asistencia(item.registro)}</td>
                    <td>${item.dia_semana}</td>
                    <td>${nonm_locales(item.local)}</td>

                </tr>`;
            })
        }else{
            html = `<tr><td colspan="6" class="text-center">No se encontraron registros</td></tr>`;
        }
        $("#tbody_asistencias").html(html)
    }
    function nonm_locales(local){
        if (local =="" || local > 7) {return ""}
        locales = [
            "Casa de la Cultura",
            "Sede C.N.I.",
            "Casuarinas",
            "Lunahuaná",
            "San Agustin",
            "Hualcara",
            "San Luis"
        ];
        return locales[local-1]
    }
    function tipo_asistencia(tipo=0){
        tipos = [
            "",
            "Entrada",
            "Salida"
        ]
        return tipos[tipo];
    }
</script>