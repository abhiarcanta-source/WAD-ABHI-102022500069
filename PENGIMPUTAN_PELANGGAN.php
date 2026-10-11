<?php
include 'KONEKSI.php';

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = trim($_POST['id_pelanggan'] ?? '');
    $nama    = trim($_POST['nama_pelanggan'] ?? '');
    $telepon = trim($_POST['nomor_telepon'] ?? '');
    $catatan = trim($_POST['catatan_khusus'] ?? '');

    if ($id === '' || $nama === '' || $telepon === '') {
        $pesan = "ID Pelanggan, Nama, dan Nomor Telepon wajib diisi.";
    } else {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO pelanggan 
            (id_pelanggan, nama_pelanggan, nomor_telepon, catatan_khusus) 
            VALUES (?, ?, ?, ?)");

        mysqli_stmt_bind_param($stmt, "ssss", $id, $nama, $telepon, $catatan);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location='DATA PELANGGAN.php';</script>";
            exit;
        } else {
            $pesan = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengimputan Data Pelanggan</title>
</head>
<body>
    <h1>Pengimputan Data Pelanggan</h1>

    <?php if ($pesan): ?>
        <p style="color:red;"><?= htmlspecialchars($pesan); ?></p>
    <?php endif; ?>

    <form action="PENGIMPUTAN_PELANGGAN.php" method="POST">
        <label for="id_pelanggan">ID Pelanggan:</label><br>
        <input type="text" id="id_pelanggan" name="id_pelanggan" placeholder="Contoh: CS-1003" required><br><br>

        <label for="nama_pelanggan">Nama Pelanggan:</label><br>
        <input type="text" id="nama_pelanggan" name="nama_pelanggan" required><br><br>

        <label for="nomor_telepon">No. Telepon:</label><br>
        <input type="text" id="nomor_telepon" name="nomor_telepon" required><br><br>

        <label for="catatan_khusus">Catatan Penanganan Khusus:</label><br>
        <textarea id="catatan_khusus" name="catatan_khusus" rows="4" cols="40"></textarea><br><br>

        <input type="submit" value="Simpan">
    </form>

    <br>
    <a href="DATA_PELANGGAN.php">Kembali ke Data Pelanggan</a>
</body>
</html>