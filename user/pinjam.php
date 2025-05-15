<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Alat - SMKTI Airlangga</title>
    <link rel="stylesheet" href="/peminjaman_alat_lab/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="pinjam-container">
        <h2>Peminjaman Alat Laboratorium</h2>
        <form action="../process.php" method="POST" class="pinjam-form" id="pinjamForm">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="text" name="nisn" placeholder="NISN" required>
            <input type="date" name="tgl_pinjam" required>
            <input type="time" name="jam_pinjam" required placeholder="Jam Pinjam">
            <select name="alat[]" required>
                <option value="">Pilih Alat</option>
                <option value="Proyektor">Proyektor</option>
                <option value="Speaker">Speaker</option>
                <option value="Laptop">Laptop</option>
                <option value="Mouse">Mouse</option>
                <option value="Keyboard">Keyboard</option>
                <option value="Charger HP">Charger HP</option>
                <option value="Charger Laptop">Charger Laptop</option>
            </select>
            <input type="number" name="jumlah[]" min="1" placeholder="Jumlah" required>
            <button type="submit" name="pinjam" class="btn-submit">Pinjam</button>
            <button type="button" onclick="addMore()" class="btn-add">Tambah Alat</button>
        </form>
    </div>
    <script>
        let alatCount = 1;

        function addMore() {
            if (alatCount < 5) {
                alatCount++;
                const form = document.getElementById('pinjamForm');
                const div = document.createElement('div');
                div.className = 'alat-group';
                div.style.opacity = 0;
                div.innerHTML = `
                    <select name="alat[]" required>
                        <option value="">Pilih Alat</option>
                        <option value="Proyektor">Proyektor</option>
                        <option value="Speaker">Speaker</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Mouse">Mouse</option>
                        <option value="Keyboard">Keyboard</option>
                        <option value="Charger HP">Charger HP</option>
                        <option value="Charger Laptop">Charger Laptop</option>
                    </select>
                    <input type="number" name="jumlah[]" min="1" placeholder="Jumlah" required>
                    <button type="button" class="btn-cancel" onclick="removeAlat(this)">Batal</button>
                `;
                form.insertBefore(div, form.lastElementChild);
                setTimeout(() => { div.style.opacity = 1; }, 10); // Animasi fade-in untuk alat baru
            }
        }

        function removeAlat(button) {
            const group = button.parentElement;
            group.style.opacity = 0;
            setTimeout(() => { group.remove(); alatCount--; }, 300); // Animasi fade-out
        }
    </script>
</body>
</html>