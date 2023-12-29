<?php

include '../../config/connection.php';

$orderDate = $_POST['orderDate'];
$timeOrder = $_POST['timeOrder'];
$userID = $_POST['userID'];
$idKategori = $_POST['idKategori'];

$curDate = date('Y-m-d h:i:s');
$response = array();

$sql = "SELECT * FROM booking WHERE tanggalOrder='$orderDate' AND waktuOrder='$timeOrder'";
$result = mysqli_query($dbc, $sql);
if (mysqli_num_rows($result) > 0) {

    $response = array(
        "success" => false,
        "message" => "Tanggal atau waktu order tidak tersedia",
        "orderID" => "",
    );
} else {
    
    $response = array(
        "success" => true,
        "message" => "Tersedia",
        "orderID" => "",
    );

    /* $orderID = getOrderID($dbc);

    $query = "";
    $query = $query . " INSERT INTO `booking`(`orderID`, `userID`, `idKategori`, `tanggalOrder`, `waktuOrder`, `statusOrder`) VALUES ('$orderID', '$userID', '$idKategori', '$orderDate', '$timeOrder', '0'); ";

    $query = $query . " INSERT INTO `bookingValue`( `orderID`, `keterangan`, `status`, `tanggalValue`, `userAdmin`) VALUES ('$orderID', 'Pesanan telah dibuat', '0', '$curDate', '' ) ;";

    if (mysqli_multi_query($dbc, $query)) {
        $response = array(
            "success" => true,
            "message" => "Tersedia",
            "orderID" => $orderID,
        );
    } else {
        $response = array(
            "success" => false,
            "message" => "Gagal",
            "orderID" => "",
        );
    } */
}

die(json_encode($response));



function getOrderID($dbc)
{
    $kode = "CML";
    $orderID = "";
    $sql = "SELECT orderID  FROM booking ORDER BY orderID DESC LIMIT 1 ";
    $res  = mysqli_query($dbc, $sql);
    $data = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) < 1) {
        $orderID = $kode . "0000001";
    } else {
        $id = $data["orderID"];
        $id = substr($id, 3);
        $orderID = $kode . str_pad($id + 1, 7, 0, STR_PAD_LEFT);
    }

    return $orderID;
}
