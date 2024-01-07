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
        <a href="#" class="d-block"> <?= $namaLengkap ?></a>
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

        <li class="nav-item <?= ($page == "order") ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= ($page == "order") ? 'active' : '' ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Order
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview active">
            <li class="nav-item">
              <a href="order_pending" class="nav-link <?= ($subPage == "orderPending") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Masuk</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="order_process" class="nav-link <?= ($subPage == "orderProcess") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Proses</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link <?= ($subPage == "orderConfirm") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Konfirmasi</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link <?= ($subPage == "orderDelivery") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Perjalanan</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link <?= ($subPage == "orderSuccess") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Selesai</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link <?= ($subPage == "orderCancel") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Dibatalkan</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="member" class="nav-link <?= ($page == "member") ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Member</p>
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
              <a href="promosi_banner" class="nav-link <?= ($subPage == "promosiBanner") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Banner Slider</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="promosi_notifikasi" class="nav-link <?= ($subPage == "promosiNotifikasi") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Notifikasi</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item <?= ($page == "utility") ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= ($page == "utility") ? 'active' : '' ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Pengaturan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview active">
            <li class="nav-item">
              <a href="utility_app_setting" class="nav-link <?= ($subPage == "utilityAboutApps") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Tentang Aplikasi</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="utility_app_use" class="nav-link <?= ($subPage == "utilityCara") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Cara Penggunaan</p>
              </a>
            </li>


            <li class="nav-item">
              <a href="utility_visi_misi" class="nav-link <?= ($subPage == "utilityVisiMisi") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Visi dan Misi</p>
              </a>
            </li>

            <!-- <li class="nav-item">
              <a href="master_sub_category" class="nav-link <?= ($subPage == "masterSubCategory") ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Sub Kategori</p>
              </a>
            </li> -->
          </ul>
        </li>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>