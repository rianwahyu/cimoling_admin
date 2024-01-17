<?php

include '../../config/connection.php';

$idPromo      = $_POST['idPromo'];

$query = "DELETE FROM `promo_kupon` WHERE idPromo='$idPromo'";
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