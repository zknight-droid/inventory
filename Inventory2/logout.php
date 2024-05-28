<?php
session_start(); // Mulai session

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Alihkan kembali ke halaman login setelah logout
header("Location: login.php");
exit();
?>
