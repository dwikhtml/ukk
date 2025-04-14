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
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Formulir Penjualan</title>

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
            margin-right: 16px;
            transition: background 0.3s ease;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            background-color: var(--accent);
            color: var(--text-light);
            border-radius: 5px;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .form-container label {
            margin-top: 10px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        .form-container button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: var(--accent);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: 600;
            width: 100%;
        }

        .form-container button:hover {
            background-color: var(--accent-hover);
        }

        .kembalian {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Kasir</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Daftar Penjualan</a></li>
                <li class="nav-item"><a class="nav-link" href="tambah_pelanggan.php">Tambah Pelanggan</a></li>
                <li class="nav-item"><a class="nav-link" href="input_produk.html">Tambah Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="update_produk.php">Update Produk</a></li>
                <li class="nav-item"><a class="nav-link active" href="penjualan.php">Formulir Penjualan</a></li>
                <li class="nav-item"><a class="nav-link" href="tampil_produk.php">Daftar Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="tampil_pelanggan.php">Daftar Pelanggan</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="form-container">
    <h1>Formulir Penjualan</h1>
    <form action="proses_penjualan.php" method="post" onsubmit="return validateForm()">
        <label for="pelanggan">Pilih Pelanggan:</label>
        <select id="pelanggan" name="pelanggan" required>
            <?php
            $pelanggan = $conn->query("SELECT PelangganID, NamaPelanggan FROM Pelanggan");
            while ($row = $pelanggan->fetch_assoc()) {
                echo "<option value='{$row['PelangganID']}'>{$row['NamaPelanggan']}</option>";
            }
            ?>
        </select>

        <label for="produk">Pilih Produk:</label>
        <select id="produk" name="produk" required>
            <?php
            $produk = $conn->query("SELECT ProdukID, NamaProduk, Harga FROM Produk");
            while ($row = $produk->fetch_assoc()) {
                echo "<option value='{$row['ProdukID']}' data-harga='{$row['Harga']}'>{$row['NamaProduk']} (Rp " . number_format($row['Harga'], 2, ',', '.') . ")</option>";
            }
            ?>
        </select>

        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" required>

        <label for="uang">Uang yang Diberikan:</label>
        <input type="number" id="uang" name="uang" required>

        <button type="submit">Simpan Penjualan</button>
    </form>

    <div class="kembalian" id="kembalian">
        <!-- Kembalian akan tampil di sini -->
    </div>
</div>

<script>
    function calculateChange() {
        const uang = parseFloat(document.getElementById('uang').value);
        const produk = document.getElementById('produk');
        const harga = parseFloat(produk.options[produk.selectedIndex].getAttribute('data-harga'));
        const jumlah = parseFloat(document.getElementById('jumlah').value);

        const display = document.getElementById('kembalian');

        if (!isNaN(uang) && !isNaN(harga) && !isNaN(jumlah)) {
            const total = harga * jumlah;
            const kembalian = uang - total;

            if (kembalian >= 0) {
                display.innerText = "Kembalian: Rp " + kembalian.toLocaleString('id-ID', {minimumFractionDigits: 2});
                display.style.color = "black";
            } else {
                display.innerText = "Uang tidak cukup!";
                display.style.color = "red";
            }
        } else {
            display.innerText = "";
        }
    }

    function validateForm() {
        const uang = parseFloat(document.getElementById('uang').value);
        const produk = document.getElementById('produk');
        const harga = parseFloat(produk.options[produk.selectedIndex].getAttribute('data-harga'));
        const jumlah = parseFloat(document.getElementById('jumlah').value);
        const total = harga * jumlah;

        if (uang < total) {
            alert("Uang yang diberikan tidak cukup untuk melakukan pembelian.");
            return false;
        }

        return true;
    }

    document.getElementById('uang').addEventListener('input', calculateChange);
    document.getElementById('jumlah').addEventListener('input', calculateChange);
    document.getElementById('produk').addEventListener('change', calculateChange);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
