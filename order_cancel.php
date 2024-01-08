<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "order";
        $subPage = "orderCancel";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Order Cancel</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Order</a></li>
                                <li class="breadcrumb-item active">Order Cancel</li>
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
                                    <h3 class="card-title">Daftar Order Status DiBatalkan </h3>
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
                    status: '5',
                    key: 'cancel',
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
                            <th class="text-center text-nowrap">Order ID</th>
                            <th class="text-center text-nowrap">Nama Member</th>
                            <th class="text-center text-nowrap">Kategori</th>
                            <th class="text-center text-nowrap">Layanan</th>
                            <th class="text-center text-nowrap">Jadwal Permintaan</th>
                            <th class="text-center text-nowrap">Alasan Cancel Order</th>
                            <th class="text-center text-nowrap">Waktu Cancel</th>
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
                            htmls += '<td>' + data[count].alasanCancel + '</td>';
                            htmls += '<td>' + data[count].tglCancel + '</td>';

                            // htmls += '<td class="text-left text-nowrap"><a href="#" id="jadwal" data-toggle="modal" data-target="#modal-jadwal" data-order_id="' + data[count].orderID + '" data-tanggal_order="' + data[count].tanggalOrder + '" data-waktu_order="' + data[count].waktuOrder + '" class="btn btn-info btn-sm">Ubah Jadwal</a> &nbsp <a href="#" id="confirm" data-toggle="modal" data-target="#modal-confirm" data-order_id="' + data[count].orderID + '" class="btn btn-primary btn-sm">Konfirmasi</a> &nbsp <a href="#" id="cancel" data-toggle="modal" data-target="#modal-cancel" data-order_id="' + data[count].orderID + '" class="btn btn-danger btn-sm">Batalkan</a> </td>';

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

        $('#form-jadwal').validate({
            rules: {
                tanggalUbahJadwal: {
                    required: true,
                },
                waktuUbahJadwal: {
                    required: true,
                },
                alasanJadwal: {
                    required: true,
                },

            },
            messages: {
                tanggalUbahJadwal: {
                    required: "Mohon mengisi tanggal",
                },

                waktuUbahJadwal: {
                    required: "Mohon mengisi waktu",
                },
                alasanJadwal: {
                    required: "Mohon mengisi alasan mengubah jadwal layanan",
                },

            },
            submitHandler: function() {
                let formData = new FormData();

                formData.append('orderID', $('#orderIDJadwal').val());
                formData.append('username', idAdmin);
                //formData.append('status', "0");
                formData.append('dateOrderBefore', $('#tanggalJadwal').val());
                formData.append('timeOrderBefore', $('#waktuJadwal').val());

                formData.append('dateOrderChange', $('#tanggalUbahJadwal').val());
                formData.append('timeOrderChange', $('#waktuUbahJadwal').val());
                formData.append('reasonChangeDate', $('#alasanJadwal').val());

                var urls = 'api/order/changeRequestDateOrder.php';

                $.ajax({
                    url: urls,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#overlayOrder').show();
                    },
                    success: function(result) {
                        $('#overlayOrder').hide();
                        var hasil = JSON.parse(result);
                        var success = hasil.success;
                        var message = hasil.message;
                        if (success == true) {
                            $('#form-jadwal').get(0).reset()
                            $('#modal-jadwal').modal('hide');

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

        $(document).on('click', '#jadwal', function(e) {
            e.preventDefault();
            var order_id = $(this).data('order_id');
            var tanggal_order = $(this).data('tanggal_order');
            var waktu_order = $(this).data('waktu_order');

            $('#orderIDJadwal').val(order_id);
            $('#tanggalJadwal').val(tanggal_order);
            $('#waktuJadwal').val(waktu_order);

            load_jadwal();

        });

        $(document).on('click', '#confirm', function(e) {
            e.preventDefault();
            var order_id = $(this).data('order_id');
            $('#orderIDConfirm').val(order_id);
        });

        $('#form-confirm').validate({
            rules: {


            },
            messages: {
                // tanggalUbahJadwal: {
                //     required: "Mohon mengisi tanggal",
                // },
            },
            submitHandler: function() {
                let formData = new FormData();

                formData.append('orderID', $('#orderIDConfirm').val());
                formData.append('username', idAdmin);
                formData.append('status', "1");
                formData.append('ketProses', "confirm");

                var urls = 'api/order/updateOrderAdmin.php';

                $.ajax({
                    url: urls,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#overlayConfirm').show();
                    },
                    success: function(result) {
                        $('#overlayConfirm').hide();
                        var hasil = JSON.parse(result);
                        var success = hasil.success;
                        var message = hasil.message;
                        if (success == true) {
                            $('#form-confirm').get(0).reset()
                            $('#modal-confirm').modal('hide');

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


        $(document).on('click', '#cancel', function(e) {
            e.preventDefault();
            var order_id = $(this).data('order_id');
            $('#orderIDCancel').val(order_id);
        });

        $('#form-cancel').validate({
            rules: {
                reasonCancel: {
                    required: true,
                },

            },
            messages: {
                reasonCancel: {
                    required: "Mohon mengisi alasan cancel order layanan",
                },

            },
            submitHandler: function() {
                let formData = new FormData();

                formData.append('orderID', $('#orderIDCancel').val());
                formData.append('username', idAdmin);
                formData.append('status', "1");
                formData.append('ketProses', "cancel");
                formData.append('reasonCancel', $('#reasonCancel').val());

                var urls = 'api/order/updateOrderAdmin.php';

                $.ajax({
                    url: urls,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#overlayOrder').show();
                    },
                    success: function(result) {
                        $('#overlayOrder').hide();
                        var hasil = JSON.parse(result);
                        var success = hasil.success;
                        var message = hasil.message;
                        if (success == true) {
                            $('#form-cancel').get(0).reset()
                            $('#modal-cancel').modal('hide');

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

        function load_jadwal() {
            $.ajax({
                url: "api/option/getJadwal.php",
                method: "GET",
                success: function(data) {
                    //$("#loader").hide();
                    var object = JSON.parse(data);
                    console.log("Last Activity : " + object);

                    var htmls = '';

                    var success = object.success;

                    if (success == true) {

                        var data = object.data;
                        var no = 1;
                        var htmls = '';
                        htmls += '<option selected disabled>Pilih Waktu</option>'
                        for (var count = 0; count < data.length; count++) {
                            htmls += '<option value="' + data[count].timeReal + '">' + data[count].timeDisplay + '</option>'
                        }

                        $("#waktuUbahJadwal").html(htmls);
                    } else {
                        htmls += '<option selected disabled>Data Tidak Ditemukan</option>'
                        $("#waktuUbahJadwal").html(htmls);
                    }

                }
            })
        }

        $('#modal-confirm').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })

        $('#modal-cancel').on('hidden.bs.modal', function(e) {
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