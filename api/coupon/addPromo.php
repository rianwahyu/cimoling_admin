<?php

include '../../config/connection.php';

$kodePromo      = $_POST['kodePromo'];
$valuePromo     = $_POST['valuePromo'];
$startPeriode   = $_POST['startPeriode'];
$endPeriode     = $_POST['endPeriode'];

$usernames = $_POST['usernames'];

$query = "INSERT INTO `promo_kupon`(`kodePromo`, `typePromo`, `valuePromo`, `startPeriode`, `endPeriode`, `_by`, `dateCreated`) VALUES ('$kodePromo','Sekali Pakai','$valuePromo','$startPeriode','$endPeriode','$usernames', NOW())";

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