<?php

include '../../config/connection.php';

$response = array();
$query = "SELECT * FROM kategoriLayanan";
$result = mysqli_query($dbc, $query);

$urlImageContent = "https://demoapps.rigadevofc.com/storage/";
if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        //$myArray[]= $data;
        $myArray[] = array(
            "idKategori" => $data['idKategori'],
            "namaKategori" => $data['namaKategori'],
            "deskripsiKategori" => $data['deskripsiKategori'],
            "foto" => $urlImageContent . $data['foto'],
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
