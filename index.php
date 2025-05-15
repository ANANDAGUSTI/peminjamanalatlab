<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: admin/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - SMKTI Airlangga</title>
    <link rel="stylesheet" href="/peminjaman_alat_lab/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>SMKTI Airlangga</h1>
        <p>Selamat datang di sistem peminjaman alat laboratorium.<br>Pilih opsi Anda untuk melanjutkan.</p>
        <div class="buttons">
            <a href="user/index.php" class="btn siswa">Masuk sebagai Siswa</a>
            <a href="login.php" class="btn admin">Masuk sebagai Admin</a>
        </div>
    </div>
</body>
</html>