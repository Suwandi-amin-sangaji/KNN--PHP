<?php
    include 'header.php';
    if(isset($_GET['proses'])) {
        if($_GET['proses']=='prosestambah') { 
        $kode_alternatif=$_POST['kode_alternatif'];
        $keputusan=$_POST['keputusan'];
       
        $hasil = mysqli_query($connect, "SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
        while($baris = mysqli_fetch_array($hasil)){
            $idK = $baris['kode_kriteria'];
            $idS = $_POST[$idK];

            $query1 = mysqli_query($connect, "INSERT INTO tbl_training(kode_alternatif, kode_kriteria, kode_subkriteria) VALUES ('".$kode_alternatif."', '".$idK."', '".$idS."')");
            
        }

        $sqli = mysqli_query($connect, "UPDATE tbl_alternatif set keputusan='$keputusan' WHERE kode_alternatif='$kode_alternatif'");

        // header("location:training.php?kode_alternatif=$_POST[kode_alternatif]");
        echo "<script>window.location.href = 'training.php?kode_alternatif=$_POST[kode_alternatif]';</script>";

        }elseif($_GET['proses']=='prosesubah'){
            $kode_alternatif=$_POST['kode_alternatif'];
            $keputusan=$_POST['keputusan'];
            $query2 =mysqli_query($connect, "DELETE FROM tbl_training WHERE kode_alternatif='".$_POST['kode_alternatif']."'");
            
            $hasil = mysqli_query($connect, "SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
            while($baris = mysqli_fetch_array($hasil)){
                $idK = $baris['kode_kriteria'];
                $idS = $_POST[$idK];

                $query1 = mysqli_query($connect, "INSERT INTO tbl_training(kode_alternatif, kode_kriteria, kode_subkriteria) VALUES ('".$kode_alternatif."', '".$idK."', '".$idS."')");
                
            }
            $sqli = mysqli_query($connect, "UPDATE tbl_alternatif set keputusan='$keputusan' WHERE kode_alternatif='$kode_alternatif'");
            // header("location:training.php?kode_alternatif=$_POST[kode_alternatif]");
            echo "<script>window.location.href = 'training.php?kode_alternatif=$_POST[kode_alternatif]';</script>";
            
        }elseif($_GET['proses']=='proseshapus'){
            $kode_alternatif=$_GET['kode_alternatif'];

            $sql = mysqli_query($connect, "DELETE FROM tbl_training WHERE kode_alternatif='$kode_alternatif'");
            
            echo "<script>window.location.href = 'training.php?kode_alternatif=$_POST[kode_alternatif]';</script>";
          
        }

        
    }
?>