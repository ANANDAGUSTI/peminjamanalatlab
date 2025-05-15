<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../config/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMKTI Airlangga</title>
    <link rel="stylesheet" href="/peminjaman_alat_lab/style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Selamat Datang, Admin!</h2>
        <div class="dashboard-links">
            <a href="manage.php" class="btn-dashboard">Kelola Peminjaman</a>
            <a href="../logout.php" class="btn-logout">Logout</a>
        </div>
    </div>
</body>
</html>