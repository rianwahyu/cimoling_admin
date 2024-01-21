<?php

include '../../config/connection.php';

$id      = $_POST['id'];

$query = "DELETE FROM `admin_whatsapp` WHERE id='$id'";
$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) > 0) {
    $response = array(
        "success" => true,
        "message" => "Data berhasil dihapus",
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Gagal dihapus",
    );
}

die(json_encode($response));
