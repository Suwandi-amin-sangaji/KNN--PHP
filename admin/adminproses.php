<?php
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['proses'])) {
    if ($_GET['proses'] == 'tambah') {
            $kode_akun = $_POST['kode_akun'];
            $nama_lengkap = $_POST['nama_lengkap'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $sql = "INSERT INTO tbl_akun (kode_akun, nama_lengkap, username, password) VALUES ('$kode_akun', '$nama_lengkap', '$username', '$password')";

            if ($connect->query($sql) === TRUE) {
                echo "<script>window.location.href = 'admin.php';</script>";
            }
        } elseif($_GET['proses'] == 'ubah') {
            $kode_akun = $_POST['kode_akun'];
            $nama_lengkap = $_POST['nama_lengkap'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $sql = "UPDATE tbl_akun SET nama_lengkap='$nama_lengkap', username='$username' WHERE kode_akun='$kode_akun'";

            if ($connect->query($sql) === TRUE) {
                echo "<script>window.location.href = 'admin.php';</script>";
            }
        }
    }

// Proses penghapusan
if(isset($_GET['proses']) && $_GET['proses'] == 'hapus' && isset($_GET['kode_akun'])) {
    $kode_akun = $_GET['kode_akun'];

    $sql_akun = "DELETE FROM tbl_akun WHERE kode_akun='$kode_akun'";
    if ($connect->query($sql_akun) === TRUE) {
        echo "<script>window.location.href = 'admin.php';</script>";
    } 
}
?>