<?php

include '../../config/connection.php';

$idLayanan = $_POST['idLayanan'];

$response = array();
$query = "SELECT `idJenis`, `idLayanan`, `namaJenis`, `status`, `modified_date`, `_by` FROM `subKategoriLayanan` WHERE idLayanan='$idLayanan' ";
$result = mysqli_query($dbc, $query);

$urlImageContent = "https://demoapps.rigadevofc.com/storage/";
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
