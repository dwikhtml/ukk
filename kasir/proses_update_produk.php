<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "kasir";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari form
$namaProduk = $_POST['namaProduk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Query untuk mengambil stok saat ini
$sql = "SELECT Stok FROM Produk WHERE NamaProduk = '$namaProduk'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stokBaru = $row["Stok"] + $stok;

    // Query untuk update stok dan harga
    $sql = "UPDATE Produk SET Stok = $stokBaru, Harga = $harga WHERE NamaProduk = '$namaProduk'";
    if ($conn->query($sql) === TRUE) {
        $message = "Produk berhasil diperbarui.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $message = "Produk tidak ditemukan.";
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Update Produk - Sistem Kasir</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .navbar {
            background-color: #2c3e50;
        }

        .navbar .navbar-brand {
            color: #fff;
        }

        .navbar .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: #3498db;
        }

        .main-content {
            max-width: 800px;
            margin: 50px auto;
        }

        .form-wrapper {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-wrapper h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-weight: 600;
        }

        .alert {
            text-align: center;
            font-weight: bold;
        }

        .btn-link {
            color: #3498db;
            text-decoration: none;
        }

        .btn-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Kasir</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Daftar Penjualan</a></li>
                    <li class="nav-item"><a class="nav-link" href="tambah_pelanggan.php">Tambah Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="input_produk.html">Tambah Produk</a></li>
                    <li class="nav-item"><a class="nav-link active" href="update_produk.php">Update Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="penjualan.php">Formulir Penjualan</a></li>
                    <li class="nav-item"><a class="nav-link" href="tampil_produk.php">Daftar Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="tampil_pelanggan.php">Daftar Pelanggan</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="form-wrapper">
            <h2>Update Produk</h2>

            <div class="alert <?php echo (isset($message) && strpos($message, "berhasil") !== false) ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo $message; ?>
            </div>

            <div class="text-center">
                <a href="update_produk.php" class="btn btn-primary">Kembali ke Formulir Update Produk</a>
                <a href="index.php" class="btn btn-secondary">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
