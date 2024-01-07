<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "order";
        $subPage = "orderPending";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Order Masuk</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Order</a></li>
                                <li class="breadcrumb-item active">Order Masuk</li>
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
                                    <h3 class="card-title">Daftar Order Masuk</h3>
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

    <div class="modal fade" id="modal-order">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleForm">Proses Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlayOrder">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-order" name="form-order" method="POST">

                    <div class="modal-body">

                        <!-- <input type="hidden" class="form-control" id="postType" name="postType" value="add"> -->
                        <input type="hidden" class="form-control" id="orderID" name="orderID">

                        <h3>Apakah anda ingin memproses Order terpilih ?</h3>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
                        <button class="btn btn-primary">Ya</button>
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
                    status: '0',
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
                        htmls += `<table class="table table-bordered table-sm table-striped p-0">
                    <thead>
                        <tr class="">
                            <th class="text-center">Order ID</th>
                            <th class="text-center">Nama Member</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Layanan</th>
                            <th class="text-center">Jadwal Permintaan</th>
                            <th class="text-center">Alamat Permintaan Cuci</th>
                            <th class="text-center">Biaya Layanan</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;

                        for (var count = 0; count < data.length; count++) {

                            htmls += '<tr>';
                            htmls += '<td>' + data[count].orderID + '</td>';
                            htmls += '<td>' + data[count].namaLengkap + '</td>';
                            htmls += '<td>' + data[count].tipeKendaraan + '</td>';
                            htmls += '<td>' + data[count].namaJenis + '-' + data[count].ketHarga + '</td>';
                            htmls += '<td>' + data[count].tanggalOrder + ' ' + data[count].waktuOrder + '</td>';
                            htmls += '<td class="text-wrap">' + data[count].alamatOrder + '</td>';
                            htmls += '<td>' + data[count].harga + '</td>';

                            htmls += '<td class="text-left"><a href="#" id="edit" data-toggle="modal" data-target="#modal-order" data-order_id="' + data[count].orderID + '" class="btn btn-info btn-sm">Proses Order</a> </td>';

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

        $('#form-order').validate({
            rules: {
                // namaKategori: {
                //     required: true,
                // },
                // deskripsiKategori: {
                //     required: true,
                // },
            },
            messages: {
                // namaKategori: {
                //     required: "Mohon mengisi nama kategori",
                // },

                // deskripsiKategori: {
                //     required: "Mohon mengisi nama deskripsi kategori",
                // },

            },
            submitHandler: function() {
                let formData = new FormData();

                formData.append('orderID', $('#orderID').val());
                formData.append('username', idAdmin);
                formData.append('status', "0");

                var urls = 'api/order/updateOrderAdmin.php';

                $.ajax({
                    url: urls,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    success: function(result) {
                        $('#loader').hide();
                        var hasil = JSON.parse(result);
                        var success = hasil.success;
                        var message = hasil.message;
                        if (success == true) {
                            $('#form-order').get(0).reset()
                            $('#modal-order').modal('hide');

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


        $(document).on('click', '#edit', function(e) {
            e.preventDefault();
            var order_id = $(this).data('order_id');
            $('#orderID').val(order_id);

        });

        $('#modal-order').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })



        /* var key = '';
        $(document).on('click', '#btnSearch', function(e) {
            key = $("#key").val();
            load_data(key)
        });

        $("#key").on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                key = $("#key").val();
                load_data(key)
            }
        });

        load_data(key);

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        
        $(document).on('click', '#btnTambah', function(e) {
            $("#titleForm").html('Form Tambah Kain');
            $('#postType').val("add");
        });

        $('#modal-add').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })

         */
    </script>

</body>

</html>