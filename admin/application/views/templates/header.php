<?php
$img = !empty($this->session->userdata('avatar')) ? base_url($this->session->userdata('avatar')) : base_url('assets/dist/img/avatar5.png');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Programium | <?= $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('uploads/favicon/logo3.png'); ?>" rel="shortcut icon" type="image/x-icon" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?> ">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <?php
  if (!$this->session->userdata('login')) {
    redirect('login');
  }
  ?>
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('./main') ?>" class="nav-link">Inicio</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?= $img ?>" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"> <?= $this->session->userdata('name') ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <img src="<?= $img ?>" class="img-circle elevation-2" alt="User Image">
              <p>
                <?= $this->session->userdata('name') . '-' . $this->session->userdata('role') ?>
              </p>
            </li>
            <!-- Menu Body -->

            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="<?php echo base_url('main/profile'); ?>" class="btn btn-default btn-flat">Perfil</a>
              <a href="<?php echo base_url('main/logout'); ?>" class="btn btn-default btn-flat float-right">Salir <i class="fa fa-sign-out"></i></a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('main') ?>" class="brand-link">
        <img src="<?php echo base_url('uploads/Logo/logo3.jpg') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Programium</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header"> <i class="nav-icon fas fa-cog"></i> Configuraciones</li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-address-book"></i>
                <p>
                  Catalogos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                
                <?php if ($this->session->userdata('role') === 'Administrador') {?>
                <li class="nav-item">
                  <a href="<?= base_url('user') ?>" class="nav-link">
                    <i class="far fa-user nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
                <?php }?>
                <li class="nav-item">
                  <a href="<?= base_url('course/theme') ?>" class="nav-link">
                    <i class="fas fa-book-reader nav-icon"></i>
                    <p>Temas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('course') ?>" class="nav-link">
                    <i class="fas fa-atlas nav-icon"></i>
                    <p>Cursos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('subject') ?>" class="nav-link">
                    <i class="fas fa-book-reader nav-icon"></i>
                    <p>Asignaturas</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>