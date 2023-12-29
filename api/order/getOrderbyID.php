<?php

include '../../config/connection.php';

class data{}

$userID = $_POST['userID'];

$query = " SELECT a.orderID, a.userID, a.tipeKendaraan , a.alamatOrder, a.latitude, a.longitude, a.tanggalOrder, a.waktuOrder, a.statusOrder, e.harga, e.keterangan as ketHarga, a.dateCreated
FROM booking a 
INNER JOIN member b ON a.userID = b.idMember
INNER JOIN kategoriLayanan c ON a.idKategori = c.idKategori
INNER JOIN subKategoriLayanan d ON a.idJenis = d.idJenis
INNER JOIN subKategoriLayananHarga e ON a.idHarga = e.idHarga 
WHERE a.userID = '$userID' /*AND ( a.statusOrder !='6' OR a.statusOrder !='7' )*/ ";

//echo $query;

$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) >= 1) {
    while($data = mysqli_fetch_assoc($result)){
        $myArray[]=$data;
    }

    $response = new data();
    $response->success = TRUE;
    $response->message = "Berhasil Mendapatkan Data";
    $response->data = $myArray;
    die(json_encode($response));
}else{
    $response = new data();
    $response->success = FALSE;
    $response->message = "Tidak ada Data";
    die(json_encode($response));
}

mysqli_close($dbc);