<?php 
// Load the database configuration file 
session_start();
error_reporting(E_ALL); // Set error reporting to display all types of errors
ini_set('display_errors', 1); // Display errors on screen
include'../assets/conn/cek.php';
include'../assets/conn/config.php';

// Include PhpSpreadsheet library autoloader 
require_once '../vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 

try {
    if(isset($_POST['importSubmit'])){ 
        
        // Allowed mime types 
        $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        
        // Validate whether selected file is an Excel file 
        if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)){ 
            // If the file is uploaded 
            if(is_uploaded_file($_FILES['file']['tmp_name'])){ 
                $reader = new Xlsx(); 
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']); 
                $worksheet = $spreadsheet->getActiveSheet();  
                $worksheet_arr = $worksheet->toArray(); 

                // Remove header row 
                unset($worksheet_arr[0]); 

                foreach($worksheet_arr as $row){ 
					$carikode = "SELECT MAX(kode_alternatif) AS max_kode FROM tbl_alternatif";
            		$datakode = $connect->query($carikode);
					if ($datakode) {
						$koderow = $datakode->fetch_assoc();
						$max_kode = $koderow['max_kode'];
					
						if ($max_kode) {
							// Mengambil karakter pertama (A) dan sisanya sebagai nomor
							$kode_prefix = substr($max_kode, 0, 1); 
							$kode_number = (int) substr($max_kode, 1); 
					
							// Memastikan nomor memiliki panjang minimal 3 digit
							$kode_number++; 
							$kode_otomatis = $kode_prefix . str_pad($kode_number, 3, "0", STR_PAD_LEFT);
						} else {
							$kode_otomatis = "A001"; // Jika tidak ada data, maka kode awalnya adalah A001
						}
					} else {
						$kode_otomatis = "A001"; // Jika terjadi kesalahan atau tidak ada data, kode awalnya adalah A001
					}
					
                    $nik_alternatif = $row[0]; 
                    $nama_alternatif = $row[1];
					$nilai = array($row[2], $row[3], $row[4], $row[5], $row[6], $row[7]);
                    $keputusan = $row[8]; 

					$kode_alternatif=$kode_otomatis;
					$nik_alternatif=$nik_alternatif;
					$nama_alternatif=$nama_alternatif;
					
					$db->query("INSERT INTO tbl_alternatif (kode_alternatif, nama_alternatif, nik_alternatif) VALUES ('$kode_alternatif', '$nama_alternatif', '$nik_alternatif')"); 

					$keputusan=$keputusan;
				
					$hasil = mysqli_query($connect, "SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
					$index = 0;
					while($baris = mysqli_fetch_array($hasil)){
						$idK = $baris['kode_kriteria'];
						$idS = $nilai[$index];
						$index++;

						$query1 = mysqli_query($connect, "INSERT INTO tbl_training(kode_alternatif, kode_kriteria, kode_subkriteria) VALUES ('".$kode_alternatif."', '".$idK."', '".$idS."')");
						
					}

					$sqli = mysqli_query($connect, "UPDATE tbl_alternatif set keputusan='$keputusan' WHERE kode_alternatif='$kode_alternatif'");


                    // // Check whether member already exists in the database with the same email 
                    // $prevQuery = "SELECT id FROM excel WHERE nik = '".$nik."'"; 
                    // $prevResult = $db->query($prevQuery); 
                     
                    // if($prevResult->num_rows > 0){ 
                    //     // Update member data in the database 
                    //     $db->query("UPDATE excel SET nik = '".$nik."', nama = '".$nama."', usia = '".$usia."', status_perkawinan = '".$status_perkawinan."', tanggungan = '".$tanggungan."', pekerjaan = '".$pekerjaan."', penghasilan = '".$penghasilan."', kriteria_blt = '".$kriteria_blt."', status = '".$status."', WHERE nik = '".$nik."'"); 
                    // }else{ 
                    //     // Insert member data in the database 
                    //     $db->query("INSERT INTO excel (nik, nama, usia, status_perkawinan, tanggungan, pekerjaan, penghasilan, kriteria_blt, status) VALUES ('".$nik."', '".$nama."', '".$usia."', '".$status_perkawinan."', '".$tanggungan."', '".$pekerjaan."', '".$penghasilan."', '".$kriteria_blt."', '".$status."')"); 
                    // } 
					// $db->query("INSERT INTO excel (nik, nama, usia, status_perkawinan, tanggungan, pekerjaan, penghasilan, kriteria_blt, status) VALUES ('".$nik."', '".$nama."', '".$usia."', '".$status_perkawinan."', '".$tanggungan."', '".$pekerjaan."', '".$penghasilan."', '".$kriteria_blt."', '".$status."')"); 
                } 
                 
                $qstring = '?status=succ'; 
            }else{ 
                throw new Exception('File not uploaded.');
            } 
        }else{ 
            throw new Exception('Invalid file type.');
        } 
    } 

    // Redirect to the listing page 
    header("Location: alternatif.php".$qstring); 
} catch (Exception $e) {
    // Log the error
    error_log('Error occurred: ' . $e->getMessage());

    // Redirect to the listing page with error status
    header("Location: alternatif.php?status=error&message=" . urlencode($e->getMessage()));
    exit;
}
?>
