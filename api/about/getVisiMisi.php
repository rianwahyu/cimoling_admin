<?php

include '../../config/connection.php';


$query = "SELECT visi, misi FROM setting_apps WHERE id='1' ";

$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_assoc($result);


$msg = array("hasil" => "success", "visi" => $row['visi'], "misi" => $row['misi']);

echo json_encode($msg);
