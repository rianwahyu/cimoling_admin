<?php

include '../../config/connection.php';

$userID  = $_POST['userID'];
$namaLengkap  = $_POST['namaLengkap'];
$noHp  = $_POST['noHp'];
$alamat  = $_POST['alamat'];

$noHp0 = substr($noHp, 0, 1);
$noHp62 = substr($noHp, 0, 2);
$noHp6262 = substr($noHp, 0, 4);
$noHp620 = substr($noHp, 0, 3);


$cekDigit = array(
    "0",
    "62",
    "6262",
    "620",
);

$val = array(
    $noHp0,
    $noHp62,
    $noHp6262,
    $noHp620
);

//print_r($val);

foreach ($val as $v) {
    if (in_array($v, $cekDigit)) {
        if ($v == "0") {
            $finalNoHp = "62" . substr($noHp, 1);
        } elseif ($v == "62") {
            $finalNoHp = "62" . substr($noHp, 2);
        } elseif ($v == "6262") {
            $finalNoHp = "62" . substr($noHp, 4);
        } elseif ($v == "620") {
            $finalNoHp = "62" . substr($noHp, 3);
        }
        break;
    } else {
        $finalNoHp = "62" . $noHp;
    }
}

$query = " UPDATE `member` SET `namaLengkap`='$namaLengkap', `alamat`='$alamat',`noHp`='$finalNoHp' WHERE idMember='$userID' ";

$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) >= 1) {
    $response = array(
        "success" => true,
        "message" => "Berhasil mengubah data",
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Gagal mengubah data",
    );
}

die(json_encode($response));
