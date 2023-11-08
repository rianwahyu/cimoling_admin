<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'config/connection.php';
session_start();
if ($_SESSION['login'] != "login") {
    header("location:sign?message=not_yet");
}

$username =  $_SESSION['username'];
$fullname =  $_SESSION['fullname'];
$idUser   =  $_SESSION['idUser'];
$role     =  $_SESSION['role'];


/* $queryFoto = "SELECT foto FROM users WHERE username='$username'";
$resultFoto = mysqli_query($dbc, $queryFoto);
$rowsFoto = mysqli_fetch_assoc($resultFoto); */
//echo $queryFoto;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cimoling</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <link href='dist/fonts/source_sans_pro.css' rel='stylesheet' type='text/css'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- <link rel="stylesheet" href="plugins/ionic/ionic.css"> -->

    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link href='dist/css/ionicons.min.css' rel='stylesheet' type='text/css'>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="dist/css/sweetalert.css">

    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <!-- <link href='dist/js/jquery-ui.min.css' type='text/css' rel='stylesheet'> -->
    <link href='dist/css/jquery-ui.min.css' type='text/css' rel='stylesheet'>

    <link rel="stylesheet" href="plugins/fullcalendar/main.css">

    <style>
        .datetimepicker {
            z-index: 1600 !important;
            /* has to be larger than 1050 */
        }

        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url(dist/img/loading_buffering.gif) no-repeat center center;
            z-index: 10000;
        }

        /* .home-cell.table-responsive {
            width: 450px;
            overflow: auto !important;
            display: inline-block;
        }

        table .table-bordered {
            width: 190px;
            min-width: 270px;
        } */

        .table-plain tbody tr,
        .table-plain tbody tr:hover,
        .table-plain tbody td {
            background-color: transparent;
            border: none;
        }

        .formTitle {
            font-size: 10pt;
        }
        .formValue {
            font-size: 10pt;
        }
    </style>

</head>