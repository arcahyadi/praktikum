<?php
session_start();
if ($_SESSION["peran"] == "USER") {
    header("Location: logout.php");
    exit;
}
if (!$_SESSION["login"]) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';
if (isset($_POST["submit"])) {
    $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
    $nik = htmlspecialchars($_POST["nik"]);
    // $nik_mysql = date('Y-m-d', strtotime($nik));
    $tanggal_masuk = htmlspecialchars($_POST["tanggal_masuk"]);
    $email = htmlspecialchars($_POST["email"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $no_hp = htmlspecialchars($_POST["no_hp"]);
    $query = "INSERT INTO karyawan VALUES ('', '$nama_lengkap','$nik','$tanggal_masuk','$email','$alamat','$no_hp')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan!');
                document.location.href = 'karyawan.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data gagal disimpan!');
                document.location.href = 'karyawan-tambah.php';
                </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMBAH DATA karyawan Praktikum FTI UNISKA 2023</title>
    <link rel="stylesheet" href="https://font.googleapis.com/css?family=Source+Sans+Pro:400,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include "theme-header.php"; ?>
        <?php include "theme-sidebar.php"; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item">karyawan</li>
                                <li class="breadcrumb-item active">Tambah karyawan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Karyawan</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Karyawan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                            <input type="text" class="form-control" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal Masuk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">No HP</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                        <a href="karyawan.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include "theme-footer.php"; ?>

        </div>

        <script src="../plugins/jquery/jquery.min.js"></script>
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../dist/js/adminlte.min.js"></script>

</body>

</html>