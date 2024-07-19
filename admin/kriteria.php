<?php
    include 'header.php';
?>
<div class="container-table">
    <div class="alternatif-header">
        <h4><b>KRITERIA</b></h4>
        <a href="kriteriaaksi.php?aksi=tambah" class="btn-secondary" style="border-radius:30px; width:120px;">+ Tambah Data</a>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
           <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Kriteria</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Sub Kriteria</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data="SELECT * FROM tbl_kriteria order by kode_kriteria asc";
                            $result = $connect->query($data);

                            if($result){
                                $no=1;
                                while($a=$result->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $a['nama_kriteria'] ?></td>
                                    <td class="text-center"><?php echo $a['keterangan'] ?></td>
                                    
                                    <td class="text-center">
                                        <a href="subkriteria.php?kode_kriteria=<?php echo $a['kode_kriteria'] ?>">
                                            <img src="../assets/img/chip_extraction.svg" alt="">
                                        </a>
                                    </td>
                                    
                                    <td class="text-center">
                                        <a href="kriteriaaksi.php?kode_kriteria=<?php echo $a['kode_kriteria'] ?>&aksi=ubah">
                                            <img src="../assets/img/border_color.svg" alt="">
                                        </a>
                                        <a href="kriteriaproses.php?kode_kriteria=<?php echo $a['kode_kriteria'] ?>&proses=hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <img src="../assets/img/delete.svg" alt="">
                                        </a>
                                    </td>
                                </tr>
                        <?php 
                    }} ?>
                    </tbody>
                </table>
           </div>
        </div>
    </div>
</div>