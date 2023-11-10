<?php

include '../../config/connection.php';

$idNotifikasi = $_POST['idNotifikasi'];

$query = "DELETE FROM `notifikasi` WHERE idNotifikasi='$idNotifikasi'";
$result = mysqli_query($dbc, $query);
if(mysqli_affected_rows($dbc)>0){
    $response = array(
        "success"=>true,
        "message"=>"Data berhasil dihapus",
    );
}else{
    $response = array(
        "success"=>false,
        "message"=>"Gagal dihapus",
    );
}

die(json_encode($response));