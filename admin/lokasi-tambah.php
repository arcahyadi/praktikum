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
    $nama_lokasi = htmlspecialchars($_POST["nama_lokasi"]);
    $query = "INSERT INTO lokasi VALUES ('', '$nama_lokasi')";
    $simpan = mysqli_query($conn, $query);

    if ($simpanf) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan!');
                document.location.href = 'lokasi.php';
                </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data gagal disimpan!');
                document.location.href = 'lokasi.php';
                </script>";
    }
}
?>
