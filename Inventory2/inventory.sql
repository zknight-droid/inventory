-- Buat database
CREATE DATABASE IF NOT EXISTS inventory;

-- Gunakan database
USE inventory;

-- Tabel untuk menyimpan informasi pengguna
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabel untuk menyimpan informasi stok barang
CREATE TABLE IF NOT EXISTS stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    namabarang VARCHAR(255) NOT NULL,
    stock INT NOT NULL
);

-- Contoh data awal untuk tabel users
INSERT INTO users (username, password) VALUES ('admin', 'admin123');

-- Contoh data awal untuk tabel stock
INSERT INTO stock (namabarang, stock) VALUES ('Indomie Geprek', 10);
INSERT INTO stock (namabarang, stock) VALUES ('Indomie Soto', 20);
INSERT INTO stock (namabarang, stock) VALUES ('Indomie Goreng', 30);
