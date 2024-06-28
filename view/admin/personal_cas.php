<?php
  include "./models/personal.model.php";
  include "./controllers/personal.controller.php";
  $personal = new PersonalController();
  $haceunmes = new DateTime($fec_hoy);
  $haceunmes->modify("-1 month");
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
                <!-- <div class="text-right">
                  <a class="btn btn-success mb-3" href="./excel/back_up_general.php">Generar Backup</a>
                </div> -->
                <div class="form-row mb-3">
                  <div class="col-md-3">
                    <input class="form-control" type="date" value="<?php echo $haceunmes->format("Y-m-d");?>" id="inpt_fec_ini" name="inpt_fec_ini" >
                  </div>
                  <div class="col-md-3">
                    <input class="form-control" type="date" id="inpt_fec_fin" name="inpt_fec_fin" value="<?php echo $fec_hoy;?>" >
                  </div>
                  <div class="col-mb-3">
                    <button class="btn btn-success" id="btn_generar_bkup"><i class="fa fa-file-excel"></i> Generar Backup</button>
                  </div>
                  <div class="col-mb-3">
                    <button class="btn btn-info" id="btn_add_per_cas"><i class="fa fa-user"></i> Agregar</button>
                  </div>
                  <div class="col-mb-3">
                    <a target="_blank" href="index.php?busqueda=asistencia_general">
                        <button class="btn btn-success" id="btn_reporte_general_tardanzas">Reporte Asistencia</button>
                    </a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover text-center" id="dtable_adm_personal">
                    <thead style="background-color:#000063;color:white">
                      <th>#</th>
                      <th>Apellidos y Nombres</th>
                      <th>Dni</th>
                      <th>Dependencia</th>
                      <th>Puesto</th>
                      <th>Cod_AIRHSP</th>
                      <th>Estado</th>
                      <th>Asistencias</th>
                    </thead>
                    <tbody>
                      <?php
                      if($personal->listar_personal()){
                        foreach ($personal->listar_personal() as $per) {?>
                          <tr id="tr_percas_<?php echo $per['id_personal']; ?>">
                            <td>
                              <?php echo $per['id_personal'];?>
                            </td>
                            <td class="text-left">
                              <?php echo $per["apaterno"].' '.$per["amaterno"].' '.$per["nombres"]; ?>
                            </td>
                            <td> <?php echo $per["dni_pa"]; ?></td>
                            <td> <?php echo $per["dependencia"] ; ?></td>
                            <td> <?php echo $per["puesto"]; ?></td>
                            <td> <?php echo $per["Cod_AIRHSP"]; ?></td>
                            <td>
                              <?php echo $estado->estado_usuario($per["estado"]); ?>
                            </td>
                            <td>
                              <div class="btn-group btn-sm">
                                <button data-toogle="tooltip" title="EDITAR datos del trabajador <?php echo $per["apaterno"].' '.$per["amaterno"].' '.$per["nombres"];?>" 
                                  type="button" class="btn btn-primary btn-sm mr-2" 
                                  onclick='editar_personal(`<?php echo json_encode($per); ?>`)'><i class="fa fa-edit"></i> </button>
                                  <?php if ($per["estado"] == "A") { ?>
                                    <form method="POST" action="./procesos/admin/deshabilitar_cas.php">
                                      <input hidden value="<?php echo $per["id_personal"];?>" name="id_personal"/> 
                                      <button title="Dar de baja al trabajador <?php echo $per["apaterno"].' '.$per["amaterno"].' '.$per["nombres"];?>" 
                                        type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button>
                                    </form>
                                  <?php }else{ ?>
                                    <form method="POST" action="./procesos/admin/habilitar_cas.php">
                                      <input hidden value="<?php echo $per["id_personal"];?>" name="id_personal"/> 
                                      <button data-toogle="tooltip" title="Habilitar trabajador <?php echo $per["apaterno"].' '.$per["amaterno"].' '.$per["nombres"];?>" 
                                        type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> </button>
                                    </form>
                                  <?php } ?>
                                <a data-toogle="tooltip" title="Ver ASISTENCIAS de <?php echo $per["apaterno"].' '.$per["amaterno"].' '.$per["nombres"]; ?>" target="_blank" href="index.php?busqueda=asistencia&dni=<?php echo $per["dni_pa"]; ?>" class="ml-2 btn btn-warning btn-sm"><i class="fa fa-clock"></i> </a>
                              </div>
                            </td>
                          </tr>
                          <?php                          
                        }
                      }else{?>
                        <tr>
                            <td colsapn="7"><span class="text-center">No se encontraron datos</span></td>
                          </tr>
                      <?php }
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
<!-- MODAL AGREGAR PERSONAL CAS -->
<div class="modal" id="modal_add_per_cas" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Personal CAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6 mb-3">
        <form method="POST" action="./procesos/admin/create_employed.php">
            <label>Apellido Paterno</label>
            <input class="form-control" type="text" name="apaterno" required>
          </div>
          <div class="col-lg-6 mb-3">
            <label>Apellido Materno</label>
            <input class="form-control" type="text" name="amaterno" required>
          </div>
        </div>
        <div class="form-group">
          <label for="">Nombres completos</label>
          <input type="text" class="form-control" name="nombres" required>
        </div>
        <div class="form-group">
          <label for="">Puesto</label>
          <input type="text" class="form-control" name="puesto" required>
        </div>
        <div class="form-group">
          <label for="">Dependencia</label>
          <input type="text" class="form-control" name="dependencia" required>
        </div>
        <div class="form-group">
          <label for="">DNI</label>
          <input type="text" class="form-control" name="dni" required>
        </div>
        <div class="form-group">
          <label for="">Celular</label>
          <input type="text" class="form-control" name="celular" required>
        </div>
        <div class="form-group">
          <label for="">Correo Personal</label>
          <input type="text" class="form-control" name="cor_per">
        </div>
        <div class="form-group">
          <label for="">Correo Institucional</label>
          <input type="text" class="form-control" name="cor_inst">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL AGREGAR PERSONAL -->
<!-- MODAL EDITAR DATOS DEL PERSONAL -->
<div class="modal" id="modal_edit_per_cas" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Personal CAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6 mb-1">
        <form method="POST" action="./procesos/admin/update_employed.php">
            <label>Apellido Paterno</label>
            <input class="form-control" type="text" id="ed_apaterno" name="ed_apaterno" required>
            <input hidden id="ed_id_personal" name="ed_id_personal">
          </div>
          <div class="col-lg-6 mb-3">
            <label>Apellido Materno</label>
            <input class="form-control" type="text" id="ed_amaterno" name="ed_amaterno" required>
          </div>
        </div>
        <div class="form-group">
          <label for="">Nombres completos</label>
          <input type="text" class="form-control" id="ed_nombres" name="ed_nombres" required>
        </div>
        <div class="form-group">
          <label for="">Puesto</label>
          <input type="text" class="form-control" id="ed_puesto" name="ed_puesto" required>
        </div>
        <div class="form-group">
          <label for="">Dependencia</label>
          <input type="text" class="form-control" id="ed_dependencia"  name="ed_dependencia" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ed_dni">DNI</label>
                    <input type="text" maxlength="8" class="form-control" id="ed_dni" name="ed_dni" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ed_celular">Celular</label>
                    <input maxlength="9" type="text" class="form-control" id="ed_celular" name="ed_celular">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Correo Personal</label>
              <input type="text" class="form-control" id="ed_cor_per" name="ed_cor_per">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Fecha Ingreso</label>
              <input type="date" class="form-control" id="f_ingreso" name="f_ingreso">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Correo Institucional</label>
              <input type="text" class="form-control" id="ed_cor_inst" name="ed_cor_inst">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Cod. AIRHSP</label>
              <input type="text" class="form-control" id="cod_airhsp" name="cod_airhsp">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Sueldo Base</label>
              <input type="text" class="form-control" id="su_base" name="su_base">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="pension">Renta 4ta Categoria</label>
              <select class="form-control" id="renta" name="renta">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label for="pension">Tipo de Pensión</label>
                <select class="form-control" id="t_pension" name="t_pension">
                  <option value="AFP">AFP</option>
                  <option value="ONP">ONP</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="pension">AFP</label>
                <select class="form-control" id="pension" name="pension">
                  <option value="ONP">ONP</option>
                  <option value="HABITAT">Habitat</option>
                  <option value="INTEGRA">Integra</option>
                  <option value="PROFUTURO">Profuturo</option>
                  <option value="PRIMA">Prima</option>
                </select>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL EDITAR DATOS -->
<script src="./js/datatable.js"></script>
<script>
  $(document).ready( function () {
    $('#dtable_adm_personal').DataTable();
  } );
  $("#btn_generar_bkup").click(function(){
    inicio = $("#inpt_fec_ini").val()
    fin = $("#inpt_fec_fin").val()
    url = "./excel/back_up_general.php?inicio="+inicio+"&fin="+fin
    window.location = url
    console.log(url)
  })
  $("#btn_add_per_cas").click(function(){
    $("#modal_add_per_cas").modal("show")
  })
  function editar_personal(personal){
    let datos = JSON.parse(personal)
    $("#ed_id_personal").val("")
    $("#ed_apaterno").val("")
    $("#ed_amaterno").val("")
    $("#ed_nombres").val("")
    $("#ed_dni").val("")
    $("#ed_celular").val("")
    $("#ed_cor_inst").val("")
    $("#ed_cor_per").val("")
    $("#ed_puesto").val("")
    $("#ed_dependencia").val("")
    $("#cod_airhsp").val("")
    $("#su_base").val("")
    $("#renta").val("")
    $("#t_pension").val("")
    $("#pension").val("")
    $("#f_ingreso").val("")
    $("#h_ingreso").val("")
    
    $("#ed_id_personal").val(datos.id_personal)    
    $("#ed_apaterno").val(datos.apaterno)
    $("#ed_amaterno").val(datos.amaterno)
    $("#ed_nombres").val(datos.nombres)
    $("#ed_dni").val(datos.dni_pa)
    $("#ed_celular").val(datos.cel_pa)
    $("#ed_cor_inst").val(datos.cor_inst)
    $("#ed_cor_per").val(datos.cor_per)
    $("#ed_puesto").val(datos.puesto)
    $("#ed_dependencia").val(datos.dependencia)
    $("#cod_airhsp").val(datos.Cod_AIRHSP)
    $("#su_base").val(datos.sueldo_base)
    $("#renta").val(datos.retencion_4cat)
    $("#t_pension").val(datos.t_aportacion)
    $("#pension").val(datos.afp)
    $("#f_ingreso").val(datos.fecha_ingreso)
    $("#h_ingreso").val(datos.hora_ingreso)
    $("#modal_edit_per_cas").modal("show")
  }
  // $("form[name='handle_submit_delete_employed']").on("submit", function(e){
  //   e.preventDefault()

  //   Swal.fire({
  //     title: 'Eliminar?',
  //     showDenyButton: true,
  //     showCancelButton: true,
  //     confirmButtonText: 'Si',
  //     denyButtonText: `No`,
  //   }).then((result) => {
  //     /* Read more about isConfirmed, isDenied below */
  //     if (result.isConfirmed) {
  //       $.ajax({
          
  //       })
  //     } else if (result.isDenied) {
  //       Swal.fire('Changes are not saved', '', 'info')
  //     }
  //   })
  //   $('#tr_percas_'+e.target.id_personal.value).hide();
  // })
</script>