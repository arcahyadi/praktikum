<?php
session_start();
// session_destroy();
if ($_SESSION["peran"] == "USER") {
    header("Location: logout.php");
    exit;
}
if (!$_SESSION["login"]) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';
$query = "SELECT K.*,
(SELECT J.nama_jabatan
FROM jabatan_karyawan JK
INNER JOIN jabatan J ON JK.jabatan_id = J.id_jabatan
WHERE karyawan_id = K.id_karyawan
ORDER BY JK.tanggal_mulai DESC LIMIT 1
) jabatan_terkini
FROM Karyawan K";

// $query = "SELECT K.*,(
//     SELECT J.nama_jabatan
//     FROM jabatan JK
//     INNER JOIN jabatan J
//     ON JK.id_jabatan = J.id_jabatan
//     INNER JOIN karyawan KA
//     WHERE KA.id_karyawan = K.id_karyawan
//     ORDER BY KA.tanggal_masuk DESC LIMIT 1
//     ) jabatan_terkini
//     FROM karyawan K";
$result = mysqli_query($conn, $query);
// $row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA Karyawan Praktikum FTI UNISKA 2023</title>
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
                            <h1>Data Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Karyawan</li>
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
                                    <a href="karyawan-tambah.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Tambah Data</a>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Action</th>
                                                <th>Jabatan Terkini</th>
                                                <th>Nama Karyawan</th>
                                                <th>NIK</th>
                                                <th>Handphone</th>
                                                <th>email</th>
                                                <th>Tanggal Masuk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td>
                                                        <a href="karyawan-edit.php?id=<?php echo $row["id_karyawan"]; ?>" class="btn btn-success btn-xs mr-1"><i class="fa fa-edit"></i>Ubah</a>
                                                        <a href="karyawan-hapus.php?id=<?php echo $row["id_karyawan"]; ?>" class="btn btn-danger btn-xs text-light" onclick="javascript: return confirm('Apakah yakin ingin menghapus data ini??');"><i class="fa fa-trash"></i>Hapus</a>
                                                    </td>
                                                    <td><?php echo $row["jabatan_terkini"]; ?></td>
                                                    <td><?php echo $row["nama_lengkap"]; ?></td>
                                                    <td><?php echo $row["nik"]; ?></td>
                                                    <td><?php echo $row["handphone"]; ?></td>
                                                    <td><?php echo $row["email"]; ?></td>
                                                    <td><?php echo $row["tanggal_masuk"]; ?></td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Action</th>
                                                <th>Jabatan Terkini</th>
                                                <th>Nama Karyawan</th>
                                                <th>NIK</th>
                                                <th>Handphone</th>
                                                <th>email</th>
                                                <th>Tanggal Masuk</th>
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
                "buttons": [
                    "copy",
                    "csv",
                    "excel",
                    'pdf',
                    "print",
                ],
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