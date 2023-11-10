<?php

include '../../config/connection.php';

$response = array();
$query = "SELECT * FROM notifikasi  ";
$result = mysqli_query($dbc, $query);


if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        //$myArray[]= $data;
        $myArray[] = array(
            "idNotifikasi" => $data['idNotifikasi'],
            "judul" => $data['judul'],
            "deskripsiSingkat" => $data['deskripsiSingkat'],
            "pesan" => $data['pesan'],
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
