<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="penjualan_tp7";

$conn = mysqli_connect($servername, $username, $password,$db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_query($conn, "INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P01','Irfan','L','081200000001','Jl. Anggrek No. 1'),
('P02','Rina','P','081200000002','Jl. Mawar No. 2'),
('P03','Budi','L','081200000003','Jl. Melati No. 3'),
('P04','Siti','P','081200000004','Jl. Kamboja No. 4'),
('P05','Eko','L','081200000005','Jl. Kenanga No. 5'),
('P06','Dewi','P','081200000006','Jl. Cempaka No. 6'),
('P07','Hari','L','081200000007','Jl. Dahlia No. 7'),
('P08','Nina','P','081200000008','Jl. Edelweis No. 8')
");

mysqli_query($conn, "INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT. Sumber Berkah','021111222','Jakarta'),
(2, 'CV. Maju Jaya','021333444','Surabaya'),
(3, 'PT. Agro Lestari','022555666','Bandung'),
(4, 'UD. Sumber Makmur','0231777888','Yogyakarta'),
(5, 'CV. Sentosa Abadi','024999000','Semarang')
");

mysqli_query($conn, "INSERT INTO barang(kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001','Beras Premium',100000,50,1),
('BRG002','Minyak Goreng',30000,200,2),
('BRG003','Gula Pasir',15000,150,1),
('BRG004','Tepung Terigu',12000,100,2),
('BRG005','Telur Ayam',25000,200,3),
('BRG006','Daging Sapi',120000,20,4),
('BRG007','Susu Cair',15000,50,5),
('BRG008','Kopi Bubuk',35000,80,3),
('BRG009','Gula Merah',20000,60,2),
('BRG010','Tepung Maizena',18000,70,5)
");

mysqli_query($conn, "INSERT INTO transaksi(id, waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES
(1, '2023-11-08', 'Self pickup', 16000000, 'P01', 1),
(2, '2023-11-08', 'Self pickup', 15000000, 'P02', 1),
(3, '2023-11-08', 'Delivery Order', 3000000, 'P03', 1),
(4, '2023-11-09', 'Delivery Order', 24000000, 'P04', 1),
(5, '2023-11-09', 'Self pickup', 21000000, 'P05', 1),
(6, '2023-11-09', 'Self pickup', 20000000, 'P06', 1),
(7, '2023-11-10', 'Self pickup', 600000, 'P07', 1),
(8, '2023-11-10', 'Self pickup', 1200000, 'P08', 1)
");


echo "Semua data master dan transaksi (sesuai gambar) berhasil dimasukkan.";

mysqli_close($conn);
?>