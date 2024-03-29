<?php

include '../../config/connection.php';

/* $kode = "CML";
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
} */

//echo $orderID;

$userID = $_POST['userID'];
$idPembayaran = $_POST['idPembayaran'];
$idKategori = $_POST['idKategori'];
$idJenis = $_POST['idJenis'];
$idHarga = $_POST['idHarga'];
$alamatOrder = $_POST['alamatOrder'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$tglOrder = $_POST['tanggalOrder'];
$waktuOrder = $_POST['waktuOrder'];

//$tanggalOrder = date("Y-m-d", strtotime($tglOrder));

$orderID = getOrderID($dbc);
$curDate = date('Y-m-d h:i:s');
$curYear = date('y');
$curMonth = date('m');

$query = "";
$query = $query . " INSERT INTO `booking`(`orderID`, `userID`, `idPembayaran`, `idKategori`, `idJenis`, `idHarga`, `alamatOrder`, `latitude`, `longitude`, `tanggalOrder`, `waktuOrder`, `statusOrder`, year, month) 
VALUES ('$orderID', '$userID', '$idPembayaran', '$idKategori', '$idJenis', '$idHarga', '$alamatOrder', '$latitude', '$longitude', '$tglOrder', '$waktuOrder', '0', '$curYear', '$curMonth') ;";

$query = $query . " INSERT INTO `bookingValue`( `orderID`, `keterangan`, `status`, `tanggalValue`, `userAdmin`) VALUES ('$orderID', 'Pesanan telah dibuat', '0', '$curDate', '' ) ;";

$response = array();
if (mysqli_multi_query($dbc, $query)) {
    $response = array(
        "success" => true,
        "message" => "ORDER ID Anda $orderID"
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Gagal Order"
    );
}

die(json_encode($response));


function getOrderID($dbc)
{
    $curYear = date('y');
    $curMonth = date('m');
    $kode = "CML";
    $orderID = "";
    $sql = "SELECT orderID  FROM booking WHERE year='$curYear' AND month='$curMonth' ORDER BY orderID DESC LIMIT 1 ";
    $res  = mysqli_query($dbc, $sql);
    $data = mysqli_fetch_assoc($res);
    if (mysqli_num_rows($res) < 1) {
        $orderID = $kode . $curYear . $curMonth . "001";
    } else {
        $id = $data["orderID"];
        $id = substr($id, 7);
        $orderID = $kode . $curYear . $curMonth . str_pad($id + 1, 3, 0, STR_PAD_LEFT);
    }

    return $orderID;
}

function sendNotif()
{
    include '../../connection.php';
    require_once __DIR__ . '/../../notification.php';
    $notification = new Notification();
    $title = "Order Baru";
    $message = "Adna mendapatkan order baru, silahkan cek notifikasi dan aplikasi Cimoling";
    $imageUrl = isset($_POST['image_url']) ? $_POST['image_url'] : '';
    $action = "activity";
    $send_to = "topic";

    $actionDestination = "HomeAdmin";
    $notification->setTitle($title);
    $notification->setMessage($message);
    $notification->setImage($imageUrl);
    $notification->setAction($action);
    $notification->setActionDestination($actionDestination);

    $firebase_token = "";
    $firebase_api = "AAAAQn1qnC0:APA91bH6yz5xCKah26YNoOhqlgxM5Oy9gYYLH1jbcRz1OovCMg7UJLYLdHEfmNXWqs1dQ6NlAMx3n7Q-El27zN1tvgpgz4BiMEhqONrDjME9PVQHxgdzUE5lw1z4BsiNiuz_Mk9Ag8tZ";

    $topic = "adminCimoling";

    $requestData = $notification->getNotification();

    if ($send_to == 'topic') {
        $fields = array(
            'to' => '/topics/' . $topic,
            'data' => $requestData,
        );
    } else {
        $fields = array(
            'to' => $firebase_token,
            'data' => $requestData,
        );
    }
    $url = 'https://fcm.googleapis.com/fcm/send';

    $headers = array(
        'Authorization: key=' . $firebase_api,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
}

mysqli_close($dbc);
