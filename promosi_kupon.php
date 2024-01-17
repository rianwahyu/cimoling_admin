<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "promosi";
        $subPage = "promosiCoupon";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Kupon Promosi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Promosi</a></li>
                                <li class="breadcrumb-item active">Kupon Promosi</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-sm-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Kupon Promosi</h3>
                                    <br>
                                    <button type="button" id="btnTambah" class="btn  btn-outline-info" data-toggle="modal" data-target="#modal-promo">Tambah Promosi</button>

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
                                <div class="card-body table-responsive" id="dataBanner">
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

    <div class="modal fade" id="modal-promo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleForm">Form Tambah Promo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlayKategori">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-promo" name="form-promo" method="POST">

                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="postType" name="postType" value="add">
                        <input type="hidden" class="form-control" id="idPromo" name="idPromo">


                        <div class="form-group">
                            <label for="foodName">Kode Promo</label>
                            <input type="text" class="form-control" id="kodePromo" name="kodePromo">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Nilai Promo</label>
                            <input type="number" class="form-control" id="valuePromo" name="valuePromo">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Mulai Periode Promo</label>
                            <input type="date" class="form-control" id="startPeriode" name="startPeriode">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Akhir Periode Promo</label>
                            <input type="date" class="form-control" id="endPeriode" name="endPeriode">
                        </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php include 'include/footer_jquery.php'; ?>

    <!-- Page specific script -->
    <script text="text/javascript">
        $('#pesan').summernote({
            height: 200,
            focus: true
        })


        load_data();

        function load_data(key) {
            $.ajax({
                url: "api/coupon/getCouponPromoAll.php",
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
                            <th class="text-center">NO</th>
                            <th class="text-center">Kode Promo</th>
                            <th class="text-center">Nilai Promo</th>
                            <th class="text-center">Mulai Promo</th>
                            <th class="text-center">Akhir Promo</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;
                        var img = "";
                        var btnStatus = '';
                        var btnNotifikasi = '';
                        for (var count = 0; count < data.length; count++) {
                            //var imageKategori = "storage/" + data[count].foto;
                            var imageUrl = '<img src="' + data[count].contentImage + '" style="width : 100px;" />';

                            btnStatus = '<a href="#" id="showDelete" data-id_promo ="' + data[count].idPromo + '" data-judul="' + data[count].judul + '" class="btn btn-danger btn-sm">Hapus<a/>';

                            htmls += '<tr>';
                            htmls += '<td class="text-right">' + no + '.</td>';
                            htmls += '<td>' + data[count].kodePromo + '</td>';
                            htmls += '<td class="text-right">' + formatRupiah(data[count].valuePromo, '') + '</td>';
                            htmls += '<td>' + data[count].startPeriode + '</td>';
                            htmls += '<td>' + data[count].endPeriode + '</td>';
                            htmls += '<td class="text-left"><a href="#" id="edit" data-toggle="modal" data-target="#modal-promo" data-id_promo="' + data[count].idPromo + '" data-kode_promo="' + data[count].kodePromo + '" data-value_promo="' + data[count].valuePromo + '" data-start_periode="' + data[count].startPeriode + '" data-end_periode="' + data[count].endPeriode + '" class="btn btn-primary btn-sm">Edit</a> ' + btnStatus + '  </td>';
                            htmls += '</tr>';
                            no++;
                        }

                        htmls += `</tbody>
                  </table>`;
                        $("#dataBanner").html(htmls);
                    } else {
                        htmls += `<h4>Data tidak ditemukan  </h4>`;
                        $("#dataBanner").html(htmls);
                    }

                }
            })
        }

        $('#form-promo').validate({
            rules: {
                kodePromo: {
                    required: true,
                },
                valuePromo: {
                    required: true,
                },
                startPeriode: {
                    required: true,
                },
                endPeriode: {
                    required: true,
                },
            },
            messages: {
                kodePromo: {
                    required: "Mohon mengisi kode promo",
                },

                valuePromo: {
                    required: "Mohon mengisi nilai promo",
                },
                startPeriode: {
                    required: "Mohon mengisi awal periode",
                },
                endPeriode: {
                    required: "Mohon mengisi akhir periode",
                },

            },
            submitHandler: function() {
                var username = "<?php echo $username ?>";
                let formData = new FormData();

                formData.append('idPromo', $('#idPromo').val());
                formData.append('kodePromo', $('#kodePromo').val());
                formData.append('valuePromo', $('#valuePromo').val());
                formData.append('startPeriode', $('#startPeriode').val());
                formData.append('endPeriode', $('#endPeriode').val());
                formData.append('postType', $('#postType').val());
                formData.append('username', username);

                var urls = '';

                if ($('#postType').val() == "add") {
                    urls = "api/coupon/addPromo.php";
                } else if ($('#postType').val() == "update") {
                    urls = "api/coupon/updatePromo.php";
                }
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
                            $('#form-promo').get(0).reset()
                            $('#modal-promo').modal('hide');
                            load_data();

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
            var id_promo = $(this).data('id_promo');
            var kode_promo = $(this).data('kode_promo');
            var value_promo = $(this).data('value_promo');
            var start_periode = $(this).data('start_periode');
            var end_periode = $(this).data('end_periode');


            //$('#materialID').prop('readonly', true);
            $('#postType').val("update");
            $('#idPromo').val(id_promo);
            $('#kodePromo').val(kode_promo);
            $('#valuePromo').val(value_promo);
            $('#startPeriode').val(start_periode);
            $('#endPeriode').val(end_periode);
            $("#titleForm").html('Form Edit');

        });

        $('#modal-promo').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })

        $(document).on('click', '#showDelete', function(e) {
            e.preventDefault();
            var id_promo = $(this).data('id_promo');
            console.log(id_promo)
            Swal.fire({
                title: "Hapus Data",
                text: "Apakah anda ingin  menghapus data ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("AAAA")
                    $.ajax({
                        url: "api/coupon/deletePromo.php",
                        type: "POST",
                        data: {
                            idPromo: id_promo,
                        },

                        beforeSend: function() {
                            $('#loader').show();
                        },
                        success: function(result) {
                            $('#loader').hide();

                            Swal.fire(
                                'Berhasil!',
                                'Ubah Data Berhasil',
                                'success'
                            )
                            load_data();
                        }
                    });
                }
            })
        });


        $(document).on('click', '#btnTambah', function(e) {
            $("#titleForm").html('Form Tambah Promo');
            $('#postType').val("add");
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
        })*/
    </script>

</body>

</html>