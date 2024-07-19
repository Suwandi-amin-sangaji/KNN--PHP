<?php
    include 'header.php';
?>

<div class="container-table">
    <div class="alternatif-header">
        <h4><b>KELOLA ADMIN</b></h4>
        <a href="adminaksi.php?aksi=tambah" class="btn-secondary" style="border-radius:30px; width:150px;">+ Tambah Admin</a>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
           <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Password</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data="SELECT * FROM tbl_akun";
                            $result = $connect->query($data);

                            if($result){
                                $no=1;
                                while($a=$result->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $a['nama_lengkap'] ?></td>
                                    <td class="text-center"><?php echo $a['username'] ?></td>
                                    <td class="text-center"><?php echo $a['password'] ?></td>
                                    <td class="text-center">
                                        <a href="adminaksi.php?kode_akun=<?php echo $a['kode_akun'] ?>&aksi=ubah">
                                            <img src="../assets/img/border_color.svg" alt="">
                                        </a>
                                        <a href="adminproses.php?kode_akun=<?php echo $a['kode_akun'] ?>&proses=hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
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