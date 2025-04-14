<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Update Produk</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    :root {
      --primary: #2c3e50;
      --primary-light: #34495e;
      --accent: #3498db;
      --accent-hover: #2980b9;
      --text-light: #ffffff;
      --text-dark: #333333;
      --bg-light: #f8f9fa;
      --border-color: #dddddd;
      --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      --shadow-hover: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background-color: var(--bg-light);
      margin: 0;
      padding: 0;
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

    /* Style for form container */
    .main-content {
      padding: 40px 20px;
      max-width: 800px;
      margin: auto;
      background-color: var(--bg-light);
    }

    .form-wrapper {
      background-color: #fff;
      padding: 35px;
      border-radius: 8px;
      border: 1px solid var(--border-color);
      box-shadow: var(--shadow);
    }

    .form-wrapper:hover {
      box-shadow: var(--shadow-hover);
    }

    .form-wrapper h2 {
      text-align: center;
      color: var(--primary);
      border-bottom: 2px solid var(--accent);
      padding-bottom: 15px;
      margin-bottom: 30px;
    }

    .form-label {
      font-weight: 600;
      color: var(--text-dark);
    }

    .form-control {
      border-radius: 4px;
      padding: 10px;
      border: 1px solid var(--border-color);
    }

    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    button[type="submit"] {
      width: 100%;
      background-color: var(--accent);
      color: #fff;
      font-weight: 600;
      border: none;
      padding: 12px;
      border-radius: 4px;
      transition: background 0.3s ease;
      margin-top: 20px;
    }

    button[type="submit"]:hover {
      background-color: var(--accent-hover);
    }

    @media (max-width: 768px) {
      .navbar .navbar-brand {
        font-size: 1.5rem;
      }
      .form-wrapper {
        padding: 25px 20px;
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

  <!-- Form Container -->
  <div class="main-content">
    <div class="form-wrapper">
      <h2>Update Produk</h2>
      <form action="proses_update_produk.php" method="post">
        <label for="namaProduk" class="form-label">Pilih Produk:</label>
        <select id="namaProduk" name="namaProduk" class="form-control" required>
          <?php
          $conn = new mysqli("localhost", "root", "", "kasir");
          if ($conn->connect_error) {
              die("Koneksi gagal: " . $conn->connect_error);
          }

          $sql = "SELECT NamaProduk, Harga FROM Produk";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row["NamaProduk"] . "' data-harga='" . $row["Harga"] . "'>" . $row["NamaProduk"] . " (Rp " . number_format($row["Harga"], 2, ',', '.') . ")</option>";
              }
          } else {
              echo "<option value=''>Tidak ada produk</option>";
          }

          $conn->close();
          ?>
        </select>

        <label for="harga" class="form-label">Harga Baru:</label>
        <input type="number" id="harga" name="harga" step="0.01" class="form-control" required>

        <label for="stok" class="form-label">Jumlah Stok Ditambahkan:</label>
        <input type="number" id="stok" name="stok" class="form-control" required>

        <button type="submit">Update Produk</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('namaProduk').addEventListener('change', function () {
      var selected = this.options[this.selectedIndex];
      var harga = selected.getAttribute('data-harga');
      document.getElementById('harga').value = harga;
    });

    window.onload = function () {
      const select = document.getElementById('namaProduk');
      if (select.selectedIndex !== -1) {
        const selected = select.options[select.selectedIndex];
        document.getElementById('harga').value = selected.getAttribute('data-harga');
      }
    };
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
