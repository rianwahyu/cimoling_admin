<?php

include '../../config/connection.php';

$cara_penggunaan = $_POST['cara_penggunaan'];

$query = "UPDATE setting_apps SET cara_penggunaan='$cara_penggunaan' WHERE id='1'";


$result = mysqli_query($dbc, $query);

if ($result == true) {
    $data['hasil'] = 'success';
} else {
    $data['hasil'] = 'failed';
}

echo json_encode($data);
