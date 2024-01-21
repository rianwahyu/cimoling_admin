<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "utility";
        $subPage = "utilityWhatsapp";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Whatsapp Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Utility</a></li>
                                <li class="breadcrumb-item active">Whatsapp Admin</li>
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
                                    <h3 class="card-title">Daftar No Whatsapp Admin</h3>
                                    <br>
                                    <button type="button" id="btnTambah" class="btn  btn-outline-info" data-toggle="modal" data-target="#modal-whatsapp">Tambah Nomor</button>

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
                                <div class="card-body table-responsive" id="dataWhatsapp">
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

    <div class="modal fade" id="modal-whatsapp">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleForm">Form Tambah Whatsapp</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlayKategori">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-whatsapp" name="form-whatsapp" method="POST">

                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="postType" name="postType" value="add">
                        <input type="hidden" class="form-control" id="id" name="id">


                        <div class="form-group">
                            <label for="foodName">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Nomor Whatsapp</label>
                            <small>Awali dengan 62</small>
                            <input type="number" class="form-control" id="nomor" name="nomor">
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
                url: "api/whatsapp/getWhatsappNumber.php",
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
                            <th class="text-center">Nama</th>
                            <th class="text-center">Nomor</th>
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

                            btnStatus = '<a href="#" id="showDelete" data-id ="' + data[count].id + '" data-nama="' + data[count].judul + '" class="btn btn-danger btn-sm">Hapus<a/>';

                            htmls += '<tr>';
                            htmls += '<td class="text-right">' + no + '.</td>';
                            htmls += '<td>' + data[count].nama + '</td>';
                            htmls += '<td>' + data[count].nomor + '</td>';
                            htmls += '<td class="text-left"><a href="#" id="edit" data-toggle="modal" data-target="#modal-whatsapp" data-id="' + data[count].id + '" data-nama="' + data[count].nama + '" data-nomor="' + data[count].nomor + '" class="btn btn-primary btn-sm">Edit</a> ' + btnStatus + '  </td>';
                            htmls += '</tr>';
                            no++;
                        }

                        htmls += `</tbody>
                  </table>`;
                        $("#dataWhatsapp").html(htmls);
                    } else {
                        htmls += `<h4>Data tidak ditemukan  </h4>`;
                        $("#dataWhatsapp").html(htmls);
                    }

                }
            })
        }

        $('#form-whatsapp').validate({
            rules: {
                nama: {
                    required: true,
                },
                nomor: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Mohon mengisi kode promo",
                },

                nomor: {
                    required: "Mohon mengisi nilai promo",
                },

            },
            submitHandler: function() {
                var username = "<?php echo $username ?>";
                let formData = new FormData();

                formData.append('id', $('#id').val());
                formData.append('nama', $('#nama').val());
                formData.append('nomor', $('#nomor').val());
                formData.append('postType', $('#postType').val());
                formData.append('username', username);

                var urls = '';

                if ($('#postType').val() == "add") {
                    urls = "api/whatsapp/addWhatsapp.php";
                } else if ($('#postType').val() == "update") {
                    urls = "api/whatsapp/updateWhatsapp.php";
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
                            $('#form-whatsapp').get(0).reset()
                            $('#modal-whatsapp').modal('hide');
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
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var nomor = $(this).data('nomor');


            //$('#materialID').prop('readonly', true);
            $('#postType').val("update");
            $('#id').val(id);
            $('#nama').val(nama);
            $('#nomor').val(nomor);
            $("#titleForm").html('Form Edit');

        });

        $('#modal-whatsapp').on('hidden.bs.modal', function(e) {
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
            var id = $(this).data('id');
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
                        url: "api/whatsapp/deleteWhatsapp.php",
                        type: "POST",
                        data: {
                            id: id,
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
            $("#titleForm").html('Form Tambah Whatsapp');
            $('#postType').val("add");
        });
    </script>

</body>

</html>