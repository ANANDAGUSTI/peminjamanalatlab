CREATE DATABASE IF NOT EXISTS peminjaman_alat;
USE peminjaman_alat;

CREATE TABLE IF NOT EXISTS peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nisn VARCHAR(20),
    tgl_pinjam DATE NOT NULL,
    jam_pinjam TIME,
    alat VARCHAR(50) NOT NULL,
    jumlah INT NOT NULL
);