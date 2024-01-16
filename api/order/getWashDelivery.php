<?php

include '../../config/connection.php';

$orderID = $_POST['orderID'];

$query = "SELECT dcp.orderID, k.namaKaryawan, k.jabatan
FROM delivery_cuci_person dcp
INNER JOIN karyawan k ON dcp.idKaryawan=k.idKaryawan
WHERE dcp.orderID='$orderID'";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        $myArray[] = $data;
    }

    $response = array(
        "success" => true,
        "message" => "Berhasil mendapatkan data",
        "data" => $myArray
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Data tidak ditemukan",
        "data" => []
    );
}

die(json_encode($response));
