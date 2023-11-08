<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'connection.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = MD5($_POST['password']);

// menyeleksi data admin dengan username dan password yang sesuai
$query ="SELECT * FROM administrator WHERE `email`='$username' AND password='$password' AND status='1'";
$data = mysqli_query($dbc, $query);

$cek = mysqli_num_rows($data);

//echo $query;

if ($cek > 0) {
	$qry = mysqli_fetch_array($data);
	$_SESSION['login'] = "login";
	$_SESSION['idAdmin'] = $qry['idAdmin'];
	$_SESSION['namaLengkap'] = $qry['namaLengkap'];
	$_SESSION['email'] = $qry['email'];	
	$_SESSION['status'] = $qry['status'];
	header("location:../index");
} else {
	header("location:../sign?message=false");
}
