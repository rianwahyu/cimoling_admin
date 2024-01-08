<?php

include '../../config/connection.php';

$myArray = array();

$name = $_POST['name'];
$information = '';
if ($name == "about") {
    $information = 'about';
} elseif ($name == "visi") {
    $information = 'CONCAT(visi, " ", misi) ';
} elseif ($name == "howToUse") {
    $information = 'cara_penggunaan';
}
$sql = "SELECT $information as description FROM setting_apps WHERE 1 ";

//echo $query;

$result = mysqli_query($dbc, $sql);
$rows = mysqli_fetch_assoc($result);

$arrays = array("description" => $rows['description']);
echo json_encode($arrays);

mysqli_close($dbc);
