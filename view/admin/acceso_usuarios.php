<?php
  include "./models/usuario.model.php";
  include "./controllers/usuario.controller.php";
  $usuario = new UsuarioController();
  $admin = $usuario->listar_usuarios();
?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Usuarios</h1>
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
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header text-right">
                    <button class="btn btn-md btn-primary btn-rounded " onclick="abrir_modal_adduser()"><i class="fa fa-plus"></i> Agregar</button>
                </div>
              <div class="card-body">
                <!-- <div class="text-right">
                  <a class="btn btn-success mb-3" href="./excel/back_up_general.php">Generar Backup</a>
                </div> -->
                <div class="table-responsive">
                  <table class="table table-hover text-center table-striped" id="dtable_adm_personal">
                    <thead style="background-color:#000063;color:white">
                      <th>#</th>
                      <th>Apellidos</th> 
                      <th>Nombres</th>
                      <th>Correo</th>
                      <th>Correo Institucional</th>
                      <th>Estado</th>
                      <th>Rol</th>
                      <th>Editar</th>
                    </thead>
                    <tbody>
                      <?php
                      if($admin){
                        $contador = 1;
                        foreach ($admin as $admin) {?>
                          <tr>
                            <td><?php echo $contador;?></td>
                            <td class="text-left"><?php echo $admin["ape_pat"]." ".$admin["ape_mat"];?></td>
                            <td class="text-left"><?php echo $admin["nom_usu"];?></td>
                            <td class="text-left"><?php echo $admin["cor_per"];?></td>
                            <td class="text-left"><?php echo $admin["cor_inst"];?></td>
                            <td><?php echo $estado->estado_usuario($admin["estado"]); ?></td>
                            <td><?php echo $roles->rol_name($admin["rol"]); ?></td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick='editar_usuario(`<?php echo json_encode($admin); ?>`)'>
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                          </tr>
                        <?php
                        $contador += 1;
                        }
                      }else{?>
                        <tr>
                            <td colsapn="5"><span class="text-center">No se encontraron datos</span></td>
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
<div class="modal" id="modal_add_usuario" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Administrador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
            <div class="col-lg-6">
                <form method="POST" action="./procesos/admin/create_user.php">
                <label for="">Apellido Paterno</label>
                <input type="text" class="form-control" id="cr_apepat" name="cr_apepat" required>
            </div>
            <div class="col-lg-6">
                <label for="">Apellido Materno</label>
                <input type="text" class="form-control" id="cr_apemat" name="cr_apemat" required>
            </div>
        </div>
        <div class="form-group">
            <label for="">Nombres</label>
            <input type="text" class="form-control" id="cr_nombres" name="cr_nombres" required>
        </div>
        <div class="form-group">
            <label for="">Correo Gmail</label>
            <input type="text" class="form-control" id="cr_gmail" name="cr_gmail" required>
        </div>
        <div class="form-group">
            <label for="">Correo Institucional</label>
            <input type="text" class="form-control" id="cr_inst" name="cr_inst" required>
        </div>
        <div class="form-group">
            <label for="">Estado</label>
            <select class="form-control" name="sel_cr_est" id="sel_cr_est" required>
                <option value="" hidden>Seleccione</option>
                <option value="A">Activo</option>
                <option value="I">Inactivo</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btn_cr_usu" ><i class="fa fa-save"></i> Registrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modal_editar_usuario" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar Administrador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
            <div class="col-lg-6">
                <form method="POST" action="./procesos/admin/update_user.php">
                <label for="">Apellido Paterno</label>
                <input type="text" class="form-control" id="ed_apepat" name="ed_apepat">
                <input type="hidden" name="ed_idusu" id="ed_idusu">
            </div>
            <div class="col-lg-6">
                <label for="">Apellido Materno</label>
                <input type="text" class="form-control" id="ed_apemat" name="ed_apemat">
            </div>
        </div>
        <div class="form-group">
            <label for="">Nombres</label>
            <input type="text" class="form-control" id="ed_nombres" name="ed_nombres">
        </div>
        <div class="form-group">
            <label for="">Correo Gmail</label>
            <input type="text" class="form-control" id="ed_gmail" name="ed_gmail">
        </div>
        <div class="form-group">
            <label for="">Correo Institucional</label>
            <input type="text" class="form-control" id="ed_inst" name="ed_inst">
        </div>
        <div class="form-group">
            <label for="">Estado</label>
            <select class="form-control" name="sel_ed_est" id="sel_ed_est">
                <option value="" hidden>Seleccione</option>
                <option value="A">Activo</option>
                <option value="I">Inactivo</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="btn_ed_usu" >Actualizar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="./js/datatable.js"></script>
<script>
    $(document).ready( function () {
        $('#dtable_adm_personal').DataTable();
    } );
    function editar_usuario(datos){
        registro = JSON.parse(datos)
        $("#ed_idusu").val(registro["id_usu"])
        $("#ed_apepat").val(registro["ape_pat"])
        $("#ed_apemat").val(registro["ape_mat"])
        $("#ed_nombres").val(registro["nom_usu"])
        $("#ed_gmail").val(registro["cor_per"])
        $("#ed_inst").val(registro["cor_inst"])
        $("#sel_ed_est").val(registro["estado"])
        $("#modal_editar_usuario").modal("show")
    }
    function abrir_modal_adduser(){
        $("#modal_add_usuario").modal("show")
    }
</script>