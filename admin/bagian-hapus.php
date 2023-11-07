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
$query = "DELETE FROM bagian WHERE id_bagian = $id";
$delete = mysqli_query($conn, $query);

if ($delete) {
    echo "<script type='text/javascript'>
                alert('Data berhasil dihapus!');
                document.location.href = 'bagian.php';
                </script>";
} else {
    echo "<script type='text/javascript'>
            alert('Data gagal dihapus!');
            document.location.href = 'bagian.php';
            </script>";
}
?>