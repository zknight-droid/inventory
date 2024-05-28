<?php
// Konfigurasi koneksi ke database
$host = "localhost:8111"; // Host database
$username = ""; // Username database
$password = ""; // Password database
$database = "inventory"; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
// if ($conn->connect_error) {
//     die("Koneksi gagal: " . $conn->connect_error);
// }

// echo "Koneksi berhasil"; // Pesan ini akan muncul jika koneksi berhasil
?>
