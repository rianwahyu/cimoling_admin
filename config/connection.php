<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set('Asia/Jakarta');

//$dbc = mysqli_connect("localhost","root","","erpkk");
$dbc = mysqli_connect("localhost", "u1687666_demo_cimoling", "Rianwahyu1711", "u1687666_demo_cimoling");

// Check connection
if (mysqli_connect_errno()) {
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

mysqli_set_charset($dbc, "utf-8");
mysqli_set_charset($dbc, "utf8");