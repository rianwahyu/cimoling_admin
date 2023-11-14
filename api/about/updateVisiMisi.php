<?php

include '../../config/connection.php';

$visi = $_POST['visi'];
$misi = $_POST['misi'];

$query = "UPDATE setting_apps SET visi='$visi', misi='$misi' WHERE id='1'";


$result = mysqli_query($dbc, $query);

if ($result == true) {
    $data['hasil'] = 'success';
} else {
    $data['hasil'] = 'failed';
}

echo json_encode($data);
