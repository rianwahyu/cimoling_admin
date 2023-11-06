<?php

include '../../config/connection.php';

$contentID = $_POST['contentID'];
$contentTitle = $_POST['contentTitle'];
$contentValue = $_POST['contentValue'];

$response = array();
$imageValueTable = '';

$temp = "../../storage/";

if ($_FILES['fileUpload']['name'] != '') {
    $allowed_ext = array(
        "jpg",
        "png",
        "jpeg",
        "JPG"
    );

    $ext = end(explode('.', $_FILES['fileUpload']['name']));
    if (in_array($ext, $allowed_ext)) {
        if ($_FILES["fileUpload"]["size"] < 2000000) {
            $name = time() . '.' . $ext;
            $path = $temp . $name;

            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $path)) {
                $imageValueTable = ", contentImage='$name'";
            } else {
                $imageValueTable = "";
                $response = array(
                    "success" => false,
                    "message" => "Gagal di upload !",
                );
            }
        } else {
            $imageValueTable = "";
            $response = array(
                "success" => false,
                "message" => "Maksimal ukuran file 2MB !",
            );
        }
    } else {
        $imageValueTable = "";
        $response = array(
            "success" => false,
            "message" => "Format file tidak sesuai",
        );
    }
} else {
    $imageValueTable = "";
}

$query = "UPDATE ara_content SET contentTitle ='$contentTitle',`contentValue`='$contentValue' $imageValueTable WHERE contentID='$contentID' ";

$result = mysqli_query($dbc, $query);
if (mysqli_affected_rows($dbc) >= 1) {
    $response = array(
        "success" => true,
        "message" => "Data berhasil dirubah",
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Tidak ada perubahan data",
    );
}

die(json_encode($response));