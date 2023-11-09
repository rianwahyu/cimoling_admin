<?php

include '../../config/connection.php';


$response = array();
$query = "SELECT sk.idJenis, sk.idLayanan, k.namaKategori, sk.namaJenis, sk.status, sk.modified_date, sk._by 
FROM `subKategoriLayanan` sk
INNER JOIN kategoriLayanan k ON sk.idLayanan = k.idKategori ";
$result = mysqli_query($dbc, $query);

//echo $query;

$urlImageContent = "https://demoapps.rigadevofc.com/storage/";
if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        //$myArray[]= $data;
        $myArray[] = array(
            "idJenis" => $data['idJenis'],
            "idLayanan" => $data['idLayanan'],
            "namaKategori" => $data['namaKategori'],
            "namaJenis" => $data['namaJenis'],
            "status" => $data['status'],
            "modified_date" => $data['modified_date'],
            "_by" => $data['_by'],
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
