<?php
include 'header.php';
?>

<div class="container-table">
    <div class="alternatif-header">
            <h4><b>HASIL ANALISA</b></h4>
            <a href="export-data.php" class="btn-secondary" style="width:120px;">Export Data</a>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
            <div class="table-responsive">
            <table class="table table-striped" id="hasil">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama Alternatif</th>
                    <?php
                    // menampilkan data kriteria
                        $data="SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC";
                        $result = $connect->query($data);

                        if($result){
                            $no=1;
                            while($b=$result->fetch_assoc()){
                                echo "<th class='text-center'>$b[nama_kriteria]</th>";
                            }}else{
                                echo "Error: " . $connect->error;
                            }
                           ?>
                    <th class="text-center">Keputusan</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data alternatif
                $data="SELECT * FROM tbl_hasil order by kode_hasil asc";
                $result = $connect->query($data);


                
                if ($result) {
                    $no = 1;
                    while ($c = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $no . "</td>";
                        echo "<td class='text-center'>" . $c['nik_alternatif'] . "</td>";
                        echo "<td class='text-center'>" . $c['nama_alternatif'] . "</td>";
                        
                        $query1=mysqli_query($connect, "SELECT * FROM tbl_subkriteria");
                        $arr = array("K01", "K02", "K03", "K04", "K05", "K06");
                        $arr2 = array("penghasilan", "usia", "status_perkawinan", "jml_tanggungan", "pekerjaan", "kriteria_kesejahteraan");
                        $nmr=0;
                        while($d=$query1->fetch_assoc()){
                            if($d['nilai_subkriteria']==$c[$arr2[$nmr]] && $d['kode_kriteria']==$arr[$nmr]){
                                $nama_subkriteria = $d['nama_subkriteria'];
                                echo "<td class='text-center'>$nama_subkriteria</td>";                       
                                $nmr+=1;
                            }
                        } 

                        echo "<td class='text-center'>" . $c['keputusan'] . "</td>";
                ?>
                        <td class="text-center">
                            <a href="hasil-hapus.php?kode_hasil=<?php echo $c['kode_hasil'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <img src="../assets/img/delete.svg" alt="">
                            </a>
                        </td>
                <?php
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>

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
    $('#hasil').DataTable( {
        
    } );
} );
</script>
