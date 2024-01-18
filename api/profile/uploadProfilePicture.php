<?php

include '../../config/connection.php';

$userID = $_POST['userID'];

$temp = "../../storage/profile/";

if ($_FILES['uploadPhoto']['name'] != '') {
    $allowed_ext = array(
        "jpg",
        "png",
        "jpeg",
        "JPG"
    );

    $ext = end(explode('.', $_FILES['uploadPhoto']['name']));
    if (in_array($ext, $allowed_ext)) {
        if ($_FILES["uploadPhoto"]["size"] < 2000000) {
            $name = time() . '.' . $ext;
            $path = $temp . $name;
            if (move_uploaded_file($_FILES["uploadPhoto"]["tmp_name"], $path)) {

                $query = "UPDATE `member` SET `fotoUrl`='$name' WHERE idMember='$userID' ";

                //echo $query;
                $result = mysqli_query($dbc, $query);
                if (mysqli_affected_rows($dbc) >= 1) {
                    $response = array(
                        "success" => true,
                        "message" => "Berhasil mengubah data",
                    );
                } else {
                    $response = array(
                        "success" => false,
                        "message" => "Gagal mengubah data",
                    );
                }
            } else {
                $response = array(
                    "success" => false,
                    "message" => "File Gagal di upload",
                );
            }
        } else {
            $response = array(
                "success" => false,
                "message" => "Ukuran Maksimum 2MB",
            );
        }
    } else {
        $response = array(
            "success" => false,
            "message" => "Format tidak sesuai",
        );
    }
} else {
    $response = array(
        "success" => false,
        "message" => "Mohon melampirkan file",
    );
}

die(json_encode($response));
