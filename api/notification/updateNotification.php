<?php

include '../../config/connection.php';

$idNotifikasi = $_POST['idNotifikasi'];
$judul = $_POST['judul'];
$deskripsiSingkat = $_POST['deskripsiSingkat'];
$pesan = $_POST['pesan'];

$query = "UPDATE `notifikasi` SET `judul`='$judul',`deskripsiSingkat`='$deskripsiSingkat',`pesan`='$pesan',`tanggalNotifikasi`=NOW() WHERE idNotifikasi='$idNotifikasi' ";
$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) >= 1) {
    $response = array(
        "success" => true,
        "message" => "Berhasil mengubah data",
    ); 
} else {
    $response = array(
        "success" => false,
        "message" => "Gagal mengubah data",
    );
}


echo json_encode($response);