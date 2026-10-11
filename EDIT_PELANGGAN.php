<?php
include 'KONEKSI.php';

$id = $_GET['id'] ?? '';

$stmt = mysqli_prepare($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan = ?");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data pelanggan tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pelanggan</title>
</head>
<body>
    <h2>Edit Biodata Pelanggan</h2>

    <form action="UPDATE_PELANGGAN.php" method="POST">
        <input type="hidden" name="id_pelanggan" value="<?= htmlspecialchars($data['id_pelanggan']); ?>">

        <label>Nama Pelanggan:</label><br>
        <input type="text" name="nama_pelanggan"
               value="<?= htmlspecialchars($data['nama_pelanggan']); ?>" required><br><br>

        <label>Nomor Telepon:</label><br>
        <input type="text" name="nomor_telepon"
               value="<?= htmlspecialchars($data['nomor_telepon']); ?>" required><br><br>

        <label>Catatan Penanganan Khusus:</label><br>
        <textarea name="catatan_khusus" rows="4" cols="40" required><?= htmlspecialchars($data['catatan_khusus']); ?></textarea><br><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="DATA_PELANGGAN.php">Batal</a>
    </form>
</body>
</html>