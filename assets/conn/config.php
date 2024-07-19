<?php
$host = "localhost"; 
$username = "root"; 
$password = "root"; 
$database = "test";

$connect=mysqli_connect($host, $username, $password, $database);
$db = new mysqli($host, $username, $password, $database); 
// if($connect){
//     $open=mysqli_select_db($connect, $database);
//     echo "Database terhubung";
//     if(!$open){
//         echo "Database tidak dapat terhubung";
//     }
// }else{
//     echo "MySql tidak terhubung";
// }
// mysql_connect("localhost", "root", "");
// mysql_select_db("knn_algorithm");
?>