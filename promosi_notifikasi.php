<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "promosi";
        $subPage = "promosiNotifikasi";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Notifikasi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Promosi</a></li>
                                <li class="breadcrumb-item active">Notifikasi</li>
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
                                    <h3 class="card-title">Daftar Notifikasi</h3>
                                    <br>
                                    <button type="button" id="btnTambah" class="btn  btn-outline-info" data-toggle="modal" data-target="#modal-banner">Tambah Notifikasi</button>

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

    <div class="modal fade" id="modal-banner">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleForm">Form Tambah Notifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlayKategori">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-banner" name="form-banner" method="POST">

                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="postType" name="postType" value="add">
                        <input type="hidden" class="form-control" id="idNotifikasi" name="idNotifikasi">


                        <div class="form-group">
                            <label for="foodName">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Deskripsi Singkat</label>
                            <input type="text" class="form-control" id="deskripsiSingkat" name="deskripsiSingkat">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Pesan Notifikasi</label>
                            <textarea id="pesan" name="pesan" class="ml-10 mr-10"></textarea>
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
                url: "api/notification/getNotification.php",
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
                            <th class="text-center">Judul Notifikasi</th>
                            <th class="text-center">Deskripsi Singkat</th>
                            <th class="text-center">Pesan Notifikasi</th>
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

                            btnStatus = '<a href="#" id="showDelete" data-id_notifikasi ="' + data[count].idNotifikasi  + '" data-judul="' + data[count].judul + '" class="btn btn-danger btn-sm">Hapus<a/>';

                            btnNotifikasi = '<a href="#" id="showNotification" data-id_notifikasi="' + data[count].idNotifikasi   + '" data-judul="' + data[count].judul + '" class="btn btn-primary btn-sm">Kirim Notifikasi<a/>';

                            htmls += '<tr>';
                            htmls += '<td>' + no + '</td>';
                            htmls += '<td>' + data[count].judul  + '</td>';
                            htmls += '<td>' + data[count].deskripsiSingkat + '</td>';
                            htmls += '<td>' + data[count].pesan + '</td>';
                            htmls += '<td class="text-left"><a href="#" id="edit" data-toggle="modal" data-target="#modal-banner" data-id_notifikasi="' + data[count].idNotifikasi  + '" data-judul="' + data[count].judul + '" data-deskripsi_singkat="'+data[count].deskripsiSingkat+'" data-pesan="'+data[count].pesan+'" class="btn btn-primary btn-sm">Edit</a> ' + btnStatus + ' '+ btnNotifikasi +'  </td>';
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

        $('#form-banner').validate({
            rules: {
                judul: {
                    required: true,
                },
                deskripsiSingkat: {
                    required: true,
                },
                pesan: {
                    required: true,
                },
            },
            messages: {
                judul: {
                    required: "Mohon mengisi judul notifikasi",
                },

                deskripsiSingkat: {
                    required: "Mohon mengisi deskripsi",
                },
                pesan: {
                    required: "Mohon mengisi pesan",
                },

            },
            submitHandler: function() {
                var username = "<?php echo $username ?>";
                let formData = new FormData();

                formData.append('idNotifikasi', $('#idNotifikasi').val());
                formData.append('judul', $('#judul').val());
                formData.append('deskripsiSingkat', $('#deskripsiSingkat').val());
                formData.append('pesan', $('#pesan').val());
                formData.append('postType', $('#postType').val());
                formData.append('username', username);

                var urls = '';

                if ($('#postType').val() == "add") {
                    urls = "api/notification/addNotification.php";
                } else if ($('#postType').val() == "update") {
                    urls = "api/notification/updateNotification.php";
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
                            $('#form-banner').get(0).reset()
                            $('#modal-banner').modal('hide');
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
            var id_notifikasi = $(this).data('id_notifikasi');
            var judul = $(this).data('judul');
            var deskripsi_singkat = $(this).data('deskripsi_singkat');
            var pesan = $(this).data('pesan');

            console.log("IDnya " +id_notifikasi)
            //$('#materialID').prop('readonly', true);
            $('#postType').val("update");
            $('#idNotifikasi').val(id_notifikasi);
            $('#judul').val(judul);
            $('#deskripsiSingkat').val(deskripsi_singkat);            
            $("#pesan").summernote('code', pesan);
            $("#titleForm").html('Form Edit');

        });

        $('#modal-banner').on('hidden.bs.modal', function(e) {
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
            var id_notifikasi = $(this).data('id_notifikasi');        
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
                    $.ajax({
                        url: "api/notification/deleteNotification.php",
                        type: "POST",
                        data: {
                            idNotifikasi: id_notifikasi,                            
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

        $(document).on('click', '#showNotification', function(e) {
            e.preventDefault();
            var id_notifikasi = $(this).data('id_notifikasi');        
            Swal.fire({
                title: "Kirim Notifikasi",
                text: "Apakah anda ingin  mengirim Notifikasi ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "api/notification/blastNotification.php",
                        type: "POST",
                        data: {
                            idNotifikasi: id_notifikasi,                            
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
            $("#titleForm").html('Form Tambah Banner');
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