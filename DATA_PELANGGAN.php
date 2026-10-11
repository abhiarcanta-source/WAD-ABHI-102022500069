<?php
include 'KONEKSI.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 6px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Pengelolaan Biodata Pelanggan</h1>

    <table style="width:100%">
        <thead>
            <tr>
                <th style="width:15%">ID</th>
                <th>Nama Pelanggan</th>
                <th>Nomor Telepon</th>
                <th>Catatan Penanganan Khusus Pakaian</th>
                <th style="width:15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_pelanggan']); ?></td>
                    <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                    <td><?= htmlspecialchars($row['nomor_telepon']); ?></td>
                    <td><?= htmlspecialchars($row['catatan_khusus']); ?></td>
                    <td>
                        <a href="EDIT_PELANGGAN.php?id=<?= urlencode($row['id_pelanggan']); ?>">Edit</a> |
                        <a href="DELETE_PELANGGAN.php?id=<?= urlencode($row['id_pelanggan']); ?>"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Belum ada data pelanggan.</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <br>
    <button><a href="PENGIMPUTAN_PELANGGAN.php">Tambah Data</a></button>
    <button><a href="MENU_MODUL.html">Menu</a></button>
</body>
</html>