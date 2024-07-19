<?php
    include 'header.php';

    if (isset($_GET['proses'])) {
        if ($_GET['proses'] == 'prosestambah') {
            $kode_alternatif = $_POST['kode_alternatif'];
            $nik_alternatif = $_POST['nik_alternatif'];
            $nama_alternatif = $_POST['nama_alternatif'];

            $stmt = $connect->prepare("INSERT INTO tbl_alternatif (kode_alternatif, nama_alternatif, nik_alternatif) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $kode_alternatif, $nama_alternatif, $nik_alternatif);

            if ($stmt->execute() === TRUE) {
                echo "<script>window.location.href = 'alternatif.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } elseif ($_GET['proses'] == 'prosesubah') {
            $kode_alternatif = $_POST['kode_alternatif'];
            $nik_alternatif = $_POST['nik_alternatif'];
            $nama_alternatif = $_POST['nama_alternatif'];

            $stmt = $connect->prepare("UPDATE tbl_alternatif SET nama_alternatif = ?, nik_alternatif = ? WHERE kode_alternatif = ?");
            $stmt->bind_param("sss", $nama_alternatif, $nik_alternatif, $kode_alternatif);

            if ($stmt->execute() === TRUE) {
                echo "<script>window.location.href = 'alternatif.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } elseif ($_GET['proses'] == 'proseshapus') {
            $kode_alternatif = $_GET['kode_alternatif'];

            $stmt = $connect->prepare("DELETE FROM tbl_alternatif WHERE kode_alternatif = ?");
            $stmt->bind_param("s", $kode_alternatif);

            if ($stmt->execute() === TRUE) {
                echo "<script>window.location.href = 'alternatif.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
?>
