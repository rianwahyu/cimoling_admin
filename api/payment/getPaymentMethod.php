<?php

include '../../config/connection.php';

$sql = "SELECT * FROM `pembayaran` WHERE status='1' ";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        //$myArray[]= $data;
        $myArray[] = $data;
    }

    $response = array(
        "success" => true,
        "message" => "Data ditemukan",
        "data" => $myArray,
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Data tidak ditemukan",
    );
}

die(json_encode($response));
