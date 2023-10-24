<?php
session_start();
date_default_timezone_set('Asia/Singapore');

if (isset($_SESSION["login"])) {
    header("Location: admin/index.php");
    exit;
}
    require 'koneksi.php';

    if (isset($_POST["login"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];
        $login_terakhir = date("Y-m-d H:i:s");

        $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");
        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;
                $_SESSION["peran"] = $row["peran"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["id"] = $row["id"];

                if ($row["peran"] == "ADMIN") {
                    $update = mysqli_query($conn, "UPDATE pengguna SET login_terakhir = '$login_terakhir' WHERE username = '$username'");
                    header("Location: admin/index.php");

                } else if ($row["peran"] == "USER") {
                    $update = mysqli_query($conn, "UPDATE pengguna SET login_terakhir = '$login_terakhir' WHERE username = '$username'");
                    header("Location: admin/index.php");
                }
                exit;
            }
        }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PRAKTIKUM FTI UNISKA</title>
    <link rel="stylesheet" href="https://font.googleapis.com/css?family=Source+Sans+Pro:400,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>PRAKTIKUM</b><br>FTI UNISKA</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Masukkan Username dan Password anda</p>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">$times;</button>
                    <h5><i class="icon fas fa-ban"></i>Alert!</h5>
                    Username atau Password salah...!
                    </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-block btn primary" name="login">Masuk</button>
                            <a href="#" class="btn btn-block btn-danger">Buat Akun</a>
                        </div>
                    </div>
                </form>
                
                <p class="nt-3">
                    <a href="#">Lupa Password?</a>
                </p>
            </div>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    
</body>
</html>