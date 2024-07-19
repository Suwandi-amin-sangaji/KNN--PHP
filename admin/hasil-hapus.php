<?php
include 'header.php';
$kode_hasil=$_GET['kode_hasil'];

$sql = "DELETE from tbl_hasil WHERE kode_hasil='$kode_hasil'";
    if ($connect->query($sql) === TRUE) {
        echo "<script>window.location.href = 'hasil.php';</script>";
    }
?>         