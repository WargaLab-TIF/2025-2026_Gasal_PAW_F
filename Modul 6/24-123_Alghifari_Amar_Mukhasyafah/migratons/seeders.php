<?php

$servername = "localhost";
$username = "root";
$password = "";

function generateRandomString($length = 20) {
    // Generate cryptographically secure random bytes
    $bytes = random_bytes(ceil($length / 2)); 
    
    // Convert the random bytes to a hexadecimal string
    $hexString = bin2hex($bytes);
    
    // Return the desired length of the string
    return substr($hexString, 0, $length);
}

$id1 = generateRandomString(20);
$id2 = generateRandomString(20);

$conn = mysqli_connect($servername, $username, $password, "penjualan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// --- Seeder data user (kasir/admin) ---
$user_seed = "
INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin', '1234', 'Admin Utama', 'Jl. Merdeka No.1', '081234567890', 1),
('kasir1', '1234', 'Kasir Satu', 'Jl. Sudirman No.2', '089876543210', 2)
ON DUPLICATE KEY UPDATE username=username;
";
mysqli_query($conn, $user_seed);

// --- Seeder data supplier ---
$supplier_seed = "
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Makmur', '0219876543', 'Jakarta'),
('UD Maju Jaya', '0317654321', 'Surabaya')
ON DUPLICATE KEY UPDATE nama=nama;
";
mysqli_query($conn, $supplier_seed);

// --- Seeder data barang ---
$barang_seed = "
INSERT INTO barang (nama_barang, harga, stok, supplier_id) VALUES
('Buku Tulis', 5000, 100, 1),
('Pulpen', 3000, 200, 1),
('Penghapus', 2000, 150, 2),
('Pensil', 2500, 120, 2);
";
mysqli_query($conn, $barang_seed);

// --- Seeder data pelanggan ---
$pelanggan_seed = "
INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('$id1', 'Andi', 'L', '0811111111', 'Jl. Kenanga No.1'),
('$id2', 'Budi', 'L', '0822222222', 'Jl. Melati No.2')
ON DUPLICATE KEY UPDATE id=id;
";
mysqli_query($conn, $pelanggan_seed);

// --- Ambil id_user pertama untuk transaksi ---
$user_id = 1;

// --- Seeder data transaksi (4 untuk tiap pelanggan) ---
$transaksi_seed = "
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES
('2025-11-01', 'Pembelian alat tulis 1', 15000, '$id1', $user_id),
('2025-11-02', 'Pembelian alat tulis 2', 22000, '$id1', $user_id),
('2025-11-03', 'Pembelian alat tulis 3', 10000, '$id1', $user_id),
('2025-11-04', 'Pembelian alat tulis 4', 27000, '$id1', $user_id),

('2025-11-01', 'Pembelian alat tulis 1', 18000, '$id1', $user_id),
('2025-11-02', 'Pembelian alat tulis 2', 12000, '$id1', $user_id),
('2025-11-03', 'Pembelian alat tulis 3', 25000, '$id1', $user_id),
('2025-11-04', 'Pembelian alat tulis 4', 30000, '$id1', $user_id)
ON DUPLICATE KEY UPDATE id=id;
";
mysqli_query($conn, $transaksi_seed);

// --- Seeder transaksi_detail (otomatis ambil id transaksi dan isi detail) ---
$result = mysqli_query($conn, "SELECT id, pelanggan_id FROM transaksi;");
while ($row = mysqli_fetch_assoc($result)) {
    $transaksi_id = $row['id'];

    // pilih barang random
    $barang_id = rand(1, 4);
    $qty = rand(1, 5);
    $harga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id=$barang_id"))['harga'];

    $detail = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
               VALUES ($transaksi_id, $barang_id, $harga, $qty)
               ON DUPLICATE KEY UPDATE transaksi_id=transaksi_id;";
    mysqli_query($conn, $detail);
}

echo "Seeder berhasil dijalankan!";

mysqli_close($conn);
?>
