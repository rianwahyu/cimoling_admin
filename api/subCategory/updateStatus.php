<?php

include '../../config/connection.php';

//$username = $_POST['username'];
$idJenis = $_POST['idJenis'];
$status = $_POST['status'];

$query = "UPDATE subKategoriLayanan SET status='$status' WHERE idJenis='$idJenis' ";
$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) >= 1) {
    $response = array(
        "success" => true,
        "message" => "Data berhasil dirubah",
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Tidak ada perubahan data",
    );
}

die(json_encode($response));
