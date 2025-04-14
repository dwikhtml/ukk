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
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];

// Query untuk menyimpan data pelanggan
$sql = "INSERT INTO Pelanggan (NamaPelanggan, Alamat, NomorTelepon) VALUES ('$nama', '$alamat', '$telepon')";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hasil Tambah Pelanggan</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --accent-hover: #2980b9;
            --bg-light: #f8f9fa;
            --text-light: #ffffff;
            --text-dark: #333333;
            --border-color: #dddddd;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: var(--bg-light);
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: var(--primary);
            margin-top: 30px;
            margin-bottom: 30px;
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

        /* Container for content */
        .container {
            margin-top: 50px;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .alert {
            font-size: 1.2rem;
            text-align: center;
            background-color: #28a745;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #dc3545;
        }

        .btn-back {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: var(--primary);
            color: var(--text-light);
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: var(--accent);
        }

        /* Form Styles */
        .form-wrapper {
            background-color: var(--text-light);
            padding: 35px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            transition: box-shadow 0.3s ease;
        }

        .form-wrapper:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .form-wrapper h2 {
            text-align: center;
            font-size: 1.9rem;
            margin-bottom: 30px;
            color: var(--primary);
            font-weight: 600;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--accent);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 5px;
        }

        .form-row label {
            width: 150px;
            margin-right: 20px;
            font-weight: 600;
            color: var(--text-dark);
            padding-top: 7px;
        }

        .form-row .form-control {
            flex: 1;
            min-width: 200px;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-row .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: var(--accent);
            color: var(--text-light);
            border: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: var(--accent-hover);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .form-wrapper {
                padding: 25px 20px;
            }

            .form-row {
                flex-direction: column;
                margin-bottom: 15px;
            }

            .form-row label {
                width: 100%;
                margin-bottom: 8px;
                margin-right: 0;
            }

            .navbar-nav .nav-link {
                margin-right: 10px;
                margin-bottom: 5px;
                padding: 6px 12px;
            }

            .form-wrapper h2 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 20px 15px;
            }

            .navbar .navbar-brand {
                font-size: 1.5rem;
            }

            .navbar-collapse {
                margin-top: 10px;
            }

            .form-wrapper {
                padding: 20px 15px;
            }

            button[type="submit"] {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Kasir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/index.php') ? 'active' : ''; ?>" href="index.php">Daftar Penjualan</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/tambah_pelanggan.php') ? 'active' : ''; ?>" href="tambah_pelanggan.php">Tambah Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/input_produk.html') ? 'active' : ''; ?>" href="input_produk.html">Tambah Produk</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/update_produk.php') ? 'active' : ''; ?>" href="update_produk.php">Update Produk</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/penjualan.php') ? 'active' : ''; ?>" href="penjualan.php">Formulir Penjualan</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/tampil_produk.php') ? 'active' : ''; ?>" href="tampil_produk.php">Daftar Produk</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/tampil_pelanggan.php') ? 'active' : ''; ?>" href="tampil_pelanggan.php">Daftar Pelanggan</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <?php
        // Eksekusi query jika data berhasil ditambahkan
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert'>Pelanggan berhasil ditambahkan!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        // Menutup koneksi
        $conn->close();
        ?>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
