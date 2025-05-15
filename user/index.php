<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - SMKTI Airlangga</title>
    <link rel="stylesheet" href="/peminjaman_alat_lab/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Selamat Datang, Siswa!</h2>
        <h3>Daftar Alat Laboratorium</h3>
        <table>
            <tr>
                <th>Alat</th>
                <th>Stok Tersedia</th>
                <th>Status</th>
            </tr>
            <?php
            require_once '../config/db.php';
            $stok = [
                'Proyektor' => 2,
                'Speaker' => 1,
                'Laptop' => 5,
                'Mouse' => 10,
                'Keyboard' => 10,
                'Charger HP' => 4,
                'Charger Laptop' => 5
            ];
            $stmt = $conn->query("SELECT alat, SUM(jumlah) as total FROM peminjaman GROUP BY alat");
            $peminjaman = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            foreach ($peminjaman as $alat => $jumlah) {
                $stok[$alat] -= $jumlah;
            }
            $alat_list = ['Proyektor', 'Speaker', 'Laptop', 'Mouse', 'Keyboard', 'Charger HP', 'Charger Laptop'];
            foreach ($alat_list as $alat) {
                $tersedia = $stok[$alat] > 0 ? $stok[$alat] : 0;
                $status = $tersedia > 0 ? 'Tersedia' : 'Sedang Dipinjam';
            ?>
            <tr>
                <td><?php echo $alat; ?></td>
                <td><?php echo $tersedia; ?></td>
                <td><?php echo $status; ?></td>
            </tr>
            <?php } ?>
        </table>
        <a href="pinjam.php" class="btn-dashboard">Pinjam Alat</a>
        <a href="../logout.php" class="btn-logout">Logout</a>
    </div>
</body>
</html>