<?php
session_start(); // Mulai session

// Periksa apakah pengguna belum login, jika ya, alihkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Sertakan file koneksi
require_once('koneksi.php');

// Inisialisasi variabel error
$errors = [];

// Periksa apakah data yang diperlukan dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan melalui formulir
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];

    // Validasi data yang dikirimkan
    if (empty($nama_barang)) {
        $errors[] = "Nama barang tidak boleh kosong.";
    }

    if (empty($stok)) {
        $errors[] = "Stok tidak boleh kosong.";
    } elseif (!is_numeric($stok) || $stok < 0) {
        $errors[] = "Stok harus berupa angka positif.";
    }

    // Periksa apakah nama barang sudah ada dalam database
    if (empty($errors)) {
        $sql_check = "SELECT * FROM stock WHERE namabarang = '$nama_barang'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            $errors[] = "Nama barang sudah ada dalam database.";
        }
    }

    // Periksa apakah tidak ada kesalahan validasi sebelum menambahkan barang baru
    if (empty($errors)) {
        // Query untuk menambahkan barang baru ke dalam database
        $sql = "INSERT INTO stock (namabarang, stock) VALUES ('$nama_barang', '$stok')";
        
        if ($conn->query($sql) === TRUE) {
            // Jika berhasil, alihkan kembali ke halaman stock
            header("Location: stock.php");
            exit();
        } else {
            $errors[] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h2>Tambah Barang</h2>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="stock.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>
