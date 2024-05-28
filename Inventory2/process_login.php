<?php
session_start(); // Mulai session

// Periksa apakah pengguna sudah login, jika ya, alihkan ke halaman dashboard atau halaman lain yang sesuai
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Sertakan file koneksi
require_once('koneksi.php');

// Periksa apakah formulir login telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa keberadaan pengguna dalam database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Periksa jika query menghasilkan hasil atau tidak
    if ($result->num_rows == 1) {
        // Jika pengguna ditemukan, set session dan alihkan ke halaman dashboard
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika pengguna tidak ditemukan, tampilkan pesan kesalahan
        $error = "Username atau password salah.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Halaman Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
        <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
    </form>
</body>
</html>
