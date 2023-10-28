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
    $nama_jabatan = htmlspecialchars($_POST["nama_jabatan"]);
    $gapok_jabatan = htmlspecialchars($_POST["gapok_jabatan"]);
    $tunjangan_jabatan = htmlspecialchars($_POST["tunjangan_jabatan"]);
    $uang_makan_perhari = htmlspecialchars($_POST["uang_makan_perhari"]);
    $query = "INSERT INTO jabatan VALUES ('', '$nama_jabatan','$gapok_jabatan','$tunjangan_jabatan','$uang_makan_perhari')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan!');
                document.location.href = 'jabatan.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data gagal disimpan!');
                document.location.href = 'jabatan-tambah.php';
                </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMBAH DATA JABATAN Praktikum FTI UNISKA 2023</title>
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
                            <h1>Data Jabatan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item">Jabatan</li>
                                <li class="breadcrumb-item active">Tambah Jabatan</li>
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
                                            <label for="nama_jabatan">Nama Jabatan</label>
                                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gapok_jabatan">Gapok</label>
                                            <input type="number" class="form-control" id="gapok_jabatan" name="gapok_jabatan" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tunjangan_jabatan">Tunjangan</label>
                                            <input type="number" class="form-control" id="tunjangan_jabatan" name="tunjangan_jabatan" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="uang_makan_perhari">Uang Makan</label>
                                            <input type="number" class="form-control" id="uang_makan_perhari" name="uang_makan_perhari" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                        <a href="jabatan.php" class="btn btn-secondary">Cancel</a>
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