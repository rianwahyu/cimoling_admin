<?php

include '../../config/connection.php';

$response = array();
$query = "SELECT * FROM promo_kupon";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        $myArray[] = $data;
    }
    
    $response = array(
        "success" => true,
        "message" => "Data ditemukan",
        "data" => $myArray,
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Data tidak ditemukan",
    );
}

die(json_encode($response));
