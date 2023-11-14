<?php include 'include/header.php'; ?>

<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'include/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $page = "utility";
        $subPage = "utilityVisiMisi";
        include 'include/sidebar.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Visi dan Misi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Setting</a></li>
                                <li class="breadcrumb-item active">Visi dan Misi</li>
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
                                    <h3 class="card-title">Visi Misi</h3>
                                </div>
                                <div class="overlay-wrapper" style="display: none" id="overlay">
                                    <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                        <div class="text-bold pt-2">Loading...</div>
                                    </div>

                                </div>
                                <form role="form" name="form-add" id="form-add">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Visi</label>
                                            <textarea id="visi" name="visi" class="ml-10 mr-10"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Misi</label>
                                            <textarea id="misi" name="misi" class="ml-10 mr-10"></textarea>
                                        </div>
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
        $('#visi').summernote({
            height: 300,
            focus: true
        })

        $('#misi').summernote({
            height: 300,
            focus: true
        })

        load_data();

        function load_data() {
            $.ajax({
                url: "api/about/getVisiMisi.php",
                type: "GET",
                beforeSend: function() {},
                success: function(result) {
                    var hasil = JSON.parse(result);
                    console.log(hasil.hasil);
                    $("#visi").summernote('code', hasil.visi);
                    $("#misi").summernote('code', hasil.misi);
                }
            });
        }

        $("#form-add").submit(function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('visi', $("#visi").val());
            formData.append('misi', $("#misi").val());
        
            $.ajax({
                type: 'POST',
                url: "api/about/updateVisiMisi.php",
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
                            text: "Berhasil update Visi dan Misi",
                            type: "success",
                            //customClass: 'animated tada'
                        }).then(function() {
                            load_data();
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>