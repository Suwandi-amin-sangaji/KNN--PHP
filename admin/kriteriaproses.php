<?php
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['proses'])) {
    if ($_GET['proses'] == 'tambah') {
            $kode_kriteria = $_POST['kode_kriteria'];
            $nama_kriteria = $_POST['nama_kriteria'];
            $keterangan = $_POST['keterangan'];

            $sql = "INSERT INTO tbl_kriteria (kode_kriteria, nama_kriteria, keterangan) VALUES ('$kode_kriteria', '$nama_kriteria', '$keterangan')";

            if ($connect->query($sql) === TRUE) {
                echo "<script>window.location.href = 'kriteria.php';</script>";
            }
        } elseif($_GET['proses'] == 'ubah') {
            $kode_kriteria = $_POST['kode_kriteria'];
            $nama_kriteria = $_POST['nama_kriteria'];
            $keterangan = $_POST['keterangan'];

            $sql = "UPDATE tbl_kriteria SET nama_kriteria='$nama_kriteria', keterangan='$keterangan' WHERE kode_kriteria='$kode_kriteria'";

            if ($connect->query($sql) === TRUE) {
                echo "<script>window.location.href = 'kriteria.php';</script>";
            }
        }
    }

// Proses penghapusan
if(isset($_GET['proses']) && $_GET['proses'] == 'hapus' && isset($_GET['kode_kriteria'])) {
    $kode_kriteria = $_GET['kode_kriteria'];

    // Hapus subkriteria terlebih dahulu
    $sql_sub = "DELETE FROM tbl_subkriteria WHERE kode_kriteria='$kode_kriteria'";
    $connect->query($sql_sub);

    // Setelah itu, baru hapus kriteria
    $sql_kriteria = "DELETE FROM tbl_kriteria WHERE kode_kriteria='$kode_kriteria'";
    if ($connect->query($sql_kriteria) === TRUE) {
        echo "<script>window.location.href = 'kriteria.php';</script>";
    } else {
        echo "Error: " . $sql_kriteria . "<br>" . $connect->error;
    }
}
?>