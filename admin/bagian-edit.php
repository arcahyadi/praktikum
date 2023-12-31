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
$query_bagian = "SELECT * FROM bagian WHERE id_bagian = $id";
$result_bagian = mysqli_query($conn, $query_bagian);
$row_bagian = mysqli_fetch_assoc($result_bagian);

if (isset($_POST["submit"])) {
    $nama_bagian = htmlspecialchars($_POST["nama_bagian"]);
    $karyawan_id = htmlspecialchars($_POST["karyawan_id"]);
    $lokasi_id = htmlspecialchars($_POST["lokasi_id"]);
    $query = "UPDATE bagian SET nama_bagian = '$nama_bagian',
    karyawan_id = '$karyawan_id',
    lokasi_id = '$lokasi_id' WHERE id_bagian = $id;
    ";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script type='text/javascript'>
                alert('Data berhasil diedit!');
                document.location.href = 'bagian.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data gagal disimpan!');
                document.location.href = 'bagian-edit.php?id=$id';
                </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT DATA bagian Praktikum FTI UNISKA 2023</title>
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
                            <h1>Data bagian</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item">bagian</li>
                                <li class="breadcrumb-item active">Edit bagian</li>
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
                                            <label for="nama_bagian">Nama bagian</label>
                                            <input type="text" class="form-control" id="nama_bagian" name="nama_bagian" value="<?php echo $row_bagian["nama_bagian"] ?>" placeholder="Nama Bagian/Bidang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="karyawan_id">Kepala Bagian</label>
                                            <select type="date" class="form-control" id="karyawan_id" name="karyawan_id" required>
                                                <option value="">-- Pilih Kepala Bagian --</option>
                                                <?php
                                                $query_karyawan = "SELECT * FROM karyawan";
                                                $result_karyawan = mysqli_query($conn, $query_karyawan);
                                                while ($row_karyawan = mysqli_fetch_assoc($result_karyawan)) {
                                                ?>
                                                    <option value="<?php echo $row_karyawan['id_karyawan'] ?>" <?php if (!(strcmp(
                                                                                                                    $row_karyawan['id_karyawan'],
                                                                                                                    htmlentities($row_bagian['karyawan_id'], ENT_COMPAT, 'utf-8')
                                                                                                                ))) {
                                                                                                                    echo "SELECTED";
                                                                                                                } ?>>
                                                        <?php echo $row_karyawan['nama_lengkap'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi_id">Lokasi</label>
                                            <select type="date" class="form-control" id="lokasi_id" name="lokasi_id" required>
                                                <option value="">-- Pilih Lokasi --</option>
                                                <?php
                                                $query_lokasi = "SELECT * FROM lokasi";
                                                $result_lokasi = mysqli_query($conn, $query_lokasi);
                                                while ($row_lokasi = mysqli_fetch_assoc($result_lokasi)) {
                                                ?>
                                                    <option value="<?php echo $row_lokasi['id_lokasi'] ?>" <?php if (!(strcmp(
                                                                                                                    $row_lokasi['id_lokasi'],
                                                                                                                    htmlentities($row_bagian['lokasi_id'], ENT_COMPAT, 'utf-8')
                                                                                                                ))) {
                                                                                                                    echo "SELECTED";
                                                                                                                } ?>>
                                                        <?php echo $row_lokasi['nama_lokasi'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                            <a href="bagian.php" class="btn btn-secondary">Cancel</a>
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