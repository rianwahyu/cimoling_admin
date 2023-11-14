<?php 

include '../../config/connection.php';

$about         = $_POST['about'];
$nama_aplikasi = $_POST['nama_aplikasi'];
$nama_singkat  = $_POST['nama_singkat'];
$link_fb  = $_POST['link_fb'];
$link_ig  = $_POST['link_ig'];
$link_twitter  = $_POST['link_twitter'];
$link_tiktok  = $_POST['link_tiktok'];

$subtitle_aplikasi  = $_POST['subtitle_aplikasi'];


$logo_aplikasi         = $_FILES['logo_aplikasi']['tmp_name'];
$ImageName_aplikasi    = $_FILES['logo_aplikasi']['name'];
$ImageType_aplikasi    = $_FILES['logo_aplikasi']['type'];


$background_home         = $_FILES['background_home']['tmp_name'];
$ImageName_background    = $_FILES['background_home']['name'];
$ImageType_background    = $_FILES['background_home']['type'];

$temp = "../../storage/";
if (!file_exists($temp))
    mkdir($temp);

$query = "";

$updateLogoQuery ="";
if (!empty($logo_aplikasi)) {
    $acak           = rand(11111111, 99999999);
    $ImageExt       = substr($ImageName_aplikasi, strrpos($ImageName_aplikasi, '.'));
    $ImageExt       = str_replace('.', '', $ImageExt); // Extension
    $ImageName_aplikasi      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName_aplikasi);
    $NewImageName   = str_replace(' ', '', $acak . '.' . $ImageExt);

    move_uploaded_file($_FILES["logo_aplikasi"]["tmp_name"], $temp . $NewImageName);

    $updateLogoQuery =" logo_aplikasi='$NewImageName', ";
} else {
    $updateLogoQuery = "";
}


$updateBackgroundQuery ="";
if (!empty($background_home)) {
    $acak           = rand(11111111, 99999999);
    $ImageExtBackground       = substr($ImageName_background, strrpos($ImageName_background, '.'));
    $ImageExtBackground       = str_replace('.', '', $ImageExtBackground); // Extension
    $ImageName_background      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName_background);
    $NewImageNameBackground   = str_replace(' ', '', $acak . '.' . $ImageExtBackground);

    move_uploaded_file($_FILES["background_home"]["tmp_name"], $temp . $NewImageNameBackground);

    $updateBackgroundQuery =" , background_home='$NewImageNameBackground' ";
}else{
    $updateBackgroundQuery = "";
}



$query = "UPDATE setting_apps SET about='$about', nama_aplikasi='$nama_aplikasi', nama_singkat='$nama_singkat', $updateLogoQuery  link_fb='$link_fb', link_ig='$link_ig', link_twitter='$link_twitter', link_tiktok='$link_tiktok' $updateBackgroundQuery , subtitle_aplikasi='$subtitle_aplikasi' WHERE id='1'";

//echo $query;

$result = mysqli_query($dbc, $query);

if ($result == true) {
    $data['hasil'] = 'success';
} else {
    $data['hasil'] = 'failed';
}

echo json_encode($data);
