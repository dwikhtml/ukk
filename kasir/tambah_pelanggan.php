<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Pelanggan - Sistem Kasir</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    /* Base Styles */
    :root {
      --primary: #2c3e50;
      --primary-light: #34495e;
      --primary-dark: #1a252f;
      --accent: #3498db;
      --accent-hover: #2980b9;
      --success: #16a085;
      --text-light: #ffffff;
      --text-dark: #333333;
      --bg-light: #f8f9fa;
      --border-color: #dddddd;
      --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      --shadow-hover: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: var(--bg-light);
      color: var(--text-dark);
      line-height: 1.6;
    }

    /* Navbar Styles */
    .navbar {
      background-color: var(--primary);
      padding: 12px 24px;
      box-shadow: var(--shadow);
    }

    .navbar .navbar-brand {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--text-light);
      margin-right: 40px;
      transition: color 0.2s ease;
    }

    .navbar .navbar-brand:hover {
      color: var(--accent);
    }

    .navbar-toggler {
      border-color: rgba(255, 255, 255, 0.5);
    }

    .navbar-toggler:focus {
      box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .navbar-nav .nav-link {
      color: var(--text-light);
      font-size: 1.05rem;
      margin-right: 20px;
      padding: 8px 16px;
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: var(--text-light);
      background-color: var(--primary-light);
      transform: translateY(-2px);
    }

    .navbar-nav .nav-item.active .nav-link,
    .navbar-nav .nav-link.active {
      font-weight: 600;
      color: var(--text-light);
      background-color: var(--accent);
      box-shadow: var(--shadow);
    }

    .navbar-nav .nav-link.active:hover {
      background-color: var(--accent-hover);
    }

    /* Main Content */
    .main-content {
      padding: 40px 20px;
      min-height: 80vh;
      margin: 0 auto;
      max-width: 1200px;
    }

    /* Form Styles */
    .form-wrapper {
      background-color: var(--text-light);
      padding: 35px;
      border-radius: 8px;
      width: 100%;
      max-width: 700px;
      margin: 0 auto;
      border: 1px solid var(--border-color);
      box-shadow: var(--shadow);
      transition: box-shadow 0.3s ease;
    }

    .form-wrapper:hover {
      box-shadow: var(--shadow-hover);
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
      align-items: flex-start;
      flex-wrap: wrap;
      margin-bottom: 5px;
    }

    .form-row label {
      width: 160px;
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

    textarea.form-control {
      resize: vertical;
      min-height: 100px;
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
      margin-top: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    button[type="submit"]:hover {
      background-color: var(--accent-hover);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    button[type="submit"]:active {
      transform: translateY(0);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php" id="linkDaftarPenjualan">Daftar Penjualan</a></li>
          <li class="nav-item"><a class="nav-link" href="tambah_pelanggan.php" id="linkTambahPelanggan">Tambah Pelanggan</a></li>
          <li class="nav-item"><a class="nav-link" href="input_produk.html" id="linkTambahProduk">Tambah Produk</a></li>
          <li class="nav-item"><a class="nav-link" href="update_produk.php" id="linkUpdateProduk">Update Produk</a></li>
          <li class="nav-item"><a class="nav-link" href="penjualan.php" id="linkFormulirPenjualan">Formulir Penjualan</a></li>
          <li class="nav-item"><a class="nav-link" href="tampil_produk.php" id="linkDaftarProduk">Daftar Produk</a></li>
          <li class="nav-item"><a class="nav-link" href="tampil_pelanggan.php" id="linkDaftarPelanggan">Daftar Pelanggan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="main-content">
    <div class="form-wrapper">
      <h2>Formulir Tambah Pelanggan</h2>
      <form action="proses_tambah_pelanggan.php" method="post">
        <div class="form-row">
          <label for="nama">Nama Pelanggan</label>
          <input type="text" id="nama" name="nama" class="form-control" required />
        </div>
        <div class="form-row">
          <label for="alamat">Alamat</label>
          <textarea id="alamat" name="alamat" rows="3" class="form-control" required></textarea>
        </div>
        <div class="form-row">
          <label for="telepon">Nomor Telepon</label>
          <input type="text" id="telepon" name="telepon" class="form-control" required />
        </div>
        <button type="submit">Simpan Pelanggan</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

  <!-- Active Navbar Script -->
  <script>
    // Mark the active page based on current URL
    document.addEventListener("DOMContentLoaded", function() {
      const currentPath = window.location.pathname;

      if (currentPath.includes("index.php")) {
        document.getElementById("linkDaftarPenjualan").classList.add("active");
      } else if (currentPath.includes("tambah_pelanggan.php")) {
        document.getElementById("linkTambahPelanggan").classList.add("active");
      } else if (currentPath.includes("input_produk.html")) {
        document.getElementById("linkTambahProduk").classList.add("active");
      } else if (currentPath.includes("update_produk.php")) {
        document.getElementById("linkUpdateProduk").classList.add("active");
      } else if (currentPath.includes("penjualan.php")) {
        document.getElementById("linkFormulirPenjualan").classList.add("active");
      } else if (currentPath.includes("tampil_produk.php")) {
        document.getElementById("linkDaftarProduk").classList.add("active");
      } else if (currentPath.includes("tampil_pelanggan.php")) {
        document.getElementById("linkDaftarPelanggan").classList.add("active");
      }
    });
  </script>
</body>
</html>
