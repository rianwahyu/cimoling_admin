<?php

include '../../config/connection.php';


session_start();
$username = $_SESSION['username'];

$namaKategori = $_POST['namaKategori'];
$deskripsiKategori = $_POST['deskripsiKategori'];

$response = array();

$temp = "../../storage/";

if ($_FILES['fileUpload']['name'] != '') {
    $allowed_ext = array(
        "jpg",
        "png",
        "jpeg",
        "JPG"
    );

    $ext = end(explode('.', $_FILES['fileUpload']['name']));
    if (in_array($ext, $allowed_ext)) {
        if ($_FILES["fileUpload"]["size"] < 2000000) {
            $name = time() . '.' . $ext;
            $path = $temp . $name;
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $path)) {

                $query = "INSERT INTO `kategoriLayanan`(`namaKategori`, `deskripsiKategori`, `foto`, `status`, `modified_date`, `_by`) VALUES ('$namaKategori','$deskripsiKategori','$name','active',NOW(),'$usernames') ";

                //echo $query;
                $result = mysqli_query($dbc, $query);
                if (mysqli_affected_rows($dbc) >= 1) {
                    $response = array(
                        "success" => true,
                        "message" => "Berhasil menambahkan data",
                    );
                } else {
                    $response = array(
                        "success" => false,
                        "message" => "Gagal menambahkan data",
                    );
                }
            } else {
                $response = array(
                    "success" => false,
                    "message" => "File Gagal di upload",
                );
            }
        } else {
            $response = array(
                "success" => false,
                "message" => "Ukuran Maksimum 2MB",
            );
        }
    } else {
        $response = array(
            "success" => false,
            "message" => "Format tidak sesuai",
        );
    }
} else {
    $response = array(
        "success" => false,
        "message" => "Mohon melampirkan file",
    );
}


die(json_encode($response));