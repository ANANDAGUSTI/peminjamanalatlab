<?php
session_start();
require_once 'config/db.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    if ($role == 'admin') {
        if ($username == "admin" && $password == "admin123") {
            $_SESSION['admin'] = true;
            $_SESSION['role'] = 'admin';
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $message = "<div class='error-message'><span class='icon-error'><i class='fas fa-times-circle'></i></span> Login gagal!<br><a href='login.php' class='btn-ok'>Kembali</a></div>";
        }
    }
}

if (isset($_POST['pinjam'])) {
    $nama = trim($_POST['nama']);
    $nisn = trim($_POST['nisn']);
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $jam_pinjam = $_POST['jam_pinjam'];
    $alat = $_POST['alat'];
    $jumlah = $_POST['jumlah'];

    // Validasi input
    if (empty($nama) || empty($nisn) || empty($tgl_pinjam) || empty($jam_pinjam) || empty($alat) || empty($jumlah)) {
        $message = "<div class='error-message'><span class='icon-error'><i class='fas fa-times-circle'></i></span> Semua field harus diisi!<br><a href='user/pinjam.php' class='btn-ok'>Kembali</a></div>";
    } else {
        $stok = [
            'Proyektor' => 2,
            'Speaker' => 1,
            'Laptop' => 5,
            'Mouse' => 10,
            'Keyboard' => 10,
            'Charger HP' => 4,
            'Charger Laptop' => 5
        ];

        $success = true;
        for ($i = 0; $i < count($alat); $i++) {
            if (empty($alat[$i]) || empty($jumlah[$i]) || !isset($stok[$alat[$i]]) || $stok[$alat[$i]] < $jumlah[$i]) {
                $success = false;
                break;
            }
            $stok[$alat[$i]] -= $jumlah[$i];
            $stmt = $conn->prepare("INSERT INTO peminjaman (nama, nisn, tgl_pinjam, jam_pinjam, alat, jumlah) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nama, $nisn, $tgl_pinjam, $jam_pinjam, $alat[$i], $jumlah[$i]]);
        }

        if ($success) {
            $message = "<div class='success-message'><span class='icon-success'><i class='fas fa-check-circle'></i></span> Peminjaman anda berhasil, Silahkan Ambil alat di Lab!<br><a href='index.php' class='btn-ok'>OK</a></div>";
        } else {
            $message = "<div class='error-message'><span class='icon-error'><i class='fas fa-times-circle'></i></span> Stok alat tidak mencukupi untuk salah satu item!<br><a href='user/pinjam.php' class='btn-ok'>Batal</a></div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Peminjaman - SMKTI Airlangga</title>
    <link rel="stylesheet" href="/peminjaman_alat_lab/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>SMKTI Airlangga</h1>
        <div class="message-container">
            <?php echo isset($message) ? $message : ''; ?>
        </div>
    </div>
</body>
</html>