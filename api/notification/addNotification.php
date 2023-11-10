<?php

include '../../config/connection.php';

$judul = $_POST['judul'];
$deskripsiSingkat = $_POST['deskripsiSingkat'];
$pesan = $_POST['pesan'];

$query = "INSERT INTO `notifikasi`(`judul`, `deskripsiSingkat`, `pesan`, `status`, `tanggalNotifikasi`) VALUES ('$judul','$deskripsiSingkat','$pesan','1',NOW())";
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

echo json_encode($response);