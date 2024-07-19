<?php
    include 'header.php';
    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='tambah') { ?>

        <div class="container-table">
            <div class="alternatif-header">
                <h4><b>KELOLA ADMIN/ TAMBAH ADMIN</b></h4>
            </div>

        <?php 
            $carikode = "SELECT MAX(kode_akun) AS max_kode FROM tbl_akun";
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
                <form action="adminproses.php?proses=tambah" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="kode_akun" class="form-control" value="<?php echo $kode_otomatis ?>">

                    <div class="form-group" style="margin-bottom:15px;">
                        <label for="formGroupExampleInput">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" id="formGroupExampleInput" placeholder="nama lengkap">
                    </div>

                    <div class="form-group" style="margin-bottom:15px;">
                        <label for="formGroupExampleInput2">Username</label>
                        <input type="text" name="username" class="form-control" id="formGroupExampleInput2" placeholder="username">
                    </div>

                    <div class="form-group" style="margin-bottom:15px;">
                        <label for="formGroupExampleInput2">Password</label>
                        <input type="text" name="password" class="form-control" id="formGroupExampleInput2" placeholder="password">
                    </div>

                    <div class="modal-footer" style="gap:15px;">
                        <a href="admin.php" class="btn-third" style="width:90px;">Kembali</a>
                        <input type="submit" class="btn-secondary" style="width:90px;" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php }elseif($_GET['aksi']=='ubah'){ ?>

        <div class="container-table">
            <div class="alternatif-header">
                <h4><b>KELOLA ADMIN/ UBAH DATA</b></h4>
            </div>
            
        <div class="panel panel-container">
            <div class="bootstrap-table">
                <?php
                $kode_akun = mysqli_real_escape_string($connect, $_GET['kode_akun']);
                $query = "SELECT * FROM tbl_akun WHERE kode_akun='$kode_akun'";
                $result = mysqli_query($connect, $query);

                while ($a = mysqli_fetch_array($result)) {
                ?>
                <form action="adminproses.php?proses=ubah" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="kode_akun" class="form-control" value="<?php echo $a['kode_akun'] ?>">
                    
                    <div class="form-group" style="margin-bottom:15px;">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="nama lengkap" value="<?php echo $a['nama_lengkap'] ?>">
                    </div>

                    <div class="form-group" style="margin-bottom:15px;">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo $a['username'] ?>">
                    </div>

                    <div class="form-group" style="margin-bottom:15px;">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" placeholder="password" value="<?php echo $a['password'] ?>">
                    </div>

                    <div class="modal-footer" style="gap:15px;">
                        <a href="admin.php" class="btn-third" style="width:90px;">Kembali</a>
                        <input type="submit" class="btn-secondary" style="width:90px;" value="Ubah">
                    </div>
                    

                </form>
                <?php } ?>
            </div>
        </div>
    </div>

        <?php }

    
 }
?>

