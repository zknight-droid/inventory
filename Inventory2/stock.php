<?php
session_start(); // Mulai session

// Periksa apakah pengguna belum login, jika ya, alihkan kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Sertakan file koneksi
require_once('koneksi.php');

// Query untuk mengambil data barang dari database
$sql = "SELECT id, namabarang, stock FROM stock";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 6px 12px;
            margin: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
        }
    </style>
</head>
<body class="mt-5">

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <a class="navbar-brand" href="#">Inventory</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="stock.php">Stock</a>
      <a class="nav-item nav-link" href="logout.php">Logout</a>
    </div>
  </div>
  </div>
</nav>
    
<!-- CONTENT -->
<div class="container mt-5">
    <h2>Daftar Barang</h2>
    <a href="tambah_barang.php" class="btn btn-success mb-3">Tambah Barang</a>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Periksa jika query menghasilkan hasil atau tidak
            if ($result->num_rows > 0) {
                // Output data setiap baris
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["namabarang"] . "</td>";
                    echo "<td>" . $row["stock"] . "</td>";
                    echo "<td>
                            <button class='btn btn-success' onclick='editData(" . $row["id"] . ")'>Edit</button>
                            <button class='btn btn-danger' onclick='deleteData(" . $row["id"] . ")'>Hapus</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada barang.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- END CONTENT -->

<script>
    function editData(id) {
        // Alihkan pengguna ke halaman edit_barang.php dengan mengirimkan ID barang
        window.location.href = "edit_barang.php?id=" + id;
    }

    function deleteData(id) {
        // Konfirmasi pengguna sebelum menghapus data
        if (confirm("Anda yakin ingin menghapus data ini?")) {
            // Kirim permintaan penghapusan ke hapus_barang.php dengan mengirimkan ID barang
            window.location.href = "hapus_barang.php?id=" + id;
        }
    }
</script>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>
