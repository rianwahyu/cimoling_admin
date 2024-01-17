<?php

include '../../config/connection.php';

$idPromo      = $_POST['idPromo'];
$kodePromo      = $_POST['kodePromo'];
$valuePromo     = $_POST['valuePromo'];
$startPeriode   = $_POST['startPeriode'];
$endPeriode     = $_POST['endPeriode'];

$usernames = $_POST['usernames'];

$query = "UPDATE `promo_kupon` SET `kodePromo`='$kodePromo', `valuePromo`='$valuePromo',`startPeriode`='$startPeriode',`endPeriode`='$endPeriode',`_by`='$usernames',`dateCreated`=NOW() WHERE idPromo='$idPromo' ";


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

die(json_encode($response));
