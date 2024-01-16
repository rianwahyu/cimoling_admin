<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "order";
        $subPage = "orderDelivery";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Order Perjalanan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Order</a></li>
                                <li class="breadcrumb-item active">Order Perjalanan</li>
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
                                    <h3 class="card-title">Daftar Order Status Perjalanan ke Customer</h3>
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

    <div class="modal fade" id="modal-finishOrder">
        <div class="modal-dialog ui-front">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleForm">Selesaikan Layanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlayfinishOrder">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-finishOrder" name="form-finishOrder" method="POST">

                    <div class="modal-body">

                        <h4>Apakah anda ingin menyelesaikan status Cimoling layanan menjadi <strong>Selesai</strong></h4>

                        <p>Status Layanan akan berubah menjadi Selesai, dan data akan dikirim ke halaman Order Sele</p>

                        <input type="hidden" class="form-control" id="orderID" name="orderID">

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                        <button class="btn btn-primary">Simpan</button>
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
                    status: '3',
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
                        htmls += `<table class="table table-bordered table-sm p-0">
                    <thead>
                        <tr class="">
                            <th class="text-center text-nowrap">Order ID</th>
                            <th class="text-center text-nowrap">Nama Member</th>
                            <th class="text-center text-nowrap">Kategori</th>
                            <th class="text-center text-nowrap">Layanan</th>
                            <th class="text-center text-nowrap">Jadwal Cuci</th>
                            <th class="text-center text-nowrap">Alamat Cuci</th>                            
                            <th class="text-center text-nowrap">Biaya Layanan</th>
                            <th class="text-center text-nowrap">Petugas Cuci</th>
                            <th class="text-center text-nowrap">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;

                        for (var count = 0; count < data.length; count++) {

                            load_data_petugas(data[count].orderID);

                            htmls += '<tr>';
                            htmls += '<td>' + data[count].orderID + '</td>';
                            htmls += '<td>' + data[count].namaLengkap + '</td>';
                            htmls += '<td>' + data[count].tipeKendaraan + '</td>';
                            htmls += '<td>' + data[count].namaJenis + '-' + data[count].ketHarga + '</td>';
                            htmls += '<td>' + data[count].tanggalOrder + ' ' + data[count].waktuOrder + '</td>';
                            htmls += '<td class="text-wrap">' + data[count].alamatOrder + '</td>';
                            htmls += '<td class="text-right">' + formatRupiah(data[count].harga, '') + '</td>';
                            htmls += '<td class="text-wrap" id="dataOrderPetugas"></td>';

                            htmls += '<td class="text-left text-nowrap"><a href="#" id="finishOrder" data-toggle="modal" data-target="#modal-finishOrder" data-order_id="' + data[count].orderID + '"  data-tanggal_order="' + data[count].tanggalOrder + '" data-waktu_order="' + data[count].waktuOrder + '" class="btn btn-success btn-sm">Selesai Order</a> </td>';

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
                            <th class="text-center text-nowrap">Nama Karyawan</th>
                            <th class="text-center text-nowrap">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;

                        for (var count = 0; count < data.length; count++) {

                            htmls += '<tr>';
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

        $('#form-finishOrder').validate({
            rules: {
                /* tanggalUbahJadwal: {
                    required: true,
                },
                waktuUbahJadwal: {
                    required: true,
                },
                alasanJadwal: {
                    required: true,
                }, */

            },
            messages: {
                /* tanggalUbahJadwal: {
                    required: "Mohon mengisi tanggal",
                },

                waktuUbahJadwal: {
                    required: "Mohon mengisi waktu",
                },
                alasanJadwal: {
                    required: "Mohon mengisi alasan mengubah jadwal layanan",
                }, */

            },
            submitHandler: function() {
                let formData = new FormData();

                formData.append('orderID', $('#orderID').val());
                formData.append('username', idAdmin);
                formData.append('status', "3");

                var urls = 'api/order/updateOrderAdmin.php';

                $.ajax({
                    url: urls,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#overlayfinishOrder').show();
                    },
                    success: function(result) {
                        $('#overlayfinishOrder').hide();
                        var hasil = JSON.parse(result);
                        var success = hasil.success;
                        var message = hasil.message;
                        if (success == true) {
                            $('#form-finishOrder').get(0).reset()
                            $('#modal-finishOrder').modal('hide');

                            Swal.fire({
                                title: 'Sukses',
                                animation: true,
                                text: message,
                                type: "success",
                            }).then(function() {
                                load_data();
                            });

                            //load_data();

                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                animation: true,
                                text: message,
                                type: "error",
                            });
                        }
                    }
                });

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $(document).on('click', '#finishOrder', function(e) {
            e.preventDefault();
            var order_id = $(this).data('order_id');

            $('#orderID').val(order_id);

        });

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