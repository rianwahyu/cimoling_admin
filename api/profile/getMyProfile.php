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

    //$convert1 = "62" . substr($rows['noHp'], 1);
    $convert1 = substr($rows['noHp'], 1);
    // $convert2 = "62" . substr($rows['noHp'], 2);
    // $convert3 = "62" . substr($rows['noHp'], 3);
    $convert4 = "0" . substr($rows['noHp'], 2);

    //echo $convert1."\n".$convert2."\n".$convert3."\n".$convert4;

    $response = array(
        "success" => true,
        "namaLengkap" => $rows['namaLengkap'],
        "fotoUrl" => $finalUrlPhoto,
        "alamat" => $rows['alamat'],
        "noHp" => $convert1,
    );
} else {
    $response = array(
        "success" => false,
    );
}

die(json_encode($response));
