<?php

include '../../config/connection.php';


$request = $_POST['request'];

if ($request == 1) {
  $searchItem    = $_POST['search'];

  

  $query = "SELECT idKaryawan, namaKaryawan FROM karyawan WHERE namaKaryawan LIKE '%$searchItem%' ";

  //echo $query;

  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $response[] = array(
      "value" => $row['idKaryawan'],
      "label" => $row['namaKaryawan']
    );
  }

  echo json_encode($response);
}


if ($request == 2) {
  $idKaryawan = $_POST['idKaryawan'];

  $query = "SELECT idKaryawan, namaKaryawan, jabatan FROM karyawan WHERE idKaryawan = '$idKaryawan' ";

  $result = mysqli_query($dbc, $query);

  $users_arr = array();

  while ($row = mysqli_fetch_array($result)) {
    $idKaryawan = $row['idKaryawan'];
    $namaKaryawan = $row['namaKaryawan'];
    $jabatan = $row['jabatan'];
    $users_arr[] = array(
      "idKaryawan" => $idKaryawan,
      "namaKaryawan" => $namaKaryawan,
      "jabatan" => $jabatan
    );
  }
  echo json_encode($users_arr);
}
