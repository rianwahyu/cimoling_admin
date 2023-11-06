<?php

include '../../config/connection.php';

$idJenis = $_POST['idJenis'];
$idLayanan = $_POST['idLayanan'];
$namaJenis = $_POST['namaJenis'];
$status = $_POST['status'];
$username = $_POST['username'];

$response = array();

$query = "UPDATE `subKategoriLayanan` SET `idLayanan`='$idLayanan',`namaJenis`='$namaJenis',`status`='$status',`modified_date`=NOW(),`_by`='$username' WHERE idJenis='$idJenis' ";

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
