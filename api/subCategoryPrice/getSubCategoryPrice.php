<?php

include '../../config/connection.php';

$idSubKategori = $_POST['idSubKategori'];

$response = array();
$query = "SELECT `idHarga`, `idSubKategori`, `keterangan`, `harga`, `status`, `modified_date`, `_by` FROM `subKategoriLayananHarga` WHERE idSubKategori='$idSubKategori' ";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        //$myArray[]= $data;
        $myArray[] = array(
            "idJenis" => $data['idJenis'],
            "idLayanan" => $data['idLayanan'],
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
