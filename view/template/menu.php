<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="assets/img/logo_undc.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">UNDC</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./assets/img/perfil.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo (isset($_SESSION["cor_inst"])) ? $_SESSION["cor_inst"] : "Anonimo" ; ?></a>
          <a href="index.php?busqueda=logout" class="text-danger">Cerrar Sesion</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
            if ($_SESSION["rol"]["admin"] === 1 && $_SESSION["rol"]["cas"] === 1) {
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              Mis Roles
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./procesos/ingresar_como_admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administrador</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./procesos/ingresar_como_cas.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Personal Cas</p>
                </a>
              </li>
            </ul>
          </li>
         <?php } ?>
          <?php
          if ($_SESSION["dashboard"] === "admin") {
          ?>
          <li class="nav-item">
            <a href="index.php?busqueda=personal_cas" class="nav-link">
              <i class="nav-icon fas fa-solid fa-user"></i>
              <p>
                Personal CAS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?busqueda=usuarios" class="nav-link">
              <i class="nav-icon fas fa-solid fa-laptop"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Papeleta
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?busqueda=comision" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comisión</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Personal</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?busqueda=panel" class="nav-link">
              <i class="nav-icon fas fa-solid fa-laptop"></i>
              <p>
                Panel de Control
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?busqueda=export" class="nav-link">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                Exportaciones
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>
                Reportes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?busqueda=frm_rep" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Generar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Generados</p>
                </a>
              </li>
            </ul>
          </li> -->
          <?php } ?>

          <?php if ($_SESSION["dashboard"] === "cas" ) { ?>
          <li class="nav-item">
            <a href="index.php?busqueda=asistencia" class="nav-link">
              <i class="nav-icon fas fa-solid fa-clock"></i>
              <p>
                Mi Asistencia
              </p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>