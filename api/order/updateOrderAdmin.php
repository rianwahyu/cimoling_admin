<?php

include '../../config/connection.php';

$orderID = $_POST['orderID'];
$userAdmin = $_POST['username'];
$status = $_POST['status'];

$query = "";


if ($status == "0") {
    $statusOrderTo = 1;
    $query = $query . "UPDATE booking SET statusOrder='$statusOrderTo' WHERE orderID='$orderID'; ";
    $query = $query . "INSERT INTO `bookingValue`(`orderID`, `keterangan`, `status`, `tanggalValue`, `userAdmin`) VALUES ('$orderID', 'Pesanan telah di proses oleh admin, mohon menunggu proses selanjutnya', '$statusOrderTo', NOW(), '$userAdmin'); ";
} elseif ($status == "1") {
    if ($_POST['ketProses'] == "confirm") {
        $statusOrderTo = 2;
        $query = $query . "UPDATE booking SET statusOrder='$statusOrderTo' WHERE orderID='$orderID'; ";
        $query = $query . "INSERT INTO `bookingValue`(`orderID`, `keterangan`, `status`, `tanggalValue`, `userAdmin`) VALUES ('$orderID', 'Pesanan telah di konfirmasi admin, menunggu status perjalanan ke alamat anda', '$statusOrderTo', NOW(), '$userAdmin'); ";
    } elseif ($_POST['ketProses'] == "cancel") {
        $statusOrderTo = 5;
        $reasonCancel = $_POST['reasonCancel'];
        $query = $query . "UPDATE booking SET statusOrder='$statusOrderTo' WHERE orderID='$orderID'; ";
        $query = $query . "INSERT INTO `bookingValue`(`orderID`, `keterangan`, `status`, `tanggalValue`, `userAdmin`) VALUES ('$orderID', 'Admin Cimoling membatalkan order dikarenakan $reasonCancel', '$statusOrderTo', NOW(), '$userAdmin'); ";
    }
} elseif ($status == "2") {
    if ($_POST['idKaryawan'] == '') {
    } else {
        $statusOrderTo = 3;
        $idKaryawan = $_POST['idKaryawan'];

        $i = 0;

        foreach ($idKaryawan as $val) {
            $query = $query . "INSERT INTO `delivery_cuci_person`(`orderID`, `idKaryawan`, `dateCreated`, `_by`) VALUES ('$orderID','$val',NOW(),'$userAdmin') ON DUPLICATE KEY UPDATE dateCreated=values(dateCreated), _by=values(_by); ";
            $i++;
        }

        $query = $query . "UPDATE booking SET statusOrder='$statusOrderTo' WHERE orderID='$orderID'; ";
        $query = $query . "INSERT INTO `bookingValue` (`orderID`, `keterangan`, `status`, `tanggalValue`, `userAdmin`) VALUES ('$orderID', 'Order Anda telah di proses untuk perjalan ke tempat anda, mohon menunggu tim CIMOLING dalam perjalan ke tempat anda', '$statusOrderTo', NOW(), '$userAdmin'); ";

        //echo $query;
    }
}

if (mysqli_multi_query($dbc, $query)) {
    do {
        $cumulative_rows += mysqli_affected_rows($dbc);
    } while (mysqli_more_results($dbc) && mysqli_next_result($dbc));
}
if ($error_mess = mysqli_error($dbc)) {
    echo "Error: $error_mess";
}


if ($cumulative_rows > 0) {
    //$msg['hasil'] = "success";    
    if ($status == "0") {
        $message = "Status Order berhasil di update dan dialihkan ke menu Order Proses";
    } elseif ($status == "1") {
        if ($_POST['ketProses'] == "confirm") {
            $message = "Status Order berhasil di konfirmasi dan dialihkan ke menu Order Konfirmasi";
        } elseif ($_POST['ketProses'] == "cancel") {
            $message = "Status Order berhasil di cancel dan dialihkan ke menu Order Dibatalkan";
        }
    } elseif ($status == "2") {
        $message = "Order berhasil di setting ke status PERJALANAN";
    }
    $response = array(
        "success" => true,
        "message" => $message
    );
} else {
    $response = array(
        "success" => false,
        "message" => "Proses Update Gagal"
    );
}

die(json_encode($response));
