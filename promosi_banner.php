<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "promosi";
        $subPage = "promosiBanner";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Banner Slider</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Promosi</a></li>
                                <li class="breadcrumb-item active">Banner Slider</li>
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
                                    <h3 class="card-title">Banner Slider</h3>
                                    <br>
                                    <button type="button" id="btnTambah" class="btn  btn-outline-info" data-toggle="modal" data-target="#modal-banner">Tambah Banner</button>

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
                    <h4 class="modal-title" id="titleForm">Form Tambah Banner</h4>
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
                        <input type="hidden" class="form-control" id="contentID" name="contentID">

                        <div class="form-group">
                            <label for="foodName">Gambar Banner</label>
                            <input type="file" class="form-control" id="fileUpload" name="fileUpload">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Nama Banner</label>
                            <input type="text" class="form-control" id="contentTitle" name="contentTitle">
                        </div>

                        <div class="form-group">
                            <label for="foodName">Deskripsi Banner</label>
                            <textarea id="contentValue" name="contentValue" class="ml-10 mr-10"></textarea>
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
        $('#contentValue').summernote({
            height: 200,
            focus: true
        })


        load_data();

        function load_data(key) {
            $.ajax({
                url: "api/content/getContent.php",
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
                        htmls += `<table class="table table-bordered table-striped p-10">
                    <thead>
                        <tr class="">
                            <th class="text-center">NO</th>
                            <th class="text-center">Nama Banner</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>`;

                        var data = object.data;
                        var no = 1;
                        var img = "";
                        var btnStatus = '';
                        for (var count = 0; count < data.length; count++) {
                            //var imageKategori = "storage/" + data[count].foto;
                            var imageUrl = '<img src="' + data[count].contentImage + '" style="width : 100px;" />';

                            btnStatus = '<a href="#" id="showDelete" data-content_id ="' + data[count].contentID  + '" data-content_title="' + data[count].contentTitle + '" data-content_value="'+data[count].contentValue+'" class="btn btn-danger btn-sm">Hapus<a/>';

                            htmls += '<tr>';
                            htmls += '<td>' + no + '</td>';
                            htmls += '<td>' + data[count].contentTitle + '</td>';
                            htmls += '<td>' + data[count].contentValue + '</td>';
                            htmls += '<td class="text-center">' + imageUrl + '</td>';
                            htmls += '<td class="text-left"><a href="#" id="edit" data-toggle="modal" data-target="#modal-banner" data-content_id="' + data[count].contentID  + '" data-content_title="' + data[count].contentTitle + '" data-content_value="'+data[count].contentValue+'" class="btn btn-primary btn-sm">Edit</a> ' + btnStatus + '  </td>';
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
                contentTitle: {
                    required: true,
                },
                contentValue: {
                    required: true,
                },
            },
            messages: {
                contentTitle: {
                    required: "Mohon mengisi nama banner",
                },

                contentValue: {
                    required: "Mohon mengisi konten",
                },

            },
            submitHandler: function() {
                var username = "<?php echo $username ?>";
                let formData = new FormData();
                var fileUpload = $('#fileUpload').prop('files')[0];
                formData.append('fileUpload', fileUpload);
                formData.append('contentID', $('#contentID').val());
                formData.append('contentTitle', $('#contentTitle').val());
                formData.append('contentValue', $('#contentValue').val());
                formData.append('postType', $('#postType').val());
                formData.append('username', username);

                var urls = '';

                if ($('#postType').val() == "add") {
                    urls = "api/content/addContent.php";
                } else if ($('#postType').val() == "update") {
                    urls = "api/content/updateContent.php";
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
            var content_id = $(this).data('content_id');
            var content_title = $(this).data('content_title');
            var content_value = $(this).data('content_value');

            console.log("IDnya " +content_id)
            //$('#materialID').prop('readonly', true);
            $('#postType').val("update");
            $('#contentID').val(content_id);
            $('#contentTitle').val(content_title);            
            $("#contentValue").summernote('code', content_value);
            $("#titleForm").html('Form Edit Banner');

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
            var content_id = $(this).data('content_id');
            var content_title = $(this).data('content_title');

            Swal.fire({
                title: "Hapus Data",
                text: "Apakah anda ingin  menghapus " + content_title + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "api/content/deleteContent.php",
                        type: "POST",
                        data: {
                            contentID: content_id,                            
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
        })

         */
    </script>

</body>

</html>