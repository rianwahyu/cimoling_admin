<?php

include '../../config/connection.php';

$idLayanan = $_POST['idLayanan'];
$namaJenis = $_POST['namaJenis'];
$username = $_POST['username'];

$response = array();

$query = "INSERT INTO `subKategoriLayanan`(`idLayanan`, `namaJenis`, `status`, `modified_date`, `_by`) VALUES ('$idLayanan','$namaJenis','active',NOW(),'$username')";

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
