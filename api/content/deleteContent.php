<?php

include '../../config/connection.php';

$contentID = $_POST['contentID'];

$query = "DELETE FROM `ara_content` WHERE contentID='$contentID'";
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