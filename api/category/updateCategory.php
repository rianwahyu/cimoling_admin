<?php

include '../../config/connection.php';

session_start();
$username = $_SESSION['username'];

$idKategori = $_POST['idKategori'];
$namaKategori = $_POST['namaKategori'];
$deskripsiKategori = $_POST['deskripsiKategori'];
$status = $_POST['status'];

$response = array();
$imageValueTable = '';

$temp = "../../storage/";

if ($_FILES['fileUpload']['name'] != '') {
    //echo "ada";
    $allowed_ext = array(
        "jpg",
        "png",
        "jpeg",
        "JPG",
        "avif",
    );

    $ext = end(explode('.', $_FILES['fileUpload']['name']));
    if (in_array($ext, $allowed_ext)) {
        if ($_FILES["fileUpload"]["size"] < 5000000) {
            $name = time() . '.' . $ext;
            $path = $temp . $name;

            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $path)) {
                $imageValueTable = ", foto='$name'";
            } else {
                $imageValueTable = "";
                $response = array(
                    "success" => false,
                    "message" => "Gagal di upload !",
                );
                die(json_encode($response));
            }
        } else {
            $imageValueTable = "";
            $response = array(
                "success" => false,
                "message" => "Maksimal ukuran file 2MB !",
            );
            die(json_encode($response));
        }
    } else {
        $imageValueTable = "";
        $response = array(
            "success" => false,
            "message" => "Format file tidak sesuai",
        );
        die(json_encode($response));
    }
} else {
    //echo "tdk ada";
    $imageValueTable = "";
}

//echo $imageValueTable;

$query = "UPDATE `kategoriLayanan` SET `namaKategori`='$namaKategori',`deskripsiKategori`='$deskripsiKategori', `modified_date`=NOW(),`_by`='$username' $imageValueTable WHERE idKategori='$idKategori'";

//echo $query;

$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) >= 1) {
    $response = array(
        "success" => true,
        "message" => "Data berhasil dirubah",
    );
    die(json_encode($response));
} else {
    $response = array(
        "success" => false,
        "message" => "Tidak ada perubahan data",
    );
    die(json_encode($response));
}

