<?php

include '../../config/connection.php';

class data
{
}

$status = $_GET['status'];

$query = "";
if ($status != '5') {
    $query = " SELECT a.orderID, a.userID, m.namaLengkap, c.namaKategori as tipeKendaraan , a.alamatOrder, a.latitude, a.longitude, a.tanggalOrder, a.waktuOrder, a.statusOrder, e.harga, e.keterangan as ketHarga, d.namaJenis, a.dateCreated
    FROM booking a 
    INNER JOIN member b ON a.userID = b.idMember
    INNER JOIN kategoriLayanan c ON a.idKategori = c.idKategori
    INNER JOIN subKategoriLayanan d ON a.idJenis = d.idJenis
    INNER JOIN subKategoriLayananHarga e ON a.idHarga = e.idHarga 
    INNER JOIN member m ON a.userID = m.idMember
    WHERE a.statusOrder ='$status' ";
} elseif ($status == '5') {
    $query = " SELECT a.orderID, a.userID, m.namaLengkap, c.namaKategori as tipeKendaraan , a.alamatOrder, a.latitude, a.longitude, a.tanggalOrder, a.waktuOrder, a.statusOrder, e.harga, e.keterangan as ketHarga, d.namaJenis, a.dateCreated, bv.keterangan as alasanCancel, bv.tanggalValue as tglCancel
    FROM booking a 
    INNER JOIN member b ON a.userID = b.idMember
    INNER JOIN kategoriLayanan c ON a.idKategori = c.idKategori
    INNER JOIN subKategoriLayanan d ON a.idJenis = d.idJenis
    INNER JOIN subKategoriLayananHarga e ON a.idHarga = e.idHarga 
    INNER JOIN member m ON a.userID = m.idMember
    INNER JOIN bookingValue bv ON a.orderID = bv.orderID AND bv.status='5'
    WHERE a.statusOrder ='5' ";
}



//echo $query;

$result = mysqli_query($dbc, $query);
if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        $myArray[] = $data;
    }

    $response = new data();
    $response->success = TRUE;
    $response->message = "Berhasil Mendapatkan Data";
    $response->data = $myArray;
    die(json_encode($response));
} else {
    $response = new data();
    $response->success = FALSE;
    $response->message = "Tidak ada Data";
    $response->message = $query;
    die(json_encode($response));
}

mysqli_close($dbc);
