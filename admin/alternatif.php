<?php
    include 'header.php';
    $status = '';
    if(isset($_GET['status'])) {
        $status = $_GET['status'];
    }

    
    if($status == 'succ') {
        echo '<div class="alert alert-success">Data has been imported successfully.</div>';
    } elseif($status == 'err') {
        echo '<div class="alert alert-danger">There was an error while importing data. Please try again.</div>';
    } elseif($status == 'invalid_file') {
        echo '<div class="alert alert-warning">Invalid file format. Please upload a valid Excel file.</div>';
    }
?>

<div class="container-table">
    <div class="alternatif-header">
        <h4><b>DATA TRAINING</b></h4>
        <a href="alternatifaksi.php?aksi=tambah" class="btn-secondary" style="border-radius:30px;">+ Tambah Data</a>
    </div>
    <form class="row g-3" action="importData.php" method="post" enctype="multipart/form-data">
        <div class="col-auto">
            <label for="fileInput" class="visually-hidden">File</label>
            <input type="file" class="form-control" name="file" id="fileInput" />
        </div>
        <div class="col-auto">
            <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
        </div>
    </form>

    <div class="panel panel-container">
        <div class="bootstrap-table">
           <div class="table-responsive">
                <table class="table table-striped" id="alternatif">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Training</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $data="SELECT * FROM tbl_alternatif order by kode_alternatif asc";
                            $result = $connect->query($data);

                            if($result){
                                $no=1;
                                while($a=$result->fetch_assoc()){
                                    ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $a['nik_alternatif'] ?></td>
                                    <td class="text-center"><?php echo $a['nama_alternatif'] ?></td>
                                    <td class="text-center">
                                        <a href="training.php?kode_alternatif=<?php echo $a['kode_alternatif'] ?>">
                                            <img src="../assets/img/chip_extraction.svg" alt="">
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="alternatifaksi.php?kode_alternatif=<?php echo $a['kode_alternatif'] ?>&aksi=ubah">
                                            <img src="../assets/img/border_color.svg" alt="">
                                        </a>
                                        <a href="alternatifproses.php?kode_alternatif=<?php echo $a['kode_alternatif'] ?>&proses=proseshapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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

</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
    $('#alternatif').DataTable( {
       
    } );
} );
</script>








