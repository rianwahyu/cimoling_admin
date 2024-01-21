<?php

include '../../config/connection.php';

$nama = $_POST['nama'];
$nomor = $_POST['nomor'];

$query = "INSERT INTO `admin_whatsapp`(`nama`, `nomor`) VALUES ('$nama', '$nomor')";
$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) > 0) {
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

die(json_encode($response));
