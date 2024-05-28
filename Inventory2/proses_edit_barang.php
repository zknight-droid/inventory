<?php
session_start(); // Mulai session

// Periksa apakah pengguna belum login, jika ya, alihkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Sertakan file koneksi
require_once('koneksi.php');

// Periksa apakah data yang diperlukan dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan melalui formulir
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];

    // Lakukan proses update ke dalam database
    $sql = "UPDATE stock SET namabarang='$nama_barang', stock='$stok' WHERE id='$id_barang'";
    
    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, alihkan kembali ke halaman stock
        header("Location: stock.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
