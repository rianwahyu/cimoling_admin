<?php

include '../../config/connection.php';

$idMember = $_POST['idMember'];
$namaLengkap = $_POST['namaLengkap'];
$noHp = $_POST['noHp'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$token = $_POST['token'];

$query = "INSERT INTO `member`(`idMember`, `namaLengkap`, `noHp`, `email`, `password`, `token`, `tanggalRegistrasi`) VALUES ('$idMember','$namaLengkap','$noHp','$email','$password','$token',NOW()) ON DUPLICATE KEY UPDATE namaLengkap=values(namaLengkap) ";
$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) >= 1) {
    $response = array(
        "success" => true,
        "message" => "Berhasil menambahkan user",
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Gagal menambahkan user",
    );
}

die (json_encode($response));