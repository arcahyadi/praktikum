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
    $karyawan_id = htmlspecialchars($_POST["karyawan_id"]);
    $tahun = htmlspecialchars($_POST["tahun"]);
    $bulan = htmlspecialchars($_POST["bulan"]);
    $jabatan_id = htmlspecialchars($_POST["jabatan_id"]);

    $query_jabatan_pilih = "SELECT * FROM jabatan WHERE id_jabatan = $jabatan_id";
    $result_jabatan_pilih = mysqli_query($conn,$query_jabatan_pilih);
    $row_jabatan_pilih = mysqli_fetch_assoc($result_jabatan_pilih);

    $gapok = $row_jabatan_pilih["gapok_jabatan"];
    $tunjangan = $row_jabatan_pilih["tunjangan_jabatan"];
    $uang_makan = $row_jabatan_pilih["uang_makan_perhari"];

    $query = "INSERT INTO penggajian VALUES ('', '$karyawan_id','$tahun','$bulan', '$gapok', '$tunjangan', '$uang_makan')";
    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan!');
                document.location.href = 'gaji.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data gagal disimpan!');
                document.location.href = 'gaji-tambah.php';
                </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah DATA Gaji Praktikum FTI UNISKA 2023</title>
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
                            <h1>Data Gaji</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item">Gaji</li>
                                <li class="breadcrumb-item active">Tambah Gaji</li>
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
                                            <label for="tahun">Tahun</label>
                                            <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bulan">Bulan</label>
                                            <select type="date" class="form-control" id="bulan" name="bulan" required>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="karyawan_id">Karyawan</label>
                                            <select type="date" class="form-control" id="karyawan_id" name="karyawan_id" required>
                                                <option value="">-- Pilih Karyawan --</option>
                                                <?php
                                                $query_karyawan = "SELECT * FROM karyawan";
                                                $result_karyawan = mysqli_query($conn, $query_karyawan);
                                                while ($row_karyawan = mysqli_fetch_assoc($result_karyawan)) {
                                                ?>
                                                    <option value="<?php echo $row_karyawan['id_karyawan'] ?>"><?php echo $row_karyawan["nama_lengkap"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan_id">Jabatan Terakhir</label>
                                            <select type="date" class="form-control" id="jabatan_id" name="jabatan_id" required>
                                                <option value="">-- Pilih Jabatan --</option>
                                                <?php
                                                $query_jabatan = "SELECT * FROM jabatan";
                                                $result_jabatan = mysqli_query($conn, $query_jabatan);
                                                while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                ?>
                                                    <option value="<?php echo $row_jabatan['id_jabatan'] ?>"><?php echo $row_jabatan["nama_jabatan"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                            <a href="gaji.php" class="btn btn-secondary">Cancel</a>
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