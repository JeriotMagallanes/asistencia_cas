<?php 
// if (isset($_GET["dni"]) && $_GET["dni"] !==""){
//     header("Location: index.php");
//     die;
// }
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 id="head_personal"></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Perfil</li>
                    <li class="breadcrumb-item" id="head_dni"></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card  card-outline" style="border-top:10px;border-style:solid;border-color:#000064">
                    <div class="card-body box-profile" style="background-color:white">
                        <div class="text-center" id="info_avatar">
                            <div class="spinner-border" style="height:20px;width:20px;" role="status"></div>
                        </div>
                        <h3 class="profile-username text-center" id="info_nombres">
                            <div class="spinner-border" style="height:20px;width:20px;" role="status"></div>
                        </h3>
                        <h6 class="text-muted text-center" id="info_puesto">
                            <div class="spinner-border" style="height:20px;width:20px;" role="status"></div>
                        </h6>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Dependecia</b> <span class="float-right" id="info_depen">
                                    <div class="spinner-border" style="height:20px;width:20px;" role="status"></div>
                                </span>
                            </li>
                        </ul>
                        <form id="frm_act_fot" enctype="multipart/form-data">
                            <input hidden name="id_per" id="id_per">
                            <input hidden name="dni_per" id="dni_per">
                            <button type="button" class="btn btn-block" onclick="$('#file_foto').click()" style="background-color:#000064;color:white"><i class="fa fa-upload"></i><b> Actualizar foto</b></button>
                            <input type="file" hidden id="file_foto" name="file_foto" accept="image/png,image/jpeg,image/jpg">
                        </form>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header" style="background-color:#000064;color:white">
                        <h3 class="card-title">Contacto</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-phone mr-1"></i> Celular</strong>
                        <h6 class="text-muted" id="info_cel">
                            <div class="spinner-border" style="height:20px;width:20px;" role="status"></div>
                        </h6>
                        <hr>
                        <strong><i class="fas fa-envelope mr-1"></i> Correo Personal</strong>
                        <h6 class="text-muted" id="info_mailper">
                            <div class="spinner-border" style="height:20px;width:20px;" role="status"></div>
                        </h6>
                        <hr>
                        <strong><i class="fas fa-envelope mr-1"></i> Correo Institucional</strong>
                        <h6 class="text-muted" id="info_mailundc">
                            <div class="spinner-border" style="height:20px;width:20px;" role="status"></div>
                        </h6>
                        <!-- <hr>
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>
                        <hr>
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                            enim neque.</p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#datosper" data-toggle="tab">Datos personales</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#formacion" data-toggle="tab">Currículum</a></li> -->
                            <li class="nav-item"><a class="nav-link" href="#asistencias" data-toggle="tab">Asistencias</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="formacion">
                                <div class="timeline timeline-inverse">
                                    <div class="time-label">
                                        <span class="">
                                            Experiencia Laboral
                                        </span>
                                        <button class="btn rounded-circle btn-success float-right" onclick="$('#modal_add_exp_lab').modal('show')">+</button>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2020-2022</span>
                                            <h3 class="timeline-header text-bold">Universidad Nacional de Cañete</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Puesto: </b>Programador Web</label><br>
                                                <label class="text-muted"><b class="text-dark">Dependencia: </b>Centro de Idiomas</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2015-2019</span>
                                            <h3 class="timeline-header text-bold">Universidad Nacional del Callao</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Puesto: </b>Programador Web</label><br>
                                                <label class="text-muted"><b class="text-dark">Dependencia: </b>Registros Académicos </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2010-2015</span>
                                            <h3 class="timeline-header text-bold">Municipalidad Distrital de Cerro Azul</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Puesto: </b>Asistente informático</label><br>
                                                <label class="text-muted"><b class="text-dark">Dependencia: </b>Oficina de Informática</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="timeline timeline-inverse">
                                    <div class="time-label">
                                        <span class="">
                                            Estudios
                                        </span>
                                        <button class="btn rounded-circle btn-success float-right" onclick="$('#modal_add_estudios').modal('show')">+</button>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2021-2022</span>
                                            <h3 class="timeline-header text-bold">Universidad Nacional de Ingeniería</h3>
                                            <div class="timeline-body">
                                                <span class="badge badge-info right">Postgrado</span><br>
                                                <label class="text-muted"><b class="text-dark">Especialidad: </b>Programador Web</label><br>
                                                <label class="text-muted"><b class="text-dark">Facultad: </b>Facultad de Ingeniería de Industrial y Sistemas</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2016-2020</span>
                                            <h3 class="timeline-header text-bold">Universidad Nacional de Cañete</h3>
                                            <div class="timeline-body">
                                                <span class="badge badge-primary right">Pregrado</span><br>
                                                <label class="text-muted"><b class="text-dark">Especialidad: </b>Ingeniería de Sistemas</label><br>
                                                <label class="text-muted"><b class="text-dark">Facultad: </b>Facultad de Ingeniería</label><br>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="timeline timeline-inverse">
                                    <div class="time-label">
                                        <span class="">
                                            Idiomas
                                        </span>
                                        <button class="btn rounded-circle btn-success float-right" onclick="$('#modal_add_idioma').modal('show')">+</button>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2021-2022</span>
                                            <h3 class="timeline-header text-bold">Centro de Idiomas - UNDC</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Idioma: </b>Inglés</label><br>
                                                <label class="text-muted"><b class="text-dark">Nivel: </b><span class="badge badge-success right">Básico</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2020-2021</span>
                                            <h3 class="timeline-header text-bold">Centro de Idiomas - UNDC</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Idioma: </b>Italiano</label><br>
                                                <label class="text-muted"><b class="text-dark">Nivel: </b><span class="badge badge-warning right">Intermedio</span> </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2018-2019</span>
                                            <h3 class="timeline-header text-bold">Centro de Idiomas - UNDC</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Idioma: </b>Portugues</label><br>
                                                <label class="text-muted"><b class="text-dark">Nivel: </b><span class="badge badge-info right">Avanzado</span></label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                                <hr>
                                <div class="timeline timeline-inverse">
                                    <div class="time-label">
                                        <span class="">
                                            Cursos y Capacitaciones
                                        </span>
                                        <button class="btn rounded-circle btn-success float-right">+</button>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2023</span>
                                            <h3 class="timeline-header text-bold">TECSUP</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Curso: </b>Programación Web Full Stack</label><br>
                                                <label class="text-muted"><b class="text-dark">Duración: </b>5 meses</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2022</span>
                                            <h3 class="timeline-header text-bold">TECSUP</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Curso: </b>Programación Web con Laravel</label><br>
                                                <label class="text-muted"><b class="text-dark">Duración: </b>5 meses</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fa fa-check bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-calendar"></i> 2021</span>
                                            <h3 class="timeline-header text-bold">Informática</h3>
                                            <div class="timeline-body">
                                                <label class="text-muted"><b class="text-dark">Curso: </b>Ensamblaje y mantenimiento de computadoras</label><br>
                                                <label class="text-muted"><b class="text-dark">Duración: </b>4 meses</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="asistencias">
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
                            <div class="tab-pane active" id="datosper">
                                <form class="form-horizontal" id="frm_dt_per">
                                    <div class="form-group row">
                                        <label for="dper_apaterno" class="col-sm-2 col-form-label">Apellido
                                            Paterno</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dper_apaterno"
                                                name="dper_apaterno" placeholder="Primer apellido" required>
                                                <input hidden id="dper_id" name="dper_id" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dper_amaterno" class="col-sm-2 col-form-label">Apellido
                                            Materno</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dper_amaterno"
                                                name="dper_amaterno" placeholder="Segundo apellido" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dper_nombres" class="col-sm-2 col-form-label">Nombres</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dper_nombres"
                                                name="dper_nombres" placeholder="Nombres completos" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dper_genero" class="col-sm-2 col-form-label">Género</label>
                                        <div class="col-sm-10">
                                            <select name="dper_genero" id="dper_genero" class="form-control" required>
                                                <option value="" hidden>Seleccione</option>
                                                <option value="F">Femenino</option>
                                                <option value="M">Masculino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dper_tdoc" class="col-sm-2 col-form-label">Documento</label>
                                        <div class="col-sm-10">
                                            <select name="dper_tdoc" id="dper_tdoc" class="form-control" required>
                                                <option value="" hidden>Seleccione</option>
                                                <option value="1">D.N.I</option>
                                                <option value="2">Carnét de extranjeria</option>
                                                <option value="3">Pasaporte</option>
                                                <option value="4">Número Registro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dper_nro_doc" class="col-sm-2 col-form-label">Número del Documento</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dper_nro_doc"
                                                name="dper_nro_doc" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dper_cel" class="col-sm-2 col-form-label">Celular</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dper_cel" name="dper_cel"
                                                placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dper_gmail" class="col-sm-2 col-form-label">Correo Gmail</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="dper_gmail" name="dper_gmail"
                                                required placeholder="ejemplo@gmail.com">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dper_corundc" class="col-sm-2 col-form-label">Correo
                                            Institucional</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="dper_corundc"
                                                name="dper_corundc" placeholder="ejemplo@undc.edu.pe" required>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Estoy de acuerdo con los <span
                                                        class="text-primary"
                                                        onclick="Swal.fire({title:'Terminos y Condiciones',html:'<p style=`text-align:left;`>1. He verificado todos los datos ingresados <br> 2. Estoy de acuerdo con una sanción administrativa en caso de incurrir a dar información falsa.</p>'})"
                                                        style="cursor:pointer">terminos y condiciones</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                                Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- modal para ver los registros de asistencias -->
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
<!-- modal para agregar experiencia laboral -->
<div class="modal" id="modal_add_exp_lab" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Experiencia Laboral</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre de la entidad</label>
                    <input class="form-control" type="text" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Dependencia</label>
                    <input class="form-control" type="text" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Puesto</label>
                    <input class="form-control" type="text" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Fecha de Inicio</label>
                    <input class="form-control" type="date" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Fecha de Termino</label>
                    <input class="form-control" type="date" id="fec_reg_marc" name="fec_reg_marc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal para agregar estudios -->
<div class="modal" id="modal_add_estudios" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Estudios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre de la Institución</label>
                    <input class="form-control" type="text" id="est_name_inst" name="est_name_inst">
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="est_tipo" id="est_tipo" class="form-control" required>
                        <option value="" hidden>Seleccione</option>
                        <option value="1">Pregrado</option>
                        <option value="2">Postgrado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Especialidad</label>
                    <input class="form-control" type="text" id="est_espec" name="est_espec">
                </div>
                <div class="form-group">
                    <label>Facultad</label>
                    <input class="form-control" type="text" id="est_facul" name="est_facul">
                </div>
                <div class="form-group">
                    <label>Fecha de Inicio</label>
                    <input class="form-control" type="date" id="est_fecini" name="est_fecini">
                </div>
                <div class="form-group">
                    <label>Fecha de Termino</label>
                    <input class="form-control" type="date" id="est_fecfin" name="est_fecfin">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal para agregar idioma -->
<div class="modal" id="modal_add_idioma" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Idioma</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre de la entidad</label>
                    <input class="form-control" type="text" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Nombre del Idioma</label>
                    <input class="form-control" type="text" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Nivel</label>
                    <select name="" id="" class="form-control">
                        <option value="" hidden>Seleccione</option>
                        <option value="1">Básico</option>
                        <option value="2">Intermedio</option>
                        <option value="3">Avanzado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Fecha de Inicio</label>
                    <input class="form-control" type="date" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Fecha de Termino</label>
                    <input class="form-control" type="date" id="fec_reg_marc" name="fec_reg_marc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para agregar cursos y capacitaciones -->
<div class="modal" id="modal_add_idioma" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cursos o Capacitaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nombre de la entidad</label>
                    <input class="form-control" type="text" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Nombre del curso o capacitacion</label>
                    <input class="form-control" type="text" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Fecha de Inicio</label>
                    <input class="form-control" type="date" id="fec_reg_marc" name="fec_reg_marc">
                </div>
                <div class="form-group">
                    <label>Fecha de Termino</label>
                    <input class="form-control" type="date" id="fec_reg_marc" name="fec_reg_marc">
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
cargar_pagina()

function cargar_pagina() {
    datos_personales();
}
async function datos_personales() {
    const response = await $.ajax({
        url: "./ajax/admin/perfil/datos_personales.php",
        type: "POST",
        data: {
            "dni": "<?php echo $_GET["dni"];?>"
        }
    })
    let data = JSON.parse(response)
    $("#head_personal").html(data[0].apaterno + " " + data[0].amaterno + " " + data[0].nombres)
    $("#info_nombres").html(data[0].nombres)
    $("#info_puesto").html(data[0].puesto)
    $("#head_dni").html(data[0].dni_pa)
    $("#info_depen").html(data[0].dependencia)
    $("#info_mailundc").html(data[0].cor_inst)
    $("#info_mailper").html(data[0].cor_per)
    // $("#info_cel").html('<a href="https://wa.">'+data[0].cel_pa+'</a>')
    let celular = data[0].cel_pa;
    if(celular) {
        $("#info_cel").html('<a title="Iniciar una conersacion en WHATSAPP con ' + data[0].nombres +'" class="text-primary" target="_blank" href="https://wa.me/51' + data[0].cel_pa + '">' + data[0].cel_pa + '</a>')
    }else{
        $("#info_cel").html("<span class='text-danger'>No hay registro</span>")
    }
    $("#id_per").val(data[0].id_personal)
    $("#dni_per").val(data[0].dni_pa)
    $("#info_avatar").html('<img class="profile-user-img img-fluid img-circle" src="./upload/foto/' + data[0].url_avatar + '" alt="User profile picture">')
    $("#dper_id").val(data[0].id_personal)
    $("#dper_apaterno").val(data[0].apaterno)
    $("#dper_amaterno").val(data[0].amaterno)
    $("#dper_nombres").val(data[0].nombres)
    $("#dper_doc").val(data[0].tip_doc)
    $("#dper_nro_doc").val(data[0].dni_pa)
    $("#dper_gmail").val(data[0].cor_per)
    $("#dper_corundc").val(data[0].cor_inst)
    $("#dper_cel").val(data[0].cel_pa)
}
$("#frm_dt_per").submit(function(e) {
    e.preventDefault();
    let datos = {
        "ed_id_personal" : $("#dper_id").val(),
        "ed_apaterno" : $("#dper_apaterno").val(),
        "ed_amaterno" : $("#dper_amaterno").val(),
        "ed_nombres" : $("#dper_nombres").val(),
        "gen" : $("#dper_genero").val(),
        "tdoc" : $("#dper_tdoc").val(),
        "ed_dni" : $("#dper_nro_doc").val(),
        "ed_celular" : $("#dper_cel").val(),
        "ed_cor_per" : $("#dper_gmail").val(),
        "ed_cor_inst" : $("#dper_corundc").val()
    }

    $.ajax({
        url: "./ajax/admin/perfil/guardar_datos_personales.php",
        type:"POST",
        dataType:"JSON",
        data:datos,
        success:function(res){
            if (res.estado == 1){
                Swal.fire({
                    icon : "success",
                    title: "Exito!",
                    text : res.mensaje
                })
            }else{
                Swal.fire({
                    icon : "warning",
                    title: "Ups!",
                    text : res.menssaje
                })
            }
        }
    })
    cargar_pagina()
})

$("#file_foto").change(function() {
    let formData = new FormData($("#frm_act_fot")[0]);
    $.ajax({
        url: "ajax/perfil/actualizar_foto.php",
        type: "POST",
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        beforeSend: function() {
            Swal.fire({
                text: 'Subiendo ...',
                showConfirmButton: false,
            })
        },
        success: function(res) {
            if (res.estado == 1) {
                cargar_pagina()
                Swal.fire({
                    title: "Exito!",
                    icon: "success",
                    text: res.mensaje
                })
            } else {
                Swal.fire({
                    title: "Error!",
                    icon: "warning",
                    text: res.mensaje
                })
            }
        }
    })
})
var dtable_asistencia = "";
$(document).ready(function() {
    cargar_marcaciones()
});

function cargar_marcaciones() {
    let dni = "<?php echo $_GET["dni"];?>"
    dtable_asistencia = $("#dtable_asistencia").DataTable({
        'pageLength': 50,
        "responsive": true,
        ajax: {
            url: "./ajax/ver_marcaciones.php",
            type: "POST",
            data: {
                "dni": dni
            }
        }
    })
}

function ver_asistencias(fecha, marcaciones) {
    $("#fec_reg_marc").val(fecha)
    registro = JSON.parse(marcaciones)
    let tabla_asi = ""
    registro.forEach((item) => {
        tabla_asi += "<tr>"
        tabla_asi += "<td>"
        tabla_asi += item.hora
        tabla_asi += "</td>"
        tabla_asi += "<td>"
        tabla_asi += item.local
        tabla_asi += "</td>"
        tabla_asi += "</tr>"
    })
    $("#tbody_asi_reg").html(tabla_asi)
    $("#modal_ver_asi_reg").modal("show")
}

</script>