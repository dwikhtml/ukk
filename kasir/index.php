<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Penjualan - Sistem Kasir</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- jsPDF & AutoTable -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

  <style>
    :root {
      --primary: #2c3e50;
      --primary-light: #34495e;
      --accent: #3498db;
      --accent-hover: #2980b9;
      --success: #16a085;
      --text-light: #ffffff;
      --text-dark: #333333;
      --bg-light: #f8f9fa;
      --border-color: #dddddd;
      --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--bg-light);
      margin: 0;
      padding: 0;
      color: var(--text-dark);
    }

    /* Navbar */
    .navbar {
      background-color: var(--primary);
      padding: 12px 24px;
      box-shadow: var(--shadow);
    }

    .navbar-brand {
      color: var(--text-light);
      font-size: 1.8rem;
      font-weight: 700;
    }

    .navbar-nav .nav-link {
      color: var(--text-light);
      font-weight: 500;
      margin-right: 16px;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link:hover {
      background-color: var(--accent);
      border-radius: 5px;
      color: #fff;
    }

    /* Container */
    .main-content {
      padding: 40px 20px;
      max-width: 1200px;
      margin: auto;
    }

    h1 {
      text-align: center;
      font-size: 1.8rem;
      color: var(--primary);
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--accent);
    }

    .table-wrapper {
      background: white;
      padding: 25px;
      border-radius: 8px;
      box-shadow: var(--shadow);
      border: 1px solid var(--border-color);
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th {
      background-color: #f8f9fa;
      font-weight: 600;
      color: var(--primary);
      padding: 12px 15px;
      border-bottom: 2px solid #ddd;
      text-align: left;
    }

    td {
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
    }

    tr:hover td {
      background-color: #f8f9fa;
    }

    .total td {
      font-weight: bold;
      border-top: 2px solid #ddd;
      padding-top: 15px;
    }

    .btn-print {
      margin-top: 20px;
      display: inline-block;
      background-color: var(--accent);
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-print:hover {
      background-color: var(--accent-hover);
    }

    @media (max-width: 768px) {
      h1 {
        font-size: 1.5rem;
      }

      .table-wrapper {
        padding: 15px;
      }

      .btn-print {
        width: 100%;
        text-align: center;
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
          <li class="nav-item"><a class="nav-link active" href="index.php" id="linkDaftarPenjualan">Daftar Penjualan</a></li>
          <li class="nav-item"><a class="nav-link" href="tambah_pelanggan.php">Tambah Pelanggan</a></li>
          <li class="nav-item"><a class="nav-link" href="input_produk.html">Tambah Produk</a></li>
          <li class="nav-item"><a class="nav-link" href="update_produk.php">Update Produk</a></li>
          <li class="nav-item"><a class="nav-link" href="penjualan.php">Formulir Penjualan</a></li>
          <li class="nav-item"><a class="nav-link" href="tampil_produk.php">Daftar Produk</a></li>
          <li class="nav-item"><a class="nav-link" href="tampil_pelanggan.php">Daftar Pelanggan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="main-content">
    <h1>Daftar Penjualan</h1>

    <div class="table-wrapper">
      <table id="tabelPenjualan">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $conn = new mysqli("localhost", "root", "", "kasir");
          if ($conn->connect_error) {
              die("Koneksi gagal: " . $conn->connect_error);
          }

          $sql = "
              SELECT 
                  p.PenjualanID,
                  p.TanggalPenjualan,
                  pl.NamaPelanggan,
                  pr.NamaProduk,
                  dp.JumlahProduk,
                  dp.Subtotal
              FROM 
                  Penjualan p
              JOIN 
                  Pelanggan pl ON p.PelangganID = pl.PelangganID
              JOIN 
                  DetailPenjualan dp ON p.PenjualanID = dp.PenjualanID
              JOIN 
                  Produk pr ON dp.ProdukID = pr.ProdukID
              ORDER BY 
                  p.TanggalPenjualan DESC
          ";
          $result = $conn->query($sql);
          $totalSubtotal = 0;
          if ($result->num_rows > 0) {
              $no = 1;
              while($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>" . $no++ . "</td>
                          <td>" . $row["TanggalPenjualan"] . "</td>
                          <td>" . $row["NamaPelanggan"] . "</td>
                          <td>" . $row["NamaProduk"] . "</td>
                          <td>" . $row["JumlahProduk"] . "</td>
                          <td>Rp " . number_format($row["Subtotal"], 2, ',', '.') . "</td>
                        </tr>";
                  $totalSubtotal += $row["Subtotal"];
              }
          } else {
              echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data penjualan.</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
        <tfoot>
          <tr class="total">
            <td colspan="5" style="text-align: right;">Total Subtotal:</td>
            <td>Rp <?php echo number_format($totalSubtotal, 2, ',', '.'); ?></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <a href="#" onclick="cetakPDF()" class="btn-print">Cetak PDF</a>
  </div>

  <!-- jsPDF Script -->
  <script>
    function cetakPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF('p', 'mm', 'a4');
      doc.setFontSize(18);
      doc.text("Laporan Penjualan", 14, 20);

      const table = document.getElementById("tabelPenjualan");
      const rows = table.querySelectorAll("tbody tr");
      const data = [];

      rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        const rowData = [];
        cells.forEach(cell => rowData.push(cell.innerText));
        data.push(rowData);
      });

      const headers = [];
      table.querySelectorAll("thead th").forEach(th => headers.push(th.innerText));

      doc.autoTable({
        head: [headers],
        body: data,
        startY: 30,
        theme: 'grid',
        styles: { fontSize: 10, halign: 'center' },
      });

      doc.save("laporan_penjualan.pdf");
    }
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
