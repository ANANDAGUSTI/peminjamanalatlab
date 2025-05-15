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
    <title>Login Admin - SMKTI Airlangga</title>
    <link rel="stylesheet" href="/peminjaman_alat_lab/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <form action="process.php" method="POST" class="login-form">
            <input type="hidden" name="role" value="admin">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn-login">Login</button>
            <a href="index.php" class="btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>