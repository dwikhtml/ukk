<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Daftar Pelanggan</title>

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

        /* Navbar Styling */
        .navbar {
            background-color: var(--primary);
            padding: 16px 24px;
            box-shadow: var(--shadow);
        }

        .navbar .navbar-brand {
            color: var(--text-light);
            font-size: 1.75rem;
            font-weight: 700;
        }

        .navbar-nav .nav-link {
            color: var(--text-light);
            font-weight: 500;
            margin-right: 16px;
            font-size: 1.05rem;
            padding: 10px 16px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            background-color: var(--accent);
            color: var(--text-light);
        }

        /* Main Content */
        .main-content {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .main-content h1 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 30px;
        }

        /* Table Styling */
        .table-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 24px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar .navbar-brand {
                font-size: 1.5rem;
            }

            .navbar-nav .nav-link {
                font-size: 1rem;
                margin-right: 0;
                margin-bottom: 6px;
                padding: 8px 12px;
            }

            .main-content {
                padding: 20px 15px;
            }

            .table-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Kasir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/index.php') ? 'active' : ''; ?>" href="index.php">Daftar Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/tambah_pelanggan.php') ? 'active' : ''; ?>" href="tambah_pelanggan.php">Tambah Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/input_produk.html') ? 'active' : ''; ?>" href="input_produk.html">Tambah Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/update_produk.php') ? 'active' : ''; ?>" href="update_produk.php">Update Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/penjualan.php') ? 'active' : ''; ?>" href="penjualan.php">Formulir Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/tampil_produk.php') ? 'active' : ''; ?>" href="tampil_produk.php">Daftar Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tampil_pelanggan.php">Daftar Pelanggan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Daftar Pelanggan</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "kasir";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    $sql = "SELECT NamaPelanggan, Alamat, NomorTelepon FROM Pelanggan";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $no++ . "</td>
                                    <td>" . htmlspecialchars($row["NamaPelanggan"]) . "</td>
                                    <td>" . htmlspecialchars($row["Alamat"]) . "</td>
                                    <td>" . htmlspecialchars($row["NomorTelepon"]) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align: center;'>Tidak ada data pelanggan.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
