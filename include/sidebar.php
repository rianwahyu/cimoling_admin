<aside class="main-sidebar sidebar-dark-green elevation-5">
  <!-- Brand Logo -->
  <?php

  include 'config/connection.php';

  $fileFoto = "dist/img/hrd.png";

  ?>
  <a href="#" class="brand-link">

    <span class="brand-text font-weight-dark">Cimoling</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $fileFoto ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"> <?= $fullname ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- MENU 1:  Dashboard -->
        <li class="nav-item">
          <a href="index" class="nav-link <?= ($page == "dashboard") ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        
        <li class="nav-item <?= ($page == "master") ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= ($page == "master") ? 'active' : '' ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Master Apps
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview active">
            <li class="nav-item">
              <a href="master_category" class="nav-link <?= ($subPage == "masterCategory") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="master_sub_category" class="nav-link <?= ($subPage == "masterSubCategory") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Kategori</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item <?= ($page == "promosi") ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= ($page == "promosi") ? 'active' : '' ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Promosi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview active">
            <li class="nav-item">
              <a href="#" class="nav-link <?= ($subPage == "promosiBanner") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Banner Slider</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link <?= ($subPage == "promosiNotifikasi") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Notifikasi</p>
              </a>
            </li>
          </ul>
        </li>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>