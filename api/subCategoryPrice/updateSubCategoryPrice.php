<?php

include '../../config/connection.php';

session_start();
$username = $_SESSION['username'];

$idHarga = $_POST['idHarga'];
$idSubKategori = $_POST['idSubKategori'];
$keterangan = $_POST['keterangan'];
$harga = $_POST['harga'];

$response = array();

$query = "UPDATE `subKategoriLayananHarga` SET `keterangan`='$keterangan',`harga`='$harga', `modified_date`=NOW(),`_by`='$username' WHERE idHarga='$idHarga' ";

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


die(json_encode($response));
