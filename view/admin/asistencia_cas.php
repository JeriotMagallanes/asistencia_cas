<?php 
  include "./models/personal.model.php";
  include "./controllers/personal.controller.php";
  $personal = new PersonalController();
  $datospersonal = $personal->buscar_info_personal($_GET["dni"]);
  $haceunmes = new DateTime($fec_hoy);
  $haceunmes->modify("-1 month");
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Asistencias</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?busqueda=personal_cas">Home</a></li>
          <li class="breadcrumb-item">Personal CAS</li>
          <li class="breadcrumb-item">Asistencia</li>
          <li class="breadcrumb-item active"><?php echo $_GET["dni"];?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 mb-3">
        <div class="card shadow">
          <div class="card-header">
            <h6 class="text-left">INFORMACIÓN PERSONAL</h6>
          </div>
          <div class="card-body">
            
            <div class="container">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="txtape">Apellido Paterno</label>
                  <input type="text" id="txtape" class="form-control" value="<?php echo $datospersonal[0]["apaterno"];?>" disabled>
                </div>
                <div class="col-md-6">
                  <label for="txtape">Apellido Materno</label>
                  <input type="text" id="txtape" class="form-control" value="<?php echo $datospersonal[0]["amaterno"];?>" disabled>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label for="txtname">Nombres</label>
                  <input type="text" id="txtname" class="form-control" value="<?php echo $datospersonal[0]["nombres"];?>" disabled>
                </div>
                <div class="col-md-6">
                  <label for="txtape">Dni</label>
                  <input type="text"  class="form-control" value="<?php echo $datospersonal[0]["dni_pa"];?>" disabled>
                  <input type="hidden" id="inpt_dni" class="form-control" value="<?php echo $datospersonal[0]["dni_pa"];?>">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12">
                  <label for="txtname">Dependencia</label>
                  <input type="text" id="txtname" class="form-control" value="<?php echo $datospersonal[0]["dependencia"];?>" disabled>
                </div>
                <div class="col-md-12">
                  <label for="txtape">Puesto</label>
                  <input type="text" id="txtape" class="form-control" value="<?php echo $datospersonal[0]["puesto"];?>" disabled>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="card shadow">
          <div class="card-header">
            <h6 class="text-left">REGISTRO DE ASISTENCIA</h6>
          </div>
          <div class="card-body">
          <div class="form-row mb-3">
                  <div class="col-md-3 mb-3">
                    <input class="form-control" type="date" value="<?php echo $haceunmes->format("Y-m-d");?>" id="inpt_fec_ini" name="inpt_fec_ini" >
                  </div>
                  <div class="col-md-3 mb-3">
                    <input class="form-control" type="date" id="inpt_fec_fin" name="inpt_fec_fin" value="<?php echo $fec_hoy;?>" >
                  </div>
                  <div class="col-mb-3 mb-3">
                    <button class="btn btn-success" id="generar_excel" ><i class="fa fa-file-excel"></i> Generar Backup</button>
                    <button class="btn btn-danger" id="generar_pdf" ><i class="fa fa-file-pdf"></i> Generar Backup</button>
                  </div>
                </div>
                <hr>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="t_mes">Mes</label>
                  <select class="form-control" name="t_mes" id="t_mes">
                    <option value="" hidden>Seleccione</option>
                    <option <?php echo date("m") == 1 ? "selected" : ""; ?> value="1">Enero</option>
                    <option <?php echo date("m") == 2 ? "selected" : ""; ?> value="2">Febrero</option>
                    <option <?php echo date("m") == 3 ? "selected" : ""; ?> value="3">Marzo</option>
                    <option <?php echo date("m") == 4 ? "selected" : ""; ?> value="4">Abril</option>
                    <option <?php echo date("m") == 5 ? "selected" : ""; ?> value="5">Mayo</option>
                    <option <?php echo date("m") == 6 ? "selected" : ""; ?> value="6">Junio</option>
                    <option <?php echo date("m") == 7 ? "selected" : ""; ?> value="7">Julio</option>
                    <option <?php echo date("m") == 8 ? "selected" : ""; ?> value="8">Agosto</option>
                    <option <?php echo date("m") == 9 ? "selected" : ""; ?> value="9">Setiembre</option>
                    <option <?php echo date("m") == 10 ? "selected" : ""; ?> value="10">Octubre</option>
                    <option <?php echo date("m") == 11 ? "selected" : ""; ?> value="11">Noviembre</option>
                    <option <?php echo date("m") == 12 ? "selected" : ""; ?> value="12">Diciembre</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="">Año</label>
                  <select class="form-control" name="t_year" id="t_year">
                    <option value="" hidden>Seleccione</option>
                    <option <?php echo date("Y") == 2023 ? "selected" : ""; ?> value="2023">2023</option>
                    <option <?php echo date("Y") == 2024 ? "selected" : ""; ?> value="2024">2024</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <button onclick="ver_reporte_tardanza()" class="btn btn-danger mt-4">Tardanzas</button>
                </div>
              </div>
            </div>
          </div>
          <hr>
            <div class="row">
              <div class="col-lg-10 col-xl-8 mx-auto">
                <div class="table-responsive">
                  <table class="table w-100 responsive no-wrap" id="dtable_asistencia">
                    <thead>
                      <th>#</th>
                      <th data-priority="1">Fecha de Registro</th>
                      <th>Dia Semana</th>
                      <th data-priority="2">Marcaciones</th>
                    </thead>
                    
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!--END ROW -->
  </div><!-- /.container-fluid -->
</section>
<div class="modal" id="modal_ver_asi_reg" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Fecha de Registro</label>
          <input class="form-control" type="text" disabled id="fec_reg_marc" name="fec_reg_marc">
        </div>
        <div class="form-group">
          <table class="table">
            <tbody>
              <tr>
                <td>Total de Horas</td>
                <td>:</td>
                <td><span id="total_horas_trabajo"></span></td>
              </tr>
              <tr>
                <td>Puntualidad</td>
                <td>:</td>
                <td><span id="total_tardanza"></span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="table-responsive">
          <label for="">Marcaciones</label>
          <table class="table table-hover table-striped">
            <thead style="background-color:#000064;color:white">
              <th>Hora</th>
              <th>Tipo</th>
              <th>Local</th>
              <!-- <th>Acción</th> -->
            </thead>
            <tbody id="tbody_marcaciones"></tbody>
          </table>
        </div>
        <br>
        <div class="table-responsive">
          <label>Papeletas de Comisión</label>
          <table class="table table-hover table-striped">
            <thead style="background-color:#000064;color:white">
              <th>Entrada</th>
              <th>Salida</th>
              <th>Acción</th>
            </thead>
            <tbody id="tbody_pcomision"></tbody>
          </table>
        </div>
        <br>
        <div class="table-responsive">
          <label>Papeleta Personal</label>
          <table class="table table-hover table-striped">
            <thead style="background-color:#000064;color:white">
              <th>Hora</th>
              <th>Tipo</th>
              <th>Local</th>
            </thead>
            <tbody id="tbody_ppersonal"></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script src="./js/datatable.js"></script>
<script>
  var dtable_asistencia = "";
  $(document).ready(function(){
    let dni = getParameterByName('dni')
    if (dni.length <= 7 && dni == "") {
      window.location.href = "index.php?busqueda=personal_cas";
    }
    cargar_marcaciones()
	});
  function cargar_marcaciones(){
    let dni = $("#inpt_dni").val()
    dtable_asistencia = $("#dtable_asistencia").DataTable({
      'pageLength': 50,
      "responsive":true,
      ajax : {
        url : "./ajax/admin/personal/ver_fechas_registro.php",
        type: "POST",
        data : {"dni":dni}
      }
    })
  }
  function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
  async function ver_asistencias(fecha, dni) { // modal
    $("#fec_reg_marc").val(fecha)
    await $.ajax({
      url: "./ajax/admin/personal/ver_marcaciones.php",
      type: "POST",
      dataType: "JSON",
      data: {
        "fecha": fecha,
        "dni": dni
      },
      success: function (res) {
        let marc_html = ``;
        let total_trabajo = ``;
        let tt_tardanza = ``;
        let contador = 1;
        // Para las marcaciones
        if (res.marcaciones.asistencia.length > 0) {
          $("#total_horas_trabajo").html(res.marcaciones.total_horas)
          res.marcaciones.asistencia.forEach(element => {
            marc_html += `<tr>`;
            marc_html += `<td>${element.hora}</td>`;
            marc_html += `<td>${element.tipo}</td>`;
            marc_html += `<td>${element.local}</td>`;
            // marc_html += `
            // <td class="d-flex">
            //   <button disabled class="btn btn-sm btn-danger" onclick="Swal.fire({icon : 'success',title:'Eliminnado!'})" title="Eliminar"><i class="fa fa-trash"></i></button>
            //   <button disabled class="btn btn-sm btn-warning" onclick="Swal.fire({icon : 'warning',title:'Editado'})" title="Editar"><i class="fa fa-edit"></i></button>
            // </td>`
            marc_html += `</tr>`;
            if (contador == 1) { // el primer registro del dia
              let horaEntrada = new Date(`${element.fecha} 08:00:00`);
              let horaRegistro = new Date(`${element.fecha} ${element.hora}`);
              let diferenciaEnMillisegundos = horaRegistro - horaEntrada;
              let minutosDeTardanzaOtemprano = Math.floor(diferenciaEnMillisegundos / 60000);
              if (minutosDeTardanzaOtemprano < 0) {
                tt_tardanza = `<span class="text-success">Puntual ${Math.abs(minutosDeTardanzaOtemprano)} minutos antes</span>` //MAth.abs retonar valor absoluto
              } else if (minutosDeTardanzaOtemprano === 0) {
                tt_tardanza = `<span class="text-primary">Puntual`;
              } else {
                tt_tardanza = `Tardanza de <span class="text-danger">${minutosDeTardanzaOtemprano} minutos</span>`
              }
            }
            contador ++;
          });
        } else {
          marc_html = `<tr>
          <td class="text-center" colspan="4">No se encontraron datos</td>
          </tr>`
        }
        $("#total_tardanza").html(tt_tardanza)
        $("#tbody_marcaciones").html(marc_html)
        // Para las papeletas comision
        let pap_com = ``
        if (res.papeleta_comision.length > 0) {
        } else {
          pap_com = `
          <tr>
            <td class="text-center" colspan="3">No se encontraron registros</td>
          </tr>`
        }
        $("#tbody_pcomision").html(pap_com)
        // Para las papeletas personal
        let pap_per = ``
        if (res.papeleta_personal.length > 0) {

        } else {
          pap_per = `
          <tr>
            <td class="text-center" colspan="3">No se encontraron registros</td>
          </tr>
          `
        }
        $("#tbody_ppersonal").html(pap_per)
      }
    })
    $("#modal_ver_asi_reg").modal("show")
  }
  $("#generar_excel").click(function(){
    let inicio = $("#inpt_fec_ini").val()
    let fin = $("#inpt_fec_fin").val()
    let dni = $("#inpt_dni").val()
    let url = "./excel/back_up_personal.php?inicio="+inicio+"&fin="+fin+"&dni="+dni
    window.open(url,'_blank')
  })
  $("#generar_pdf").click(function(){
    let inicio = $("#inpt_fec_ini").val()
    let fin = $("#inpt_fec_fin").val()
    let dni = $("#inpt_dni").val()
    let url = "./pdf/back_up_personal.php?inicio="+inicio+"&fin="+fin+"&dni="+dni
    window.open(url,'_blank')
  })
  function ver_reporte_tardanza(){
    let mes = $("#t_mes").val();
    let year = $("#t_year").val();
    let dni = <?php echo $_GET["dni"]; ?>;
    window.open(`./view/admin/reporte_tardanza.php?year=${year}&mes=${mes}&dni=${dni}`,'Reporte de tardanza','width=1230,height=250')
  }
</script>