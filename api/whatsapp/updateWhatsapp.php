<?php

include '../../config/connection.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nomor = $_POST['nomor'];

$query = "UPDATE `admin_whatsapp` SET `nama`='$nama',`nomor`='$nomor' WHERE id='$id' ";
$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) > 0) {
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

die(json_encode($response));
