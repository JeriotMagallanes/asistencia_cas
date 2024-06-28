<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Papeleta Personal</h1>
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
                  <table class="table w-100 responsive no-wrap" id="dtable_adm_papeletas">
                    <thead style="background-color:#000063;color:white">
                      <th data-priority="0">#</th>
                      <th data-priority="1">PERSONAL</th> 
                      <th data-priority="3">CARGO</th>
                      <th data-priority="4">HORA DE SALIDA</th>
                      <th data-priority="5">HORA DE REGRESO</th>
                      <th data-priority="2">Editar</th>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="modal" id="modal_agregar_papeleta" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Papeleta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Personal</label>
            <select name="add_sel_percas" id="add_sel_percas" class="form-control">
            </select>
        </div>
        <div class="form-group">
            <label for="">Cargo</label>
            <input type="text" class="form-control" id="add_cargo2" disabled>
            <input id="add_cargo" hidden>
        </div>
        <div class="form-group">
            <label for="">Fecha</label>
            <input type="date" class="form-control" id="add_fecha" name="add_fecha">
        </div>
        <div class="form-group">
            <label for="">Hora de salida</label>
            <input type="time" class="form-control" id="add_hra_salida" name="add_hra_salida">
        </div>
        <div class="form-group">
            <label for="">Hora de regreso</label>
            <input type="time" class="form-control" id="add_hra_regreso" name="add_hra_regreso">
        </div>
        <div class="form-group">
            <label for="">Motivo</label>
            <textarea name="add_motivo" id="add_motivo" cols="30" rows="5" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" name="btn_ed_usu" onclick="agregar_nueva_papeleta()">Registrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDITAR PAPELETA -->
<div class="modal" id="modal_editar_papeleta" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar Papeleta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Personal</label>
            <input type="text" class="form-control" disabled id="ed_personal" >
            <input hidden id="ed_id_personal" >
            <input hidden id="ed_id_papeleta" >
        </div>
        <div class="form-group">
            <label for="">Cargo</label>
            <input type="text" class="form-control" id="ed_cargo">
        </div>
        <div class="form-group">
            <label for="">Fecha</label>
            <input type="date" class="form-control" id="ed_fecha" name="ed_fecha">
        </div>
        <div class="form-group">
            <label for="">Hora de salida</label>
            <input type="time" class="form-control" id="ed_hra_salida" name="ed_hra_salida">
        </div>
        <div class="form-group">
            <label for="">Hora de regreso</label>
            <input type="time" class="form-control" id="ed_hra_regreso" name="ed_hra_regreso">
        </div>
        <div class="form-group">
            <label for="">Motivo</label>
            <textarea name="ed_motivo" id="ed_motivo" cols="30" rows="5" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" name="btn_ed_usu" onclick="actualizar_papeleta()">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="./js/datatable.js"></script>
<script >
    var datatable_papeletas = "";
    $(document).ready( function () {
        cargar_data_table();
        cargar_personal_cas();
    });
    function cargar_personal_cas(){
        $.ajax({
            url : "./ajax/cargar_personal_cas.php",
            dataType : "JSON",
            success : function(res){
                let html = "<option hidden value='0'>Seleccione</option>";
                if (res.estado == 1) {
                    console.log("si hay data")
                    res.data.forEach(item => {
                        html += "<option value='"+item.id_personal+"'>"+item.apaterno+" "+item.amaterno+" "+item.nombres+"</option>";
                    });
                }
                $("#add_sel_percas").html(html)
            }
        })
    }
    function cargar_data_table(){
        datatable_papeletas = $("#dtable_adm_papeletas").DataTable({
            "ajax" : "./ajax/cargar_todas_papeletas.php"
        });
    }
    function abrir_modal_adduser(){
        $("#modal_agregar_papeleta").modal("show");
    }
    $("#add_sel_percas").change(function(e){
        $.ajax({
            url:"./ajax/get_puesto.php",
            type:"POST",
            dataType:"JSON",
            data:{
                "id":e.target.value
            },
            success:function(res){
                $("#add_cargo").val(res.puesto)
                $("#add_cargo2").val(res.puesto)
            }
        })
    })
    function agregar_nueva_papeleta(){
        let personal = $("#add_sel_percas").val();
        let cargo = $("#add_cargo").val();
        let fecha = $("#add_fecha").val();
        let hora_salida = $("#add_hra_salida").val();
        let hora_regreso = $("#add_hra_regreso").val();
        let motivo = $("#add_motivo").val();
        if (personal == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Seleccione un personal"})
        }else if (fecha.length == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Ingrese una fecha valida"})
        }else if (hora_salida.length == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Inrese una hora de salida valida"})
        }else if (hora_regreso.length == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Ingrese una hora de regreso valida"})
        }else if (motivo.length == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Ingrese un motivo"})
        }else {
            $.ajax({
                url : "./ajax/registrar_nueva_papeleta.php",
                type : "POST",
                dataType : "JSON",
                data:{
                    "id_personal":personal,"cargo":cargo,"fecha":fecha,"hora_salida":hora_salida,"hora_regreso":hora_regreso,"motivo":motivo
                },
                success : function(res){
                    if (res.estado == 1) {
                        datatable_papeletas.ajax.reload();
                        Swal.fire({
                            icon : "success",
                            title: "Exito!",
                            text : "Datos guardados correctamente"
                        });
                    }
                }
            })
        }
    }
    function editar_papeleta (data){
        $("#ed_personal").val(data.apaterno+" "+data.amaterno+" "+data.nombres )
        $("#ed_id_personal").val(data.id_personal)
        $("#ed_id_papeleta").val(data.id)
        $("#ed_cargo").val(data.cargo)
        $("#ed_fecha").val(data.fecha)
        $("#ed_hra_salida").val(data.hora_salida)
        $("#ed_hra_regreso").val(data.hora_regreso)
        $("#ed_motivo").val(data.motivo)
        $("#modal_editar_papeleta").modal("show")
    }
    function actualizar_papeleta(){
        console.log("click")
        let id_personal = $("#ed_id_personal").val()
        let id_papeleta = $("#ed_id_papeleta").val()
        let cargo = $("#ed_cargo").val()
        let fecha = $("#ed_fecha").val()
        let hora_salida = $("#ed_hra_salida").val()
        let hora_regreso = $("#ed_hra_regreso").val()
        let motivo = $("#ed_motivo").val()
        if (fecha.length == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Ingrese una fecha valida"})
        }else if (hora_salida.length == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Inrese una hora de salida valida"})
        }else if (hora_regreso.length == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Ingrese una hora de regreso valida"})
        }else if (motivo.length == 0) {
            Swal.fire({icon:"error",title:"Requerido",text:"Ingrese un motivo"})
        }else  {
            console.log("todo ok")
            $.ajax({
                url:"./ajax/actualizar_papeleta.php",
                type:"POST",
                dataType:"JSON",
                data:{
                    "id":id_papeleta,"id_personal":id_personal,"cargo":cargo,"fecha":fecha,"hora_salida":hora_salida,"hora_regreso":hora_regreso,"motivo":motivo
                },
                success: function(res){
                    if (res.estado == 1) {
                        datatable_papeletas.ajax.reload();
                        Swal.fire({
                            icon : "success",
                            title:"Exito!",
                            text:"Papeleta actualizado correctamente"
                        });
                    }
                }
            })
        }
    }
</script>