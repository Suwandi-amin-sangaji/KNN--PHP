<?php
    session_start();
    error_reporting(0);
    include'../assets/conn/cek.php';
    include'../assets/conn/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Klasifikasi Tingkat Kesejahteraan Masyarakat KNN</title>
    <link rel="shortcut icon" href="../assets/img/villa.svg">
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/cosmo.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
    
    <body>
    <div class="container-header">
        <div class="sidebar">
            <div class="header">
                <div class="list-item">
                    <a href="#">
                        <img src="../assets/img/villa.svg" alt="" class="menu">
                    </a>
                    <a href="#">
                        <img src="../assets/img/desa.png" alt="" class="icon">
                    </a>
                </div>
            </div>

            <div class="main">
                <div class="list-item">
                    <a href="index.php">
                        <img src="../assets/img/home.svg" alt="" class="icon">
                        <span class="description">Home</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="alternatif.php">
                        <img src="../assets/img/clinical_notes.svg" alt="" class="icon">
                        <span class="description">Data Training</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="kriteria.php">
                        <img src="../assets/img/rule.svg" alt="" class="icon">
                        <span class="description">Kriteria</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="metode.php">
                        <img src="../assets/img/rebase.svg" alt="" class="icon">
                        <span class="description">Metode K-NN</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="hasil.php">
                        <img src="../assets/img/bar_chart_4_bars.svg" alt="" class="icon">
                        <span class="description">Hasil Analisa</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="admin.php">
                        <img src="../assets/img/group_add.svg" alt="" class="icon">
                        <span class="description">Kelola Admin</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="logout.php">
                        <img src="../assets/img/move_item.svg" alt="" class="icon" >
                        <span class="description">Logout</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="header-content">
            <?php
            // session_start();
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
            ?>
                <div id="menu-button">
                    <input type="checkbox" id="menu-checkbox">
                    <label for="menu-checkbox" id="menu-label">
                        <div id="hamburger"></div>
                    </label>
                </div>
                <div class="account-username">
                    <span class="description"><?php echo $username; ?></span>
                    <img src="../assets/img/account_circle.svg" alt="" class="icon">
                </div>
            </div>
            
        
                
    <script src="../assets/js/script.js"></script>
    </body>
<!-- <body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="alternatif.php">ALTERNATIF</a></li>
                    <li><a href="kriteria.php">KRITERIA</a></li>
                    <li><a href="metode.php">METODE KNN</a></li>
                    <li><a href="hasil.php">HASIL ANALISA</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="assets/js/script.js"></script>
</body> -->
</html>