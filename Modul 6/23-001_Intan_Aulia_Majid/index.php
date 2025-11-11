<?php
include "koneksi.php";

$sql = "SELECT b.id, b.kode_barang, b.harga, b.nama_barang, b.stok, b.supplier_id, s.nama 
        FROM barang AS b, supplier AS s 
        WHERE b.supplier_id = s.id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sqlTransaksi = "SELECT 
                    t.id AS ID,
                    t.waktu_transaksi AS `Waktu Transaksi`,
                    t.keterangan AS `Keterangan`,
                    t.total AS `Total`,
                    p.nama AS `Nama Pelanggan`
                FROM 
                    transaksi t
                JOIN 
                    pelanggan p 
                ON
                    t.pelanggan_id = p.id
                ORDER BY
                    t.waktu_transaksi ASC;";

$resultTransaksi = mysqli_query($conn, $sqlTransaksi);
$dataTransaksi = mysqli_fetch_all($resultTransaksi, MYSQLI_ASSOC);


$sqlDetail = "SELECT  td.transaksi_id, b.nama_barang, td.harga, td.qty FROM transaksi_detail td JOIN barang b ON td.barang_id = b.id ORDER BY td.transaksi_id ASC";

$resultDetail = mysqli_query($conn, $sqlDetail);
$dataDetail = mysqli_fetch_all($resultDetail, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-10 px-4">

    <div class="w-full max-w-5xl mb-6 flex space-x-4">
        <a href="tambahTransaksi.php" class="bg-blue-600 text-white py-2 px-5 rounded-lg shadow font-medium hover:bg-blue-700 transition duration-200">
            + Tambah Transaksi
        </a>
        <a href="tambahDetailTransaksi.php" class="bg-green-600 text-white py-2 px-5 rounded-lg shadow font-medium hover:bg-green-700 transition duration-200">
            + Tambah Detail
        </a>
    </div>

    <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Daftar Barang</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Kode Barang</th>
                        <th class="py-3 px-4 text-left">Nama Barang</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                        <th class="py-3 px-4 text-left">Stok</th>
                        <th class="py-3 px-4 text-left">Nama Supplier</th>
                        <th class="py-3 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach($data as $row): ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="py-3 px-4"><?= $row['id'] ?></td>
                            <td class="py-3 px-4 font-medium text-gray-700"><?= $row['kode_barang'] ?></td>
                            <td class="py-3 px-4"><?= $row['nama_barang'] ?></td>
                            <td class="py-3 px-4">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td class="py-3 px-4"><?= $row['stok'] ?></td>
                            <td class="py-3 px-4"><?= $row['nama'] ?></td>
                            <td class="py-3 px-4 text-center">
                                <a href="hapusBarang.php?id=<?= $row['id'] ?>" 
                                   onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                   class="text-red-600 hover:text-red-800 font-semibold transition">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg p-6 mt-8">
        <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Transaksi</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Waktu Transaksi</th>
                        <th class="py-3 px-4 text-left">Keterangan</th>
                        <th class="py-3 px-4 text-left">Total</th>
                        <th class="py-3 px-4 text-left">Nama Pelanggan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach($dataTransaksi as $row): ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="py-3 px-4"><?= $row['ID'] ?></td>
                            <td class="py-3 px-4"><?= date('d M Y, H:i', strtotime($row['Waktu Transaksi'])) ?></td>
                            <td class="py-3 px-4"><?= $row['Keterangan'] ?></td>
                            <td class="py-3 px-4">Rp <?= number_format($row['Total'], 0, ',', '.') ?></td>
                            <td class="py-3 px-4"><?= $row['Nama Pelanggan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg p-6 mt-8">
        <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Transaksi Detail</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Transaksi ID</th>
                        <th class="py-3 px-4 text-left">Nama Barang</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                        <th class="py-3 px-4 text-left">Qty</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach($dataDetail as $row): ?>
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="py-3 px-4"><?= $row['transaksi_id'] ?></td>
                            <td class="py-3 px-4"><?= $row['nama_barang'] ?></td>
                            <td class="py-3 px-4">Rp <?= number_format($row['harga'],0,',','.') ?></td>
                            <td class="py-3 px-4"><?= $row['qty'] ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>