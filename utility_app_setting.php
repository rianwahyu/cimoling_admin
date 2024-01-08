<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "utility";
        $subPage = "utilityAboutApps";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tentang Aplikasi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Setting</a></li>
                                <li class="breadcrumb-item active">Tentang Aplikasi</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Tentang Aplikasi</h3>
                                </div>
                                <div class="overlay-wrapper" style="display: none" id="overlay">
                                    <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                        <div class="text-bold pt-2">Loading...</div>
                                    </div>

                                </div>
                                <form role="form" name="form-add" id="form-add">
                                    <div class="card-body">


                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Nama Aplikasi</label>
                                                    <input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi">
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Nama Singkat</label>
                                                    <input type="text" class="form-control" id="nama_singkat" name="nama_singkat">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Subtitle Judul</label>
                                                    <input type="text" class="form-control" id="subtitle_aplikasi" name="subtitle_aplikasi">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Logo</label>
                                                    <br>
                                                    <img class="text-right" src="" alt="" id="imgLogo" name="imgLogo" style="width: 60px; height: 60px;" />
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Ganti Logo</label>
                                                    <input type="file" class="form-control" id="logo_aplikasi" name="logo_aplikasi" accept="image/*">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="">Link Kebijakan Privasi</label>
                                            <input type="text" class="form-control" id="link_kebijakan_privasi" name="link_kebijakan_privasi">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Tentang Aplikasi</label>
                                            <textarea id="about" name="about" class="ml-10 mr-10"></textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Link FB</label>
                                                    <input type="text" class="form-control" id="link_fb" name="link_fb" placeholder="Link Facebook">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Link IG</label>
                                                    <input type="text" class="form-control" id="link_ig" name="link_ig" placeholder="Link Instagram">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Link Twitter</label>
                                                    <input type="text" class="form-control" id="link_twitter" name="link_twitter" placeholder="Link Twitter">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Link Tiktok</label>
                                                    <input type="text" class="form-control" id="link_tiktok" name="link_tiktok" placeholder="Link Tiktok">
                                                </div>
                                            </div>

                                        </div>


                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Background Home</label>
                                                    <br>
                                                    <img src="" alt="" id="imgHome" name="imgHome" style="width: 640px; height: 426px;" />
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Ganti Background</label>
                                                    <input type="file" class="form-control" id="background_home" name="background_home" accept="image/*">
                                                </div>
                                            </div>
                                        </div> -->

                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                                    </div>
                                </form>
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
    <!-- /.content-wrapper -->
    <?php include 'include/footer.php'; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <?php include 'include/footer_jquery.php'; ?>

    <!-- Page specific script -->
    <script type="text/javascript">
        $('#about').summernote({
            height: 400,
            focus: true
        })

        load_data();

        var locLogo = "storage/";
        var locBackground = "storage/";

        function load_data() {
            $.ajax({
                url: "api/about/getAboutApps.php",
                type: "GET",
                beforeSend: function() {},
                success: function(result) {
                    var hasil = JSON.parse(result);
                    console.log(hasil.hasil);
                    $("#link_kebijakan_privasi").val(hasil.link_kebijakan_privasi);
                    $("#about").summernote('code', hasil.about);
                    $("#nama_aplikasi").val(hasil.nama_aplikasi);
                    $("#nama_singkat").val(hasil.nama_singkat);
                    $("#link_fb").val(hasil.link_fb);
                    $("#link_ig").val(hasil.link_ig);
                    $("#link_twitter").val(hasil.link_twitter);
                    $("#link_tiktok").val(hasil.link_tiktok);
                    $("#subtitle_aplikasi").val(hasil.subtitle_aplikasi);

                    var logo_aplikasi = hasil.logo_aplikasi;

                    if (logo_aplikasi == "") {
                        locLogo = locLogo + "/" + "logo_example.png";
                    } else {
                        locLogo = locLogo + "/" + logo_aplikasi;
                    }

                    document.getElementById("imgLogo").src = locLogo;

                    /* 


                    console.log(locLogo)


                    


                    var background_home = hasil.background_home;

                    if (background_home == "") {
                        console.log("kosong");
                        locBackground = locBackground + "/" + "hero-bg.jpg";
                    } else {
                        locBackground = locBackground + "/" + background_home;
                    }

                    console.log(locBackground)


                    document.getElementById("imgHome").src = locBackground; */
                }
            });
        }

        $("#form-add").submit(function(e) {
            e.preventDefault();

            /* const img_logo_aplikasi = $('#logo_aplikasi').prop('files')[0];
            const img_background_home = $('#background_home').prop('files')[0]; */

            let formData = new FormData();
            formData.append('link_kebijakan_privasi', $("#link_kebijakan_privasi").val());
            formData.append('about', $("#about").val());
            formData.append('nama_aplikasi', $("#nama_aplikasi").val());
            formData.append('nama_singkat', $("#nama_singkat").val());
            formData.append('subtitle_aplikasi', $("#subtitle_aplikasi").val());
            formData.append('link_fb', $("#link_fb").val());
            formData.append('link_ig', $("#link_ig").val());
            formData.append('link_twitter', $("#link_twitter").val());
            formData.append('link_tiktok', $("#link_tiktok").val());

            /* formData.append('logo_aplikasi', img_logo_aplikasi);
            formData.append('background_home', img_background_home); */

            /* formData.append('judulTentang1', $("#judulTentang1").val());
            formData.append('deskripsiTentang1', $("#deskripsiTentang1").val());
            formData.append('judulTentang2', $("#judulTentang2").val());
            formData.append('deskripsiTentang2', $("#deskripsiTentang2").val());
            formData.append('judulTentang3', $("#judulTentang3").val());
            formData.append('deskripsiTentang3', $("#deskripsiTentang3").val()); */

            $.ajax({
                type: 'POST',
                url: "api/about/updateAboutApps.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#overlay').show();
                },
                success: function(result) {
                    var hasil = JSON.parse(result);
                    if (hasil.hasil !== "success") {} else {
                        $('#overlay').hide();
                        Swal.fire({
                            title: 'Sukses',
                            animation: true,
                            text: "Berhasil update Tentang Aplikasi",
                            type: "success",
                        }).then(function() {
                            //load_data();

                            location.reload()

                        });
                    }
                }
            });
        });
    </script>
</body>

</html>