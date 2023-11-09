<?php

include '../../config/connection.php';

$response = array();
$query = "SELECT * FROM kategoriLayanan";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        $myArray[] = array(
            "idKategori" => $data['idKategori'],
            "namaKategori" => $data['namaKategori'],
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
        "message" => "Data tidak ditemukan",
    );
}

die(json_encode($response));
