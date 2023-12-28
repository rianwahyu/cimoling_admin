<?php

include '../../config/connection.php';

$orderDate = $_POST['orderDate'];
$idKategori = $_POST['idKategori'];
class data
{
}

$curTime = date('H:i:s');

$query = "SELECT otm.timeReal, otm.timeDisplay
FROM order_time_master AS otm
WHERE NOT EXISTS (
  SELECT b.waktuOrder
  FROM booking AS b 
  WHERE otm.timeReal=b.waktuOrder AND b.tanggalOrder='$orderDate')  ";
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
    die(json_encode($response));
}

mysqli_close($dbc);
