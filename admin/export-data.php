<?php
    include 'header.php';
?>

<div class="container-table">
    <div class="alternatif-header">
            <h4><b>EXPORT DATA</b></h4>
    </div>

    <div class="panel panel-container">
        <div class="bootstrap-table">
        <br>
           <div class="table-responsive">
                <table id="export" class="table table-striped">
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
                        echo "<td class='text-center'>" . $no. "</td>";
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
        $('#export').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', {
                    extend: "pdfHtml5",
                    customize: function(doc) {
                        // Menyesuaikan margin dan alignment tabel
                        doc.content[1].margin = [5, 5, 5, 5]; // [left, top, right, bottom]
                        doc.styles.tableBodyEven.alignment = 'center';
                        doc.styles.tableBodyOdd.alignment = 'center';
                        doc.defaultStyle.fontSize = 8; // Mengatur ukuran font default
                        doc.styles.tableHeader.fontSize = 10; // Mengatur ukuran font header tabel

                        // Menentukan lebar kolom secara manual
                        var colCount = doc.content[1].table.body[0].length;
                        var columnWidths = [];
                        for (var i = 0; i < colCount; i++) {
                            if (i === 0) {
                                columnWidths.push('10%'); // Lebar kolom pertama
                            } else {
                                columnWidths.push((90 / (colCount - 1)) + '%'); // Lebar kolom lainnya
                            }
                        }
                        doc.content[1].table.widths = columnWidths;

                        // Mengatur layout tabel
                        doc.content[1].layout = {
                            hLineWidth: function(i, node) { return (i === 0 || i === node.table.body.length) ? 2 : 1; },
                            vLineWidth: function(i, node) { return (i === 0 || i === node.table.widths.length) ? 2 : 1; },
                            hLineColor: function(i, node) { return (i === 0 || i === node.table.body.length) ? 'black' : 'gray'; },
                            vLineColor: function(i, node) { return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray'; },
                            paddingLeft: function(i, node) { return 4; },
                            paddingRight: function(i, node) { return 4; },
                            paddingTop: function(i, node) { return 2; },
                            paddingBottom: function(i, node) { return 2; }
                        };
                    },
                    exportOptions: {
                        orthogonal: "myExport"
                    },
                    pageSize: 'A4', // Ukuran halaman
                    orientation: 'landscape', // Orientasi halaman
                    pageMargins: [5, 5, 5, 5] // Mengatur margin halaman
                }, 'print'
            ]
        });
    });
</script>









