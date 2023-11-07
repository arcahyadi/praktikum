<?php
session_start();
// session_destroy();
if ($_SESSION["peran"] == "USER") {
    header("Location: done.php");
    exit;
}
if (!$_SESSION["login"]) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';
$query = "SELECT karyawan.nama_lengkap, jabatan_karyawan.*, jabatan.nama_jabatan, bagian_karyawan.bagian_id, bagian.nama_bagian
FROM karyawan
INNER JOIN jabatan_karyawan
ON jabatan_karyawan.karyawan_id = karyawan.id_karyawan
INNER JOIN jabatan
ON jabatan.id_jabatan = jabatan_karyawan.jabatan_id
INNER JOIN bagian_karyawan
ON bagian_karyawan.jabatan_id = jabatan.id_jabatan
INNER JOIN bagian
on bagian.id_bagian = bagian_karyawan.bagian_id";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA Rekap Karyawan Praktikum FTI UNISKA 2023</title>
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
                            <h1>Data Rekap Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Rekap Karyawan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Bagian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['nama_lengkap'] ?></td>
                                                    <td><?php echo $row['nama_jabatan'] ?></td>
                                                    <td><?php echo $row['nama_bagian'] ?></td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Bagian</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include "theme-footer.php"; ?>

        </div>
    </div>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script src="../dist/js/demo.js"></script>

    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $("#example2").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": true,
            });
        });
    </script>
</body>

</html>