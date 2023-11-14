<?php

include '../../config/connection.php';


$query = "SELECT * FROM setting_apps WHERE id='1' ";

$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_assoc($result);

$msg = array(
    "success" => true,
    "about" => $row['about'],
    "nama_aplikasi" => $row['nama_aplikasi'],
    "nama_singkat" => $row['nama_singkat'],
    "logo_aplikasi" => $row['logo_aplikasi'],
    "link_fb" => $row['link_fb'],
    "link_ig" => $row['link_ig'],
    "link_twitter" => $row['link_twitter'],
    "link_tiktok" => $row['link_tiktok'],
    "subtitle_aplikasi" => $row['subtitle_aplikasi'],
);

echo json_encode($msg);
