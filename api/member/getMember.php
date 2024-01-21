<?php

include '../../config/connection.php';

$query = "SELECT `idMember`, `namaLengkap`, fotoUrl, `alamat`, `noHp`, `email`, `password`, `token`, `tanggalRegistrasi` FROM `member` WHERE 1 ";
$result = mysqli_query($dbc, $query);
if(mysqli_num_rows($result) > 0){
    while ($data = mysqli_fetch_assoc($result)) {
        $myArray[] = $data;
    }

    $response = array(
        "success"=>true,
        "message"=>"Data ditemukan",
        "data"=>$myArray,
    );
}else{
    $response = array(
        "success"=>false,
        "message"=>"Data tidak ditemukan"
    );
}

die(json_encode($response));