<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "penjualan_tp8";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error() . "\n");
}

echo "Koneksi ke MySQL Server berhasil.\n";

$delete_database = "DROP DATABASE IF EXISTS $database";
$create_database = "CREATE DATABASE IF NOT EXISTS $database;";

if (mysqli_query($conn, $delete_database) && mysqli_query($conn, $create_database)) {
    echo "Database '$database' berhasil dihapus dan dibuat ulang.\n";
} else {
    die("Gagal memproses database: " . mysqli_error($conn) . "\n");
}


mysqli_select_db($conn, $database);

$pelanggan = "CREATE TABLE IF NOT EXISTS pelanggan (
    id INT PRIMARY KEY AUTO_INCREMENT, 
    nama VARCHAR(20) NOT NULL,
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);";

$user = "CREATE TABLE IF NOT EXISTS user (
    id_user TINYINT(2) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150) NOT NULL,
    hp VARCHAR(20) NOT NULL,
    level TINYINT(1)
);";

$supplier = "CREATE TABLE IF NOT EXISTS supplier (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12) NOT NULL,
    alamat TEXT
);";

$barang = "CREATE TABLE IF NOT EXISTS barang (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT NOT NULL,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) 
);";

$transaksi = "CREATE TABLE IF NOT EXISTS transaksi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT NOT NULL, 
    total INT NOT NULL,
    pelanggan_id INT NOT NULL, 
    user_id TINYINT(2) NOT NULL,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id),
    FOREIGN KEY (user_id) REFERENCES user(id_user)
);";

$pembayaran = "CREATE TABLE IF NOT EXISTS pembayaran (
    id INT PRIMARY KEY AUTO_INCREMENT,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT NOT NULL UNIQUE,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);";

$transaksi_detail = "CREATE TABLE IF NOT EXISTS transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
    FOREIGN KEY (barang_id) REFERENCES barang(id)
);";

$insert_pelanggan = "INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) VALUES 
('Ahmad', 'L', '081112233445', 'Jl. Kenari No. 12'), 
('Bunga', 'P', '082233445566', 'Perum Asri Blok A1'), 
('Candra', 'L', '085778899001', 'Kp. Damai RT02'), 
('Dina', 'P', '087889900112', 'Gg. Sejahtera 5'), 
('Eko', 'L', '081334455667', 'Taman Kencana Raya'), 
('Fani', 'P', '081556677889', 'Jl. Mawar No. 3A'), 
('Gilang', 'L', '089667788990', 'Komplek Elang'), 
('Hana', 'P', '081110099887', 'Ruko Hijau No. 8'), 
('Indra', 'L', '085223344556', 'Jl. Pendidikan 4'), 
('Juli', 'P', '082110022003', 'Perumahan Griya Baru');";

$insert_supplier = "INSERT INTO supplier (nama, telp, alamat) VALUES 
('PT Sejahtera Abadi', '0211234567', 'Kawasan Industri A No. 1'), 
('CV Maju Mundur', '0229876543', 'Jl. Produksi No. 5'), 
('Toko Global Bahan', '0312345678', 'Komplek Pergudangan C'), 
('Distributor Cepat', '081212121212', 'Jl. Raya Utama KM 10'), 
('UD Rukun Sentosa', '085566778899', 'Pasar Induk Blok D'), 
('PT Pangan Nusantara', '0217654321', 'Gedung Biru Lantai 3'), 
('Sumber Jaya Elektronik', '0223456789', 'Jl. Teknologi No. 15'), 
('Mitra Alat Kantor', '0319876543', 'Ruko Hijau No. 20'), 
('Distributor Otomotif', '081122334455', 'Pergudangan Sentra'), 
('CV Kreatif Media', '085700998877', 'Jl. Inovasi No. 7');";

$insert_user = "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES 
('pemilik_utama', MD5('passowner1'), 'Bambang Pemilik', 'Kantor Pusat', '081211223344', 1), 
('kasir_siti', MD5('siti456'), 'Siti Kasir', 'Toko Cabang A', '081300112233', 2),   
('kasir_dika', MD5('dika789'), 'Dika Kasir', 'Toko Utama', '085600112233', 2),     
('kasir_eka', MD5('eka000'), 'Eka Kasir', 'Cabang B', '087711223344', 2),       
('kasir_fitri', MD5('fitri111'), 'Fitri Kasir', 'Toko Cabang C', '082100998877', 2), 
('kasir_galih', MD5('galih222'), 'Galih Kasir', 'Gudang Utama', '089555443322', 2),  
('kasir_hana', MD5('hana333'), 'Hana Kasir', 'Kantor Pusat', '081133445566', 2),
('kasir_irfan', MD5('irfan444'), 'Irfan Kasir', 'Gudang Logistik', '081299887766', 2),
('kasir_jihan', MD5('jihan555'), 'Jihan Kasir', 'Toko Cabang D', '085733445566', 2),
('kasir_kevin', MD5('kevin666'), 'Kevin Kasir', 'Gudang Stok', '081377889900', 2);";

$insert_barang = "INSERT INTO barang (nama_barang, harga, stok, supplier_id) VALUES 
('Laptop Seri X', 7500000, 50, 7), 
('Pulpen Pilot', 3500, 200, 8), 
('Mie Instan Premium', 2500, 500, 6), 
('Sabun Cuci 1L', 22000, 150, 4), 
('Mouse Gaming', 150000, 100, 7), 
('Kertas A4 80gr', 45000, 80, 8), 
('Kopi Sachet 3-in-1', 1500, 800, 6), 
('Gula Tebu 1Kg', 13000, 250, 5), 
('Oli Mesin Matic', 65000, 30, 9), 
('Keyboard Standard', 120000, 40, 7);";

$insert_transaksi = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES 
('2025-11-20', 'Pembelian Laptop Kantor', 7500000, 1, 2),
('2025-11-20', 'Belanja Harian', 125000, 2, 5), 
('2025-11-21', 'Stok Alat Tulis', 50000, 3, 3), 
('2025-11-21', 'Kebutuhan Dapur', 85000, 4, 9), 
('2025-11-22', 'Beli Kopi Instan', 15000, 5, 4), 
('2025-11-22', 'Beli Sabun Cuci', 44000, 6, 7), 
('2025-11-23', 'Pembelian Rutin', 35000, 7, 3), 
('2025-11-23', 'Pembelian Besar', 950000, 8, 5), 
('2025-11-24', 'Beli Pulpen', 60000, 9, 9), 
('2025-11-24', 'Beli Kertas', 150000, 10, 2);";

$insert_pembayaran = "INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES 
('2025-11-20 09:00:00', 7500000, 'TRANSFER', 1), 
('2025-11-20 10:30:00', 125000, 'TUNAI', 2), 
('2025-11-21 11:00:00', 50000, 'TUNAI', 3), 
('2025-11-21 13:45:00', 85000, 'EDC', 4), 
('2025-11-22 14:00:00', 15000, 'TUNAI', 5), 
('2025-11-22 15:30:00', 44000, 'EDC', 6), 
('2025-11-23 16:00:00', 35000, 'TUNAI', 7), 
('2025-11-23 17:15:00', 950000, 'TRANSFER', 8), 
('2025-11-24 08:30:00', 60000, 'TUNAI', 9), 
('2025-11-24 10:00:00', 150000, 'TRANSFER', 10);";

$insert_transaksi_detail = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES 
(1, 1, 7500000, 1), 
(2, 4, 22000, 2), (2, 8, 13000, 6), 
(3, 2, 3500, 10), 
(4, 3, 2500, 10), (4, 7, 1500, 40), 
(5, 7, 1500, 10), 
(6, 4, 22000, 2), 
(7, 3, 2500, 4), (7, 8, 13000, 2),
(8, 5, 150000, 1), (8, 10, 120000, 5),
(9, 2, 3500, 17),
(10, 6, 45000, 3);";

$query_list = [
    $supplier, $user, $pelanggan, $barang, $transaksi, $pembayaran, $transaksi_detail,
    
    $insert_supplier,
    $insert_user,
    $insert_pelanggan,
    $insert_barang,
    $insert_transaksi,
    $insert_pembayaran,
    $insert_transaksi_detail
];

foreach ($query_list as $query) {
    if (mysqli_query($conn, $query)) {
        if (strpos(trim($query), 'CREATE TABLE') === 0) {
            echo "Tabel berhasil dibuat.\n";
        } elseif (strpos(trim($query), 'INSERT INTO') === 0) {
            echo "Data decoy berhasil disisipkan.\n";
        }
    } else {
        echo "Gagal mengeksekusi query: " . mysqli_error($conn) . "\n";
    }
}

mysqli_close($conn);
echo "Koneksi ditutup.\n";

?>