<?php

include '../../config/connection.php';

$response = array();
$query = "SELECT link_kebijakan_privasi FROM setting_apps WHERE id='1' ";
$result = mysqli_query($dbc, $query);

//$urlImageContent = "https://demoapps.rigadevofc.com/cimoling/storage/";
if (mysqli_num_rows($result) >= 1) {

    $data = mysqli_fetch_assoc($result);
    $response = array(
        "success" => true,
        "message" => "Data ditemukan",
        "link_kebijakan_privasi" => $data['link_kebijakan_privasi'],        
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Data tidak ditemukan",
    );
}

die(json_encode($response));
