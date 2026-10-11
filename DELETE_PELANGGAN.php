<?php
include 'KONEKSI.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    header('Location: DATA PELANGGAN.php');
    exit;
}

$stmt = mysqli_prepare($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan = ?");
mysqli_stmt_bind_param($stmt, "s", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='DATA PELANGGAN.php';</script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}

mysqli_stmt_close($stmt);
?>