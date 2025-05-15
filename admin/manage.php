<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../config/db.php';

if (isset($_POST['kembali']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("SELECT alat, jumlah FROM peminjaman WHERE id = ?");
    $stmt->execute([$id]);
    $peminjaman = $stmt->fetch();

    if ($peminjaman) {
        $alat = $peminjaman['alat'];
        $jumlah = $peminjaman['jumlah'];
        $stok = [
            'Proyektor' => 2,
            'Speaker' => 1,
            'Laptop' => 5,
            'Mouse' => 10,
            'Keyboard' => 10,
            'Charger HP' => 4,
            'Charger Laptop' => 5
        ];
        $stok[$alat] += $jumlah;

        $stmt = $conn->prepare("DELETE FROM peminjaman WHERE id = ?");
        $stmt->execute([$id]);
        echo "<div class='success-message'>Alat berhasil dikembalikan!</div>";
    }
}

$stmt = $conn->query("SELECT * FROM peminjaman");
$peminjaman = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Peminjaman - SMKTI Airlangga</title>
    <link rel="stylesheet" href="/peminjaman_alat_lab/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="manage-container">
        <h2>Kelola Peminjaman Alat Lab</h2>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jam Pinjam</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peminjaman as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['nama']; ?></td>
                        <td><?php echo $item['nisn']; ?></td>
                        <td><?php echo $item['tgl_pinjam']; ?></td>
                        <td><?php echo $item['jam_pinjam']; ?></td>
                        <td><?php echo $item['alat']; ?></td>
                        <td><?php echo $item['jumlah']; ?></td>
                        <td>
                            <form action="manage.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="submit" name="kembali" class="btn-return">Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="manage-actions">
            <a href="dashboard.php" class="btn-back">Kembali</a>
            <a href="../logout.php" class="btn-logout">Logout</a>
        </div>
    </div>
</body>
</html>