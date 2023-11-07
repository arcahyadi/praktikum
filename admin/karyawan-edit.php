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
$id = $_GET["id"];
$query_honorer = "SELECT * FROM honorer WHERE id_honorer = $id";
$result_honorer = mysqli_query($conn, $query_honorer);
$row = mysqli_fetch_assoc($result_honorer);

if (isset($_POST["submit"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $tanggal_lahir = htmlspecialchars($_POST["tanggal_lahir"]);
    // $tanggal_lahir_mysql = date('Y-m-d', strtotime($tanggal_lahir));
    $tempat_lahir = htmlspecialchars($_POST["tempat_lahir"]);
    $jenis_kelamin = htmlspecialchars($_POST["jenis_kelamin"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $no_hp = htmlspecialchars($_POST["no_hp"]);
    $query = "UPDATE honorer SET nama = '$nama',
    tanggal_lahir = '$tanggal_lahir',
    tempat_lahir = '$tempat_lahir',
    jenis_kelamin = '$jenis_kelamin',
    alamat = '$alamat',
    no_hp = '$no_hp' WHERE id_honorer = $id;
    ";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script type='text/javascript'>
                alert('Data berhasil diedit!');
                document.location.href = 'honorer.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data gagal disimpan!');
                document.location.href = 'honorer-edit.php?id=$id';
                </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT DATA HONORER Praktikum FTI UNISKA 2023</title>
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
                            <h1>Data Honorer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item">Honorer</li>
                                <li class="breadcrumb-item active">Edit Honorer</li>
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
                                    <h3 class="card-title">Edit Data</h3>
                                </div>
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama">Nama Honorer</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row["nama"] ?>" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" value="<?php echo $row["tanggal_lahir"] ?>" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" value="<?php echo $row["tempat_lahir"] ?>" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" value="<?php echo $row["alamat"] ?>" class="form-control" id="alamat" name="alamat" placeholder="" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_hp">No HP</label>
                                            <input type="text" value="<?php echo $row["no_hp"] ?>" class="form-control" id="no_hp" name="no_hp" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                        <a href="honorer.php" class="btn btn-secondary">Cancel</a>
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