<?php

include '../../config/connection.php';

$userID = $_POST['userID'];

$query = "SELECT `idMember`, `namaLengkap`, `fotoUrl`, `alamat`, `noHp`, `email` FROM `member` WHERE idMember ='$userID' ";
$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) > 0) {
    $rows = mysqli_fetch_assoc($result);

    $urlLinkPhoto = "https://demoapps.rigadevofc.com/cimoling/storage/profile/";

    $finalUrlPhoto = "";
    if (empty($rows['fotoUrl'])) {
        $finalUrlPhoto = $urlLinkPhoto . "default.png";
    } else {
        $finalUrlPhoto = $urlLinkPhoto . $rows['fotoUrl'];
    }

    $response = array(
        "success" => true,
        "namaLengkap" => $rows['namaLengkap'],
        "fotoUrl" => $finalUrlPhoto,
        "alamat" => $rows['alamat'],
        "noHp" => $rows['noHp'],
    );
} else {
    $response = array(
        "success" => false,
    );
}

die(json_encode($response));
