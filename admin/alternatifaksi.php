<?php
    include 'header.php';
    
    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'tambah') { ?>

    <div class="container-table">
        <div class="alternatif-header">
            <h4><b>DATA TRAINING / TAMBAH DATA</b></h4>
        </div>

        <?php 
            $carikode = "SELECT MAX(kode_alternatif) AS max_kode FROM tbl_alternatif";
            $datakode = $connect->query($carikode);

            if ($datakode) {
                $row = $datakode->fetch_assoc();
                $max_kode = $row['max_kode'];

                if ($max_kode) {
                    $kode = (int) substr($max_kode, 1); 
                    $kode++; 
                    $kode_otomatis = "A" . str_pad($kode, 2, "0", STR_PAD_LEFT);
                } else {
                    $kode_otomatis = "A01"; 
                }
            } else {
                $kode_otomatis = "A01"; 
            }
        ?>

        <div class="panel panel-container">
            <div class="bootstrap-table">
                <form action="alternatifproses.php?proses=prosestambah" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="kode_alternatif" class="form-control" value="<?php echo $kode_otomatis ?>">

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik_alternatif" class="form-control" placeholder="nomor induk kependudukan" required>
                        <br>
                        <label>Nama</label>
                        <input type="text" name="nama_alternatif" class="form-control" placeholder="nama penduduk" required>
                    </div>

                    <div class="modal-footer" style="gap:15px;">
                        <a href="alternatif.php" class="btn-third" style="width:90px;">Kembali</a>
                        <input type="submit" class="btn-secondary" style="width:90px;" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php } elseif ($_GET['aksi'] == 'ubah') { ?>

    <div class="container-table">
        <div class="alternatif-header">
            <h4><b>DATA TRAINING / UBAH DATA</b></h4>
        </div>

        <div class="panel panel-container">
            <div class="bootstrap-table">
                <?php
                $kode_alternatif = mysqli_real_escape_string($connect, $_GET['kode_alternatif']);
                $query = "SELECT * FROM tbl_alternatif WHERE kode_alternatif='$kode_alternatif'";
                $result = mysqli_query($connect, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $a = mysqli_fetch_assoc($result);
                ?>
                <form action="alternatifproses.php?proses=prosesubah" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="kode_alternatif" class="form-control" value="<?php echo $a['kode_alternatif'] ?>">

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik_alternatif" class="form-control" placeholder="nomor induk kependudukan" value="<?php echo $a['nik_alternatif'] ?>" required>
                        <br>
                        <label>Nama</label>
                        <input type="text" name="nama_alternatif" class="form-control" placeholder="nama penduduk" value="<?php echo $a['nama_alternatif'] ?>" required>
                    </div>

                    <div class="modal-footer" style="gap:15px;">
                        <a href="alternatif.php" class="btn-third" style="width:90px;">Kembali</a>
                        <input type="submit" class="btn-secondary" style="width:90px;" value="Ubah">
                    </div>
                </form>
                <?php
                } else {
                    echo "<p>Data tidak ditemukan.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <?php }
    }
?>
