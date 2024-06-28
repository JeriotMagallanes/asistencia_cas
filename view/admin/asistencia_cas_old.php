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
        <h5 class="modal-title">Marcaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <label>Fecha de Registro</label>
          <input class="form-control" type="text" disabled id="fec_reg_marc" name="fec_reg_marc">
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead>
              <th>Hora</th>
              <th>Local</th>
            </thead>
            <tbody id="tbody_asi_reg"></tbody>
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
        url : "./ajax/ver_marcaciones.php",
        type: "POST",
        data : {"dni":dni}
      }
    })
  }
  // async function cargar_marcaciones(){
  //   const databody = {
  //     'dni':'<?php echo $_GET["dni"];?>'
  //   };
  //   console.log(databody)
  //   const response = await fetch("./ajax/ver_marcaciones.php", 
  //     {
  //       method:'POST',
  //       headers: {
  //       'Content-Type': 'application/json',
  //       },
  //       body: JSON.stringify(databody)
  //     })
  //   cargar_data_table(response.json())
  // }
  function cargar_data_table(response){
    let datos = response["content "]
    console.log(datos)
    let html = ''
    // datos.forEach((element) => {
    //   html += "DNI: "+element.dni+"/"
    // });
    // console.log("Mi html "+html)
  }
  function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
  function ver_asistencias( fecha, marcaciones){
    $("#fec_reg_marc").val(fecha)
    registro = JSON.parse(marcaciones)
    let tabla_asi = ""
    registro.forEach((item)=> {
      tabla_asi += "<tr>"
      tabla_asi +=  "<td>"
      tabla_asi +=  item.hora
      tabla_asi +=  "</td>"
      tabla_asi +=  "<td>"
      tabla_asi +=  item.local
      tabla_asi +=  "</td>"
      tabla_asi += "</tr>"
    })
    $("#tbody_asi_reg").html(tabla_asi)
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
</script>