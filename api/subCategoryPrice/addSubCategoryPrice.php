<?php

include '../../config/connection.php';

session_start();
$username = $_SESSION['username'];

$idSubKategori = $_POST['idSubKategori'];
$keterangan = $_POST['keterangan'];
$harga = $_POST['harga'];


$response = array();


$query = "INSERT INTO `subKategoriLayananHarga`(`idSubKategori`, `keterangan`, `harga`, `status`, `modified_date`, `_by`) VALUES ('$idSubKategori','$keterangan','$harga','active',NOW(),'$username')";

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
