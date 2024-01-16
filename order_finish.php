<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "order";
        $subPage = "orderFinish";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Order Selesai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Order</a></li>
                                <li class="breadcrumb-item active">Order Selesai</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Order Cimoling Selesai </h3>
                                    <br>
                                    <!-- <button type="button" id="btnTambah" class="btn  btn-outline-info" data-toggle="modal" data-target="#modal-kategori">Tambah Kategori</button> -->

                                    <!-- <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 180px;">
                                            <input type="text" name="key" id="key" class="form-control float-right" placeholder="Filter & Cari">
                                            <div class="input-group-append">
                                                <button type="button" id="btnSearch" name="btnSearch" class="btn btn-info">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive" id="dataOrder">
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>


            <!-- /.content -->
        </div>

        <div id="loader"></div>
        <!-- /.content-wrapper -->

        <?php include 'include/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <div class="modal fade" id="modal-completed">
        <div class="modal-dialog ui-front ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleForm">Detail Layanan Cimoling</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlaycompleted">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-completed" name="form-completed" method="POST">

                    <div class="modal-body">

                        <!--  <h4>Apakah anda ingin menyelesaikan status Cimoling layanan menjadi <strong>Selesai</strong></h4>

                        <p>Status Layanan akan berubah menjadi Selesai, dan data akan dikirim ke halaman Order Sele</p>

                        <input type="hidden" class="form-control" id="orderID" name="orderID"> -->

                        <dl class="row">
                            <dt class="col-sm-4">Order ID</dt>
                            <dd class="col-sm-8" id="orderID"></dd>
                            <dt class="col-sm-4">Nama Customer</dt>
                            <dd class="col-sm-8" id="namaLengkap"></dd>
                            <dt class="col-sm-4">Tgl Order</dt>
                            <dd class="col-sm-8" id="tanggalOrder"></dd>
                            <dt class="col-sm-4">Waktu Order</dt>
                            <dd class="col-sm-8" id="waktuOrder"></dd>
                            <dt class="col-sm-4">Kategori Layanan</dt>
                            <dd class="col-sm-8" id="tipeKendaraan"></dd>
                            <dt class="col-sm-4">Jenis Kendaraan</dt>
                            <dd class="col-sm-8" id="namaJenis"></dd>
                            <dt class="col-sm-4">Keterangan Layanan</dt>
                            <dd class="col-sm-8" id="ketHarga"></dd>
                        </dl>

                        <hr>
                        <h5>History Order</h5>
                        <div id="timeLineOrder"></div>

                        <hr>
                        <h5>Data Petugas Layanan</h5>
                        <div id="dataOrderPetugas"></div>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                        <button class="btn btn-primary">Simpan</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php include 'include/footer_jquery.php'; ?>

    <!-- Page specific script -->
    <script text="text/javascript">
        var idAdmin = "<?php echo $idAdmin ?>";

        load_data();


        function load_data() {
            $.ajax({
                url: "api/order/getOrderByStatus.php",
                method: "GET",
                data: {
                    status: '4',
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
                        htmls += `<table class="table table-bordered p-0">
                    <thead>
                        <tr class="">
                            <th class="text-center text-nowrap">NO</th>
                            <th class="text-center text-nowrap">Order ID</th>
                            <th class="text-center text-nowrap">Nama Member</th>
                            <th class="text-center text-nowrap">Kategori</th>
                            <th class="text-center text-nowrap">Layanan</th>
                            <th class="text-center text-nowrap">Biaya Layanan</th>
                            <th class="text-center text-nowrap">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;

                        for (var count = 0; count < data.length; count++) {

                            //load_data_petugas(data[count].orderID);

                            htmls += '<tr>';
                            htmls += '<td>' + no + '</td>';
                            htmls += '<td>' + data[count].orderID + '</td>';
                            htmls += '<td>' + data[count].namaLengkap + '</td>';
                            htmls += '<td>' + data[count].tipeKendaraan + '</td>';
                            htmls += '<td>' + data[count].namaJenis + '-' + data[count].ketHarga + '</td>';
                            htmls += '<td class="text-right">' + formatRupiah(data[count].harga, '') + '</td>';
                            htmls += '<td class="text-left text-nowrap"><a href="#" id="completed" data-toggle="modal" data-target="#modal-completed" data-order_id="' + data[count].orderID + '"  data-tanggal_order="' + data[count].tanggalOrder + '" data-waktu_order="' + data[count].waktuOrder + '" data-nama_lengkap="' + data[count].namaLengkap + '" data-tipe_kendaraan="' + data[count].tipeKendaraan + '" data-nama_jenis="' + data[count].namaJenis + '" data-ket_harga="' + data[count].ketHarga + '" data-harga="' + data[count].harga + '" class="btn btn-secondary">Detail</a> </td>';

                            htmls += '</tr>';
                            no++;
                        }

                        htmls += `</tbody>
                  </table>`;
                        $("#dataOrder").html(htmls);
                    } else {
                        htmls += `<h4>Data tidak ditemukan  </h4>`;
                        $("#dataOrder").html(htmls);
                    }

                }
            })
        }


        $(document).on('click', '#completed', function(e) {
            e.preventDefault();
            var order_id = $(this).data('order_id');
            var tanggal_order = $(this).data('tanggal_order');
            var waktu_order = $(this).data('waktu_order');
            var nama_lengkap = $(this).data('nama_lengkap');
            var tipe_kendaraan = $(this).data('tipe_kendaraan');
            var nama_jenis = $(this).data('nama_jenis');
            var ket_harga = $(this).data('ket_harga');

            $('#orderID').html(order_id);
            $('#namaLengkap').html(nama_lengkap);
            $('#tanggalOrder').html(tanggal_order);
            $('#waktuOrder').html(waktu_order);
            $('#tipeKendaraan').html(tipe_kendaraan);
            $('#namaJenis').html(nama_jenis);
            $('#ketHarga').html(ket_harga);

            load_data_history_value(order_id);

            load_data_petugas(order_id);

        });


        function load_data_history_value(orderID) {
            $.ajax({
                url: "api/order/getOrderValueByOrderID.php",
                method: "POST",
                data: {
                    orderID: orderID,
                },
                beforeSend: function() {
                    //$("#loader").show();
                },

                success: function(data) {
                    //$("#loader").hide();
                    var object = JSON.parse(data);
                    console.log("Last Activity : " + object);

                    var htmls = '';

                    var success = object.success;

                    if (success == true) {
                        htmls += `<table class="table table-sm p-0">
                    <thead
                        <tr class="">
                            <th class="text-center text-nowrap">Tanggal</th>
                            <th class="text-center text-nowrap">Waktu</th>
                            <th class="text-center text-nowrap">Status</th>
                            <th class="text-center text-nowrap">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;

                        for (var count = 0; count < data.length; count++) {

                            var ketStatus = '';

                            if (data[count].status == "0") {
                                ketStatus = "Order Masuk";
                            } else if (data[count].status == "1") {
                                ketStatus = "Diproses";
                            } else if (data[count].status == "2") {
                                ketStatus = "Dikonfirmasi";
                            } else if (data[count].status == "3") {
                                ketStatus = "Dalam Perjalanan";
                            } else if (data[count].status == "4") {
                                ketStatus = "Selesai";
                            } else if (data[count].status == "5") {
                                ketStatus = "Dibatalkan";
                            }

                            htmls += '<tr>';
                            htmls += '<td class="text-nowrap">' + data[count].tanggal + '</td>';
                            htmls += '<td>' + data[count].waktu + '</td>';
                            htmls += '<td>' + ketStatus + '</td>';
                            htmls += '<td>' + data[count].keterangan + '</td>';
                            htmls += '</tr>';
                            no++;
                        }

                        htmls += `</tbody>
                  </table>`;
                        $("#timeLineOrder").html(htmls);
                    } else {
                        htmls += `<h4>Data tidak ditemukan  </h4>`;
                        $("#timeLineOrder").html(htmls);
                    }

                }
            })
        }

        function load_data_petugas(orderID) {
            $.ajax({
                url: "api/order/getWashDelivery.php",
                method: "POST",
                data: {
                    orderID: orderID,
                    // key: key,
                },
                beforeSend: function() {
                    //$("#loader").show();
                },

                success: function(data) {
                    //$("#loader").hide();
                    var object = JSON.parse(data);
                    console.log("Last Activity : " + object);

                    var htmls = '';

                    var success = object.success;

                    if (success == true) {
                        htmls += `<table class="table table-sm p-0">
                    <thead
                        <tr class="">
                            <th class="text-center text-nowrap">No</th>
                            <th class="text-center text-nowrap">Nama Karyawan</th>
                            <th class="text-center text-nowrap">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;

                        for (var count = 0; count < data.length; count++) {

                            htmls += '<tr>';
                            htmls += '<td>' + no + '</td>';
                            htmls += '<td>' + data[count].namaKaryawan + '</td>';
                            htmls += '<td>' + data[count].jabatan + '</td>';
                            htmls += '</tr>';
                            no++;
                        }

                        htmls += `</tbody>
                  </table>`;
                        $("#dataOrderPetugas").html(htmls);
                    } else {
                        htmls += `<h4>Data tidak ditemukan  </h4>`;
                        $("#dataOrderPetugas").html(htmls);
                    }

                }
            })
        }

        $('#modal-finishOrder').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })
    </script>

</body>

</html>