<?php
    include 'header.php';
?>


<div class="container-table">
    <div class="alternatif-header">
    <?php
        $data=mysqli_query($connect, "SELECT * FROM tbl_alternatif WHERE kode_alternatif='$_GET[kode_alternatif]'");
        $a=mysqli_fetch_array($data);
    ?>
        <h4><b>DATA TRAINING / <a href="alternatif.php"> <?php echo $a['nama_alternatif'] ?></a></b></h4>
        <a href="trainingaksi.php?aksi=tambah&kode_alternatif=<?php echo $_GET['kode_alternatif']?>" class="btn-secondary" style="border-radius:30px; width:120px;"> + Tambah Data</a>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
           <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">Nama</th>

                            <?php
                            // menampilkan data kriteria
                            $data="SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC";
                            $result = $connect->query($data);

                            if($result){
                                $no=1;
                                while($b=$result->fetch_assoc()){
                                    echo "<th class='text-center'>$b[nama_kriteria]</th>";
                                }}
                                    ?>
                            
                            
                            <th class="text-center">Keputusan</th>
                            <th class="text-center">Opsi</th>
                               
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // menampilkan data alternatif
                            $data="SELECT * FROM tbl_alternatif WHERE kode_alternatif='$_GET[kode_alternatif]' order by kode_alternatif asc";
                            $result = $connect->query($data);

                            if($result){
                                $no=1;
                                while($c=$result->fetch_assoc()){
                                    $nomor = $no++;
                                    $kode=$c['kode_alternatif'];
                                    $nik=$c['nik_alternatif'];
                                    $nama=$c['nama_alternatif'];
                                    echo "<tr>
                                        <td class='text-center'>$nomor</td>";
                                    
                                    echo "<td class='text-center'>$nik</td>";
                                    echo "<td class='text-center'>$nama</td>";
                                    // menampilkan nilai subkriteria berdasarkan kriteria
                                    $query1=mysqli_query($connect, "SELECT a.nilai_subkriteria as sub FROM tbl_subkriteria a, tbl_training b WHERE b.kode_alternatif='".$kode."' AND a.kode_subkriteria=b.kode_subkriteria ORDER BY b.kode_kriteria");

                                    while($d=$query1->fetch_assoc()){
                                        $nilaisubkriteria = $d['sub'];
                                        echo "<td class='text-center'>$nilaisubkriteria</td>";
                                       
                                    } ?>

                                   
                                    <td class="text-center">
                                        <?php echo $c['keputusan'] ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="trainingaksi.php?kode_alternatif=<?php echo $a['kode_alternatif'] ?>&aksi=ubah">
                                            <img src="../assets/img/border_color.svg" alt="">
                                        </a>
                                        <a href="trainingproses.php?kode_alternatif=<?php echo $a['kode_alternatif'] ?>&proses=proseshapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <img src="../assets/img/delete.svg" alt="">
                                        </a>
                                    </td>

                               
                                    </tr>
                        <?php 
                        }
                    }
                    ?> 
                    </tbody>
                </table>
                </div>
        </div>
    </div>
</div> 