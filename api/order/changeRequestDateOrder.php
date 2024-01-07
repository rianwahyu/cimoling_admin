<?php

include '../../config/connection.php';

$orderID = $_POST['orderID'];
$userAdmin = $_POST['username'];

$dateOrderBefore = $_POST['dateOrderBefore'];
$timeOrderBefore = $_POST['timeOrderBefore'];

$dateOrderChange = $_POST['dateOrderChange'];
$timeOrderChange = $_POST['timeOrderChange'];

$reasonChangeDate = $_POST['reasonChangeDate'];

$query = "";
$query = $query . "UPDATE booking SET tanggalOrder='$dateOrderChange', waktuOrder='$timeOrderChange'  WHERE orderID='$orderID'; ";
$query = $query . "INSERT INTO `bookingValue`(`orderID`, `keterangan`, `status`, `tanggalValue`, `userAdmin`) VALUES ('$orderID', 'Admin mengubah Jadwal Layanan dari tanggal $dateOrderBefore waktu $timeOrderBefore, dirubah ke tanggal $dateOrderChange waktu $timeOrderChange dikarenakan $reasonChangeDate' , '1', NOW(), '$userAdmin'); ";

//echo $query;

if (mysqli_multi_query($dbc, $query)) {
    do {
        $cumulative_rows += mysqli_affected_rows($dbc);
    } while (mysqli_more_results($dbc) && mysqli_next_result($dbc));
}
if ($error_mess = mysqli_error($dbc)) {
    echo "Error: $error_mess";
}


if ($cumulative_rows > 0) {
    $message = "Sukses mengubah jadwal order";
    $response = array(
        "success" => true,
        "message" => $message
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Proses Update Gagal"
    );
}

die(json_encode($response));
