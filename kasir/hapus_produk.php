<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kasir";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["produk_id"])) {
    $produk_id = intval($_POST["produk_id"]);

    // Hapus data terkait di detailpenjualan dulu
    $conn->query("DELETE FROM detailpenjualan WHERE ProdukID = $produk_id");

    // Hapus dari tabel Produk
    $sql = "DELETE FROM Produk WHERE ProdukID = $produk_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: tampil_produk.php?status=deleted");
        exit();
    } else {
        echo "Gagal menghapus produk: " . $conn->error;
    }
} else {
    echo "Permintaan tidak valid.";
}



$conn->close();
?>

