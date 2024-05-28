<?php
session_start(); // Mulai session

// Periksa apakah pengguna belum login, jika ya, alihkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Sertakan file koneksi
require_once('koneksi.php');

// Periksa apakah ID barang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data barang berdasarkan ID
    $sql = "DELETE FROM stock WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman stock setelah penghapusan berhasil
        echo "<script>window.location.href = 'stock.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID barang tidak diberikan.";
}
?>
