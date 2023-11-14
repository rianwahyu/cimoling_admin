<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include 'include/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    $page = "member";
    include 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Member</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Cimoling</a></li>
                <li class="breadcrumb-item active">Member</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Daftar Member</h4>
                </div>
                <div class="card-body table-responsive" id="dataMember">

                </div>
              </div>

            </div>
          </div>

        </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div id="loader"></div>
  <!-- /.content-wrapper -->
  <?php include 'include/footer.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php
  include 'include/footer_jquery.php';
  ?>

  <script type="text/javascript">
    load_data();

    function load_data(key) {
      $.ajax({
        url: "api/member/getMember.php",
        method: "POST",
        data: {
          // postType: 'getData',
          // key: key,
        },
        beforeSend: function() {
          $("#loader").show();
        },

        success: function(data) {
          $("#loader").hide();
          var object = JSON.parse(data);
          console.log("Last Activity : " + object);

          var htmls = '';

          var success = object.success;

          if (success == true) {
            htmls += `<table class="table table-bordered table-sm table-striped p-10">
            <thead>
                <tr class="">
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Lengkap</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Nomor Handphone</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Tgl Join</th>
                </tr>
            </thead>
            <tbody>`;

            var data = object.data;
            var no = 1;
            var img = "";
            var btnStatus = '';
            for (var count = 0; count < data.length; count++) {
              //var imageKategori = "storage/" + data[count].foto;
              // var imageUrl = '<img src="' + data[count].foto + '" style="width : 60px;" />';

              // if (data[count].status == "active") {
              //   btnStatus = '<a href="#" id="showStatus" data-id_kategori="' + data[count].idKategori + '" data-nama_kategori="' + data[count].namaKategori + '" data-remark="Sembunyikan menu" data-status="nonActive" class="btn btn-info btn-sm">Sembunyikan<a/>';
              // } else {
              //   btnStatus = '<a href="#" id="showStatus" data-id_kategori="' + data[count].idKategori + '" data-nama_kategori="' + data[count].namaKategori + ' data-remark="Tampilkan menu" data-status="active" class="btn btn-info btn-sm">Tampilkan<a/>';
              // }
              htmls += '<tr>';
              htmls += '<td>' + no + '</td>';
              htmls += '<td>' + data[count].namaLengkap + '</td>';
              htmls += '<td>' + data[count].email + '</td>';
              htmls += '<td>' + data[count].noHp + '</td>';
              htmls += '<td>' + data[count].alamat + '</td>';
              htmls += '<td>' + data[count].tanggalRegistrasi + '</td>';
              htmls += '</tr>';
              no++;
            }

            htmls += `</tbody>
          </table>`;
            $("#dataMember").html(htmls);
          } else {
            htmls += `<h4>Data tidak ditemukan  </h4>`;
            $("#dataMember").html(htmls);
          }

        }
      })
    }
  </script>
</body>

</html>