<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "order";
        $subPage = "orderConfirm";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Order Konfirmasi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Order</a></li>
                                <li class="breadcrumb-item active">Order Confirm</li>
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
                                    <h3 class="card-title">Daftar Order Status DiKonfirmasi </h3>
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

    <div class="modal fade" id="modal-delivery">
        <div class="modal-dialog ui-front">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleForm">Atur Perjalanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlayDelivery">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-delivery" name="form-delivery" method="POST">

                    <div class="modal-body">

                        <h4>Form Setting Perjalanan ke Customer Cimoling</h4>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Tanggal Order</label>
                                <input class="form-control" type="date" id="tanggalJadwal" name="tanggalJadwal">
                            </div>

                            <div class="form-group col-6">
                                <label for="">Waktu Order</label>
                                <input class="form-control" type="time" id="waktuJadwal" name="waktuJadwal">
                            </div>

                        </div>

                        <table class="table mt-4" id="dynamic_field">
                            <thead>
                                <tr>
                                    <th>Nama Pegawai</th>
                                    <th>Jabatan</th>
                                    <th></th>
                                </tr>

                            </thead>

                            <tbody id="tbodyItem">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">
                                        <button class="btn btn-sm btn-info" id="addmore" type="button">Tambah Data</button>
                                    </th>
                                </tr>

                            </tfoot>
                        </table>

                        <!-- <input type="hidden" class="form-control" id="postType" name="postType" value="add"> -->
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
                    status: '2',
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
                            <th class="text-center text-nowrap">Order ID</th>
                            <th class="text-center text-nowrap">Nama Member</th>
                            <th class="text-center text-nowrap">Kategori</th>
                            <th class="text-center text-nowrap">Layanan</th>
                            <th class="text-center text-nowrap">Jadwal Permintaan</th>
                            <th class="text-center text-nowrap">Alamat Permintaan Cuci</th>
                            <th class="text-center text-nowrap">Biaya Layanan</th>
                            <th class="text-center text-nowrap">Opsi</th>
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
                            htmls += '<td class="text-right">' + formatRupiah(data[count].harga, '') + '</td>';

                            htmls += '<td class="text-left text-nowrap"><a href="#" id="delivery" data-toggle="modal" data-target="#modal-delivery" data-order_id="' + data[count].orderID + '"  data-tanggal_order="' + data[count].tanggalOrder + '" data-waktu_order="' + data[count].waktuOrder + '" class="btn btn-info btn-sm">Atur Perjalanan</a> </td>';

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

        $('#form-delivery').validate({
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


                var actualPNValue = $("input[name='idKaryawan[]']").map(function() {
                    return $(this).val();
                }).get();


                for (var i = 0; i < actualPNValue.length; i++) {
                    formData.append('idKaryawan[]', actualPNValue[i]);
                }

                formData.append('orderID', $('#orderID').val());
                formData.append('username', idAdmin);
                formData.append('status', "2");

                var urls = 'api/order/updateOrderAdmin.php';

                $.ajax({
                    url: urls,
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#overlayDelivery').show();
                    },
                    success: function(result) {
                        $('#overlayDelivery').hide();
                        var hasil = JSON.parse(result);
                        var success = hasil.success;
                        var message = hasil.message;
                        if (success == true) {
                            $('#form-delivery').get(0).reset()
                            $('#modal-delivery').modal('hide');

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

        $(document).on('click', '#delivery', function(e) {
            e.preventDefault();
            var order_id = $(this).data('order_id');
            var tanggal_order = $(this).data('tanggal_order');
            var waktu_order = $(this).data('waktu_order');

            //console.log("TES")

            $('#orderID').val(order_id);
            $('#tanggalJadwal').val(tanggal_order);
            $('#waktuJadwal').val(waktu_order);

            setTableFirst();

        });

        $('#modal-delivery').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })

        function setTableFirst() {
            var indexing = 1;
            var htmls = '';

            htmls += '<tr class="tr_input">';
            htmls += '<td><input type="text" class="form-control namaKaryawan" id="namaKaryawan_' + indexing + '" placeholder="" name="namaKaryawan[]"></td>';
            htmls += '<input type="hidden" class="form-control idKaryawan" id="idKaryawan_' + indexing + '" placeholder="" name="idKaryawan[]">';
            htmls += '<td><input type="text" class="form-control" id="jabatan_' + indexing + '" placeholder="" name="jabatan[]" readonly></td>';
            htmls += '<td><a class="btn btn-danger btn-sm btnRemove" id="btnRemove_' + indexing + '">Del</a></td>';
            htmls += '</tr>';
            $("#tbodyItem").html(htmls);
        }

        $('#addmore').click(function() {
            var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
            if (lastname_id == undefined) {
                setTableFirst();
            }
            var split_id = lastname_id.split('_');
            var indexing = Number(split_id[1]) + 1;

            var htmls = '';

            htmls += '<tr class="tr_input">';
            htmls += '<td><input type="text" class="form-control namaKaryawan" id="namaKaryawan_' + indexing + '" placeholder="" name="namaKaryawan[]"></td>';
            htmls += '<input type="hidden" class="form-control idKaryawan" id="idKaryawan_' + indexing + '" placeholder="" name="idKaryawan[]">';
            htmls += '<td><input type="text" class="form-control" id="jabatan_' + indexing + '" placeholder="" name="jabatan[]" readonly></td>';
            htmls += '<td><a class="btn btn-danger btn-sm btnRemove" id="btnRemove_' + indexing + '">Del</a></td>';
            htmls += '</tr>';
            $("#tbodyItem").append(htmls);

        });

        $(document).on('click', '.btnRemove', function() {
            $(this).closest('tr').remove();
        });


        $(document).on('focus', '.namaKaryawan', function() {
            var id = this.id;
            var splitid = id.split('_');
            var index = splitid[1];

            $('#' + id).autocomplete({
                source: function(request, response) {

                    $.ajax({
                        url: "api/employee/getEmployeeBySearch.php",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            request: 1,
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    var idKaryawan = ui.item.value;


                    $.ajax({
                        url: 'api/employee/getEmployeeBySearch.php',
                        type: 'POST',
                        data: {
                            idKaryawan: idKaryawan,
                            request: 2,
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            var len = response.length;
                            if (len > 0) {
                                var namaKaryawan = response[0]['namaKaryawan'];
                                document.getElementById('namaKaryawan_' + index).value = namaKaryawan;
                                var idKaryawan = response[0]['idKaryawan'];
                                document.getElementById('idKaryawan_' + index).value = idKaryawan;
                                var jabatan = response[0]['jabatan'];
                                document.getElementById('jabatan_' + index).value = jabatan;
                            }
                        }
                    });
                    return false;
                }
            });
        });


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