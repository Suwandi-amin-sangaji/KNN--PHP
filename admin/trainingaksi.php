<?php
    include 'header.php';
    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='tambah') { ?>

    <div class="container-table">
        <div class="alternatif-header">
            <h4><b>DATA TRAINING/ TAMBAH DETAIL DATA</h4></b>
        </div>

        <div class="panel panel-container">
            <div class="bootstrap-table">
                <form action="trainingproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="kode_alternatif" class="form-control" value="<?php echo $_GET['kode_alternatif']?>">

                    <?php
                        $hasil = mysqli_query($connect, "SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
                        while($baris = mysqli_fetch_array($hasil)){
                            $idK = $baris['kode_kriteria'];
                            $labelK = $baris['nama_kriteria'];

                            echo "<div class='form-group'>
                            <label>".$labelK."</label>";

                            echo "<select name=".$idK." class='form-select' aria-label='Default select example'>";
                            
                            $hasil2 = mysqli_query($connect, "SELECT * FROM tbl_subkriteria WHERE kode_kriteria='".$idK."' ORDER BY nilai_subkriteria DESC");

                            if (!$hasil2) {
                                die("Error: " . mysqli_error($connect));
                            }

                            while($baris2 = mysqli_fetch_array($hasil2)){
                                echo "<option selected value=".$baris2['kode_subkriteria'].">".$baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")</option>";
                            }

                            echo "</select> </div>";
                        }

                    ?>

                    <div class="form-group">
                        <label for="">Keputusan</label>
                        <select name="keputusan" class="form-select" aria-label="Default select example">
                            <option selected>Layak</option>
                            <option>Tidak Layak</option>
                        </select>
                    </div>

                    <div class="modal-footer" style="gap:15px;">
                        <a href="training.php?kode_alternatif=<?php echo $_GET['kode_alternatif']?>" class="btn-third" style="width:90px;">Kembali</a>
                        <input type="submit" class="btn-secondary" style="width:90px;" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php }elseif($_GET['aksi']=='ubah'){ ?>

        <div class="container-table">
            <div class="alternatif-header">
                <h4><b>DATA TRAINING/ UBAH DETAIL DATA</b></h4>
            </div>


        <div class="panel panel-container">
            <div class="bootstrap-table">
                <form action="trainingproses.php?proses=prosesubah" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="kode_alternatif" class="form-control" value="<?php echo $_GET['kode_alternatif']?>">
                    
                    <?php 
                         $hasil = mysqli_query($connect, "SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
                         while($baris = mysqli_fetch_array($hasil)){
                            $idK = $baris['kode_kriteria'];
                            $labelK = $baris['nama_kriteria'];
                            $kode_alternatif = $_GET['kode_alternatif'];

                            $hasil3 = mysqli_query($connect, "SELECT * FROM tbl_training WHERE kode_kriteria='".$idK."' AND kode_alternatif='".$kode_alternatif."' ");

                            $result3 = mysqli_fetch_array($hasil3);
                            $sub = $result3['kode_subkriteria'];

                            echo "<div class='form-group'>
                            <label>".$labelK."</label>";

                            echo "<select name=".$idK." class='form-select' aria-label='Default select example'>";
                            
                            $hasil2 = mysqli_query($connect, "SELECT * FROM tbl_subkriteria WHERE kode_kriteria='".$idK."' ORDER BY nilai_subkriteria DESC");

                           
                            while($baris2 = mysqli_fetch_array($hasil2)){
                                if($baris2['kode_subkriteria']==$sub){
                                    echo "<option selected value=".$baris2['kode_subkriteria'].">".$baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")</option>";
                                }else{
                                    echo "<option selected value=".$baris2['kode_subkriteria'].">".$baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")</option>";
                                }

                                
                            }

                            echo "</select> </div>";
                        }
                    ?>

                    <?php   
                    $hasil = mysqli_query($connect, "SELECT * FROM tbl_alternatif WHERE kode_alternatif='$_GET[kode_alternatif]'");
                    while($baris = mysqli_fetch_array($hasil)){ 
                    ?>
                           

                    <div class="form-group">
                        <label for="">Keputusan</label>
                        <select name="keputusan" class="form-select" aria-label="Default select example">
                            <!-- <option selected><?php echo $baris['keputusan'] ?></option> -->
                            <option selected>Sejahtera</option>
                            <option>Tidak Sejahtera</option>
                        </select>
                    </div>

                    
                    <?php } ?>

                    <div class="modal-footer" style="gap:15px;">
                        <a href="training.php?kode_alternatif=<?php echo $_GET['kode_alternatif']?>" class="btn-third" style="width:90px;">Kembali</a>
                        <input type="submit" class="btn-secondary" style="width:90px;"value="Ubah">
                    </div>

                </form>
               
            </div>
        </div>
    </div>

        <?php }

    
 }
?>

