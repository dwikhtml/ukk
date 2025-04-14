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

// Query untuk menyimpan data ke tabel Produk
$sql = "INSERT INTO Produk (NamaProduk, Harga, Stok) VALUES ('$namaProduk', $harga, $stok)";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tambah Produk - Sistem Kasir</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --bg-light: #f8f9fa;
            --text-light: #ffffff;
            --text-dark: #333333;
            --border-color: #ddd;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: var(--bg-light);
            margin: 0;
            padding: 0;
            text-align: center;
            padding-top: 50px;
        }

        /* Navbar Styling */
        .navbar {
            background-color: var(--primary);
            padding: 12px 24px;
            box-shadow: var(--shadow);
        }

        .navbar .navbar-brand {
            color: var(--text-light);
            font-size: 1.8rem;
            font-weight: 700;
        }

        .navbar-nav .nav-link {
            color: var(--text-light);
            font-weight: 500;
            margin-right: 15px;
            transition: background 0.3s ease;
            font-size: 1rem;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            background-color: var(--accent);
            color: var(--text-light);
            border-radius: 5px;
        }

        /* Alert Styling */
        .alert {
            font-size: 1.2rem;
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            margin-left: 10%;
            margin-right: 10%;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
        }

        .alert-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-link {
            color: var(--accent);
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
                    <li class="nav-item"><a class="nav-link active" href="input_produk.html">Tambah Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="update_produk.php">Update Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="penjualan.php">Formulir Penjualan</a></li>
                    <li class="nav-item"><a class="nav-link" href="tampil_produk.php">Daftar Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="tampil_pelanggan.php">Daftar Pelanggan</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content (Notifikasi) -->
    <?php
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Produk berhasil ditambahkan. <br><a href='input_produk.html' class='btn-link'></a> <a href='index.php' class='btn-link'></a></div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>
