<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "master";
        $subPage = "masterSubCategory";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Layanan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Master</a></li>
                                <li class="breadcrumb-item active">Layanan</li>
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
                                    <h3 class="card-title">Daftar Layanan</h3>
                                    <br>
                                    <button type="button" id="btnTambah" class="btn  btn-outline-info" data-toggle="modal" data-target="#modal-kategori">Tambah Layanan</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive" id="dataKategori">
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="col-sm-12 col-md-6" id="cardPrice" style="display: none;">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title" id="nm_lynan">Daftar Harga</h3>
                                    <br>
                                    <button type="button" id="btnTambahHarga" class="btn  btn-outline-info" data-toggle="modal" data-target="#modal-harga">Tambah Jenis Harga</button>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive" id="dataHarga">
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

    <div class="modal fade" id="modal-kategori">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleForm">Form Tambah Layanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlayKategori">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-kategori" name="form-kategori" method="POST">

                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="postType" name="postType" value="add">
                        <input type="hidden" class="form-control" id="idJenis" name="idJenis">

                        <div class="form-group">
                            <label for="foodName">Kategori</label>
                            <select class="form-control" name="kategori" id="kategori">

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="foodName">Nama Layanan</label>
                            <input type="text" class="form-control" id="namaJenis" name="namaJenis">
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

    <div class="modal fade" id="modal-harga">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleFormHarga">Form Tambah Harga</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="overlay" style="display: none" id="overlayKategori">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <form role="form" action="" id="form-harga" name="form-harga" method="POST">

                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="postTypeHarga" name="postTypeHarga" value="add">
                        <input type="hidden" class="form-control" id="idHarga" name="idHarga">
                        <input type="hidden" class="form-control" id="idJenisHarga" name="idJenisHarga">

                        <div class="form-group">
                            <label for="foodName">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga">
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
        load_data();

        function load_data(key) {
            $.ajax({
                url: "api/subCategory/getSubCategoryAll.php",
                method: "GET",
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
                        htmls += `<table class="table table-bordered table-striped p-10">
                    <thead>
                        <tr class="">
                            <th class="text-center">NO</th>
                            <th class="text-center">Nama Layannan</th>
                            <th class="text-center">Nama Kategori</th>                        
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;
                        var img = "";
                        var btnStatus = '';
                        var btnSetharga = '';
                        for (var count = 0; count < data.length; count++) {
                            if (data[count].status == "active") {
                                btnStatus = '<a href="#" id="showStatus" data-id_jenis="' + data[count].idJenis + '" data-nama_jenis="' + data[count].namaJenis + '" data-remark="Sembunyikan layanan" data-status="nonActive" class="btn btn-info btn-sm">Sembunyikan<a/>';
                            } else {
                                btnStatus = '<a href="#" id="showStatus" data-id_jenis="' + data[count].idJenis + '" data-nama_jenis="' + data[count].namaJenis + ' data-remark="Tampilkan layanan" data-status="active" class="btn btn-info btn-sm">Tampilkan<a/>';
                            }

                            btnSetharga = '<a href="#" id="showPrice" data-id_jenis="' + data[count].idJenis + '" data-nama_jenis="' + data[count].namaJenis + '" class="btn btn-info btn-sm">Set Harga<a/>';


                            htmls += '<tr>';
                            htmls += '<td>' + no + '</td>';
                            htmls += '<td>' + data[count].namaJenis + '</td>';
                            htmls += '<td>' + data[count].namaKategori + '</td>';
                            htmls += '<td class="text-left"><a href="#" id="edit" data-toggle="modal" data-target="#modal-kategori" data-id_jenis="' + data[count].idJenis + '" data-id_kategori="' + data[count].idLayanan + '" data-nama_jenis="' + data[count].namaJenis + '" class="btn btn-primary btn-sm">Edit</a> ' + btnStatus + ' ' + btnSetharga + ' </td>';
                            htmls += '</tr>';
                            no++;
                        }

                        htmls += `</tbody>
                  </table>`;
                        $("#dataKategori").html(htmls);
                    } else {
                        htmls += `<h4>Data tidak ditemukan  </h4>`;
                        $("#dataKategori").html(htmls);
                    }

                }
            })
        }

        getKategori();

        function getKategori() {
            $.ajax({
                url: "api/category/getCategorySimple.php",
                method: "GET",
                data: {
                    // postType: 'getData',
                    // key: key,
                },
                beforeSend: function() {
                    //$("#loader").show();
                },

                success: function(data) {
                    //$("#loader").hide();
                    var object = JSON.parse(data);
                    var htmls = '';
                    var success = object.success;

                    if (success == true) {
                        var data = object.data;
                        var no = 1;
                        htmls += '<option disabled selected>Pilih Kategori</option>';
                        for (var count = 0; count < data.length; count++) {
                            htmls += '<option value="' + data[count].idKategori + '">' + data[count].namaKategori + '</option>';
                        }
                        $("#kategori").html(htmls);
                    }
                }
            })
        }

        $('#form-kategori').validate({
            rules: {
                kategori: {
                    required: true,
                },
                namaJenis: {
                    required: true,
                },
            },
            messages: {
                kategori: {
                    required: "Mohon memilih kategori",
                },

                namaJenis: {
                    required: "Mohon mengisi nama layanan/jenis",
                },

            },
            submitHandler: function() {
                var username = "<?php echo $username ?>";
                let formData = new FormData();

                formData.append('idLayanan', $('#kategori').val());
                formData.append('namaJenis', $('#namaJenis').val());
                formData.append('idJenis', $('#idJenis').val());
                formData.append('postType', $('#postType').val());
                formData.append('username', username);

                var urls = '';

                if ($('#postType').val() == "add") {
                    urls = "api/subCategory/addSubCategory.php";
                } else if ($('#postType').val() == "update") {
                    urls = "api/subCategory/updateSubCategory.php";
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
                            $('#form-kategori').get(0).reset()
                            $('#modal-kategori').modal('hide');
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
            var id_jenis = $(this).data('id_jenis');
            var nama_jenis = $(this).data('nama_jenis');
            var id_kategori = $(this).data('id_kategori');
            //$('#materialID').prop('readonly', true);
            $('#postType').val("update");
            $('#idJenis').val(id_jenis);
            $('#namaJenis').val(nama_jenis);
            $('#kategori').val(id_kategori);
            $("#titleForm").html('Form Edit');

        });

        $('#modal-kategori').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })

        $(document).on('click', '#showStatus', function(e) {
            e.preventDefault();
            var id_jenis = $(this).data('id_jenis');
            var nama_jenis = $(this).data('nama_jenis');
            var status = $(this).data('status');
            var remark = $(this).data('remark');
            Swal.fire({
                title: remark,
                text: "Apakah anda ingin " + remark + " " + nama_jenis + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "api/subCategory/updateStatus.php",
                        type: "POST",
                        data: {
                            idJenis: id_jenis,
                            status: status,
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
            $("#titleForm").html('Form Tambah Layanan');
            $('#postType').val("add");
        });

        $(document).on('click', '#showPrice', function(e) {
            e.preventDefault();
            var id_jenis = $(this).data('id_jenis');
            var nama_jenis = $(this).data('nama_jenis');
            $("#nm_lynan").html("Daftar Harga " + nama_jenis);
            $("#cardPrice").show();
            $("#idJenisHarga").val(id_jenis);
            $("#postTypeHarga").val("add");

            getPrice(id_jenis, nama_jenis);
        });

        function getPrice(id_jenis, nama_jenis) {
            $.ajax({
                url: "api/subCategoryPrice/getSubCategoryPrice.php",
                method: "POST",
                data: {
                    idSubKategori: id_jenis,
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
                        htmls += `<table class="table table-bordered table-striped p-10">
                    <thead>
                        <tr class="">
                            <th class="text-center">No</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Harga</th>                        
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;
                        var img = "";
                        var btnStatus = '';
                        var btnSetharga = '';
                        for (var count = 0; count < data.length; count++) {
                            htmls += '<tr>';
                            htmls += '<td>' + no + '</td>';
                            htmls += '<td>' + data[count].keterangan + '</td>';
                            htmls += '<td class="text-right">' + data[count].harga + '</td>';
                            htmls += '<td class="text-left"><a href="#" id="editHarga" data-toggle="modal" data-target="#modal-harga" data-id_harga="' + data[count].idHarga + '" data-id_jenis_harga="' + data[count].idSubKategori + '" data-keterangan="' + data[count].keterangan + '" data-harga="' + data[count].harga + '" class="btn btn-primary btn-sm">Edit</a></td>';
                            htmls += '</tr>';
                            no++;
                        }

                        htmls += `</tbody>
                  </table>`;
                        $("#dataHarga").html(htmls);
                    } else {
                        htmls += `<h4>Harga Belum ditambahkan</h4>`;
                        $("#dataHarga").html(htmls);
                    }

                }
            })
        }

        $(document).on('click', '#editHarga', function(e) {
            e.preventDefault();
            var id_harga = $(this).data('id_harga');
            var id_jenis_harga = $(this).data('id_jenis_harga');
            var keterangan = $(this).data('keterangan');
            var harga = $(this).data('harga');
            console.log("Harga" +harga);
            //$('#materialID').prop('readonly', true);
            $('#postTypeHarga').val("update");
            $('#idJenisHarga').val(id_jenis_harga);
            $('#idHarga').val(id_harga);
            $('#harga').val(harga);
            $('#keterangan').val(keterangan);
            $("#titleFormHarga").html('Form Edit');

        });

        $('#form-harga').validate({
            rules: {
                keterangan: {
                    required: true,
                },
                harga: {
                    required: true,
                },
            },
            messages: {
                keterangan: {
                    required: "Mohon mengisi keterangan",
                },

                harga: {
                    required: "Mohon mengisi harga",
                },

            },
            submitHandler: function() {
                var username = "<?php echo $username ?>";
                let formData = new FormData();

                formData.append('idHarga', $('#idHarga').val());
                formData.append('keterangan', $('#keterangan').val());
                formData.append('harga', $('#harga').val());
                formData.append('idSubKategori', $('#idJenisHarga').val());
                formData.append('postTypeHarga', $('#postTypeHarga').val());
                formData.append('username', username);

                var urls = '';

                if ($('#postTypeHarga').val() == "add") {
                    urls = "api/subCategoryPrice/addSubCategoryPrice.php";
                } else if ($('#postTypeHarga').val() == "update") {
                    urls = "api/subCategoryPrice/updateSubCategoryPrice.php";
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
                            var id_jenis = $('#idJenisHarga').val();
                            getPrice(id_jenis, "");
                            $('#form-harga').get(0).reset()
                            $('#modal-harga').modal('hide');    
                            
                            // console.log("SUCCESS" + id_jenis);
                            

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
    </script>

</body>

</html>