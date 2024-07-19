<?php
    include 'header.php';
    if(isset($_GET['proses'])) {
        if($_GET['proses']=='prosestambah') { 
        $kode_subkriteria=$_POST['kode_subkriteria'];
        $nama_subkriteria=$_POST['nama_subkriteria'];
        $kode_kriteria=$_POST['kode_kriteria'];
        $nilai_subkriteria=$_POST['nilai_subkriteria'];

        $sql = "INSERT INTO tbl_subkriteria (kode_subkriteria, nama_subkriteria, kode_kriteria, nilai_subkriteria) VALUES ('$kode_subkriteria', '$nama_subkriteria', '$kode_kriteria', '$nilai_subkriteria')";

        if ($connect->query($sql) === TRUE) {
            // header("location:subkriteria.php?kode_kriteria=$_POST[kode_kriteria]");
            echo "<script>window.location.href = 'subkriteria.php?kode_kriteria=$_POST[kode_kriteria]';</script>";
        }
        }elseif($_GET['proses']=='prosesubah'){
            $kode_subkriteria=$_POST['kode_subkriteria'];
            $nama_subkriteria=$_POST['nama_subkriteria'];
            $kode_kriteria=$_POST['kode_kriteria'];
            $nilai_subkriteria=$_POST['nilai_subkriteria'];

            $sql = "UPDATE tbl_subkriteria set nama_subkriteria='$nama_subkriteria', kode_kriteria='$kode_kriteria', nilai_subkriteria='$nilai_subkriteria' WHERE kode_subkriteria='$kode_subkriteria'";

            if ($connect->query($sql) === TRUE) {
                // header("location:subkriteria.php?kode_kriteria=$_POST[kode_kriteria]");
                echo "<script>window.location.href = 'subkriteria.php?kode_kriteria=$_POST[kode_kriteria]';</script>";
            }
        }elseif($_GET['proses']=='proseshapus'){
            $kode_subkriteria=$_GET['kode_subkriteria'];
            $kode_kriteria=$_POST['kode_kriteria'];

            $sql = "DELETE from tbl_subkriteria WHERE kode_subkriteria='$kode_subkriteria'";
            if ($connect->query($sql) === TRUE) {
                // header("location:subkriteria.php?kode_kriteria=$_GET[kode_kriteria]");
                echo "<script>window.location.href = 'subkriteria.php?kode_kriteria=$_GET[kode_kriteria]';</script>";
            }
        }
    }
?>
