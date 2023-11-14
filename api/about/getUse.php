<?php

include '../../config/connection.php';


$query = "SELECT cara_penggunaan FROM setting_apps WHERE id='1' ";

$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_assoc($result);


$msg = array("hasil" => "success", "cara_penggunaan" => $row['cara_penggunaan']);

echo json_encode($msg);
