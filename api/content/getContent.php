<?php

include '../../config/connection.php';

$response = array();
$query = "SELECT * FROM content";
$result = mysqli_query($dbc, $query);

$urlImageContent = "https://demoapps.rigadevofc.com/cimoling/storage/";
if (mysqli_num_rows($result) >= 1) {
    while ($data = mysqli_fetch_assoc($result)) {
        //$myArray[]= $data;
        $myArray[] = array(
            "contentID" => $data['contentID'],
            "contentTitle" => $data['contentTitle'],
            "contentValue" => $data['contentValue'],
            "contentImage" => $urlImageContent . $data['contentImage'],
            "dateCreate" => $data['dateCreate'],
        );
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
