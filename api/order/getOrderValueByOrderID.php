<?php

include '../../config/connection.php';

$orderID = $_POST['orderID'];

$query = "SELECT *, DATE_FORMAT(tanggalValue, '%Y-%m-%d') as convTanggal, DATE_FORMAT(tanggalValue, '%T') as convTime FROM `bookingValue` WHERE `orderID`='$orderID' ORDER BY tanggalValue ASC ";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        $myArray[] = array(
            "id" => $data['id'],
            "orderID" => $data['orderID'],
            "keterangan" => $data['keterangan'],
            "status" => $data['status'],
            "tanggal" => $data['convTanggal'],
            "waktu" => $data['convTime'],
        );
    }

    $response = array(
        "success" => true,
        "message" => "Data ditemukan",
        "data" => $myArray,
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Data tidak tersedia",
    );
}

die(json_encode($response));
