<?php
     if(isset($_GET['aksi'])){
        if ($_GET['aksi'] == 'login'){
            session_start();
            include 'assets/conn/config.php';
            $username=$_POST['username'];
            $password=md5($_POST['password']);

            $query= "SELECT * from tbl_akun where username='$username' AND password='$password'";
            $result=$connect->query($query);

            if($result && $result->num_rows > 0){
                $adminFound = false;
                if ($result->num_rows > 0) {
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = 'Admin'; // Menganggap setiap pengguna yang berhasil login adalah admin
                    header("location:admin/index.php");
                    exit();
                    }else{
                        header("location:index.php?pesan=gagal");
                    }  
                }
               
                
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Klasifikasi Kesejahteraan Masyarakat</title>
    <link rel="shortcut icon" href="assets/img/villa.svg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/cosmo.min.css"> -->

</head>
<body>
<div class="container-login">
    <div class="logo">
        <img src="assets/img/desa.png" alt="logo" width="120"> 
    </div>

<?php
if(isset($_GET['aksi'])){
    if($_GET['aksi']=='login'){
        echo "<div class='alert-container'>
              <div class='alert'>
              <span class='closebtn' onclick='this.parentElement.parentElement.style.display=\"none\";'>&times;</span>
              Login gagal, username dan password salah
              </div>
              </div>";
    }
}
?>

    <!-- <div class="container-login"> -->
    <div class="row align-items-center justify-content-center">
        <div class="col-md-4 text-center">
            <h2 class="login">Selamat Datang di <br>Sistem Pendukung Keputusan KNN!</h2>
            <img src="assets/img/sallyy.png" alt="saly" class="img-fluid mb-2 mb-md-0 d-none d-md-block mx-auto" width="350">
        </div>
        <div class="col-md-4 align-items-center justify-content-center">
        <form action="index.php?aksi=login" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                <div class="mb-3" style="color:var(--primary)">
                <h3 class="card-title" style="font-size: 20px;">Login</h3>
                <p class="card-subtitle mb-2" style="font-size: 13px;">Silakan masuk ke akun Anda!</p>
                </div>
                <div class="mb-3" style="font-size: 10px;">
                <label for="disabledTextInput" class="form-label text-body-secondary">Username</label>
                <input type="text" class="form-control text-body-secondary" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" placeholder="username">
                </div>
                <div class="mb-3" style="font-size: 10px;">
                <label for="disabledTextInput" class="form-label text-body-secondary">Password</label>
                <input type="password" name="password" class="form-control text-body-secondary" placeholder="password" id="exampleInputPassword1">
                </div>
                <div class="d-grid mx-auto" style="padding-top:10px;">
                <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </form>
        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>