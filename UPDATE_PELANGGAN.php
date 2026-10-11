<?php
include 'KONEKSI.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: DATA_PELANGGAN.php');
    exit;
}

$id      = $_POST['id_pelanggan'] ?? '';
$nama    = trim($_POST['nama_pelanggan'] ?? '');
$telepon = trim($_POST['nomor_telepon'] ?? '');
$catatan = trim($_POST['catatan_khusus'] ?? '');

$stmt = mysqli_prepare($koneksi, "UPDATE pelanggan SET 
    nama_pelanggan = ?, 
    nomor_telepon = ?, 
    catatan_khusus = ? 
    WHERE id_pelanggan = ?");

mysqli_stmt_bind_param($stmt, "ssss", $nama, $telepon, $catatan, $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Data berhasil diubah!'); window.location='DATA PELANGGAN.php';</script>";
} else {
    echo "Gagal mengubah data: " . mysqli_error($koneksi);
}

mysqli_stmt_close($stmt);
?>