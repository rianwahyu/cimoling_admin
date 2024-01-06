<?php

include '../../config/connection.php';

$userID = $_POST['userID'];

$response = array();
$query = "SELECT n.idNotifikasi, n.judul, n.deskripsiSingkat, n.pesan, n.status, n.tanggalNotifikasi, COALESCE(nr.readNotification,0) as readNotification, COALESCE(nr.readAt, '0000-00-00') as readAt
FROM notifikasi n
LEFT JOIN notifikasi_read nr ON n.idNotifikasi=nr.idNotifikasi AND nr.idMember=''
WHERE 1 /*n.tanggalNotifikasi>now() - interval 3 month*/ ";
$result = mysqli_query($dbc, $query);


if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        $myArray[]= $data;
        // $myArray[] = array(
        //     "idNotifikasi" => $data['idNotifikasi'],
        //     "judul" => $data['judul'],
        //     "deskripsiSingkat" => $data['deskripsiSingkat'],
        //     "pesan" => $data['pesan'],
        // );
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
