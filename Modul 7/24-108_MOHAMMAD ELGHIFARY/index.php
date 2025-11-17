<?php
require_once "conn.php";

$sql="SELECT  
    tr.id,
    tr.waktu_transaksi AS wt,
    p.nama,
    tr.keterangan,
    tr.total
FROM 
    transaksi AS tr
INNER JOIN
    pelanggan AS p ON pelanggan_id=p.id
ORDER BY
    tr.id ASC;";
$no=1;
$result=mysqli_query($conn,$sql);
$penjualan=[];
while($row=mysqli_fetch_assoc($result))
    $penjualan[]=$row;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #343a40;
            padding: 20px 20px;
            color: white;
        }

        .navbar-brand {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-nav li {
            margin-left: 20px;
        }

        .navbar-nav a {
            color: #f8f9fa;
            text-decoration: none;
            font-size: 14px;
        }
        .navbar-nav a:hover {
            color: white;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 30px;
        }

        .header-container {
            display: flex;
            justify-content: right;
            align-items: center;
            margin-bottom: 20px;
        }

        .container h2 {
            font-size: 20px;
            font-weight: bold;
            background: #0275d8;
            padding: 20px 20px;
            color: white;
            border-radius: 6px;
            margin-bottom:20px;
            
        }

        .button-group a {
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            color: white;
            text-decoration: none;
            margin-left: 10px;
        }

        .btn-laporan {
            background: #0275d8
        }
        .btn-laporan:hover {
            background: #025aa5;
        }

        .btn-tambah {
            background: #5cb85c;
        }
        .btn-tambah:hover {
            background: #4a934a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white; 
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        th {
            background: #e9ecef;
            color: #212529;
            text-align: left;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e3e3e3;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .btn-detail, .btn-hapus {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            color: white;
        }

        .btn-detail {
            background: #17a2b8;
        }

        .btn-hapus {
            background: #dc3545;
        }

        .btn-detail:hover {
            background: #138496;
        }

        .btn-hapus:hover {
            background: #c82333;
        }

        .form_action {
            display: flex;
            gap: 6px;
        }
    </style>
</head>
<body>
    <div class="top-navbar">
        <div class="navbar-brand">
            Penjualan / Elghi
        </div>
        <ul class="navbar-nav">
            <li><a href="#">Supplier</a></li>
            <li><a href="#">Barang</a></li>
            <li><a href="#">Transaksi</a></li>
        </ul>
    </div>

    <div class="container">
        <h2>Data Master Transaksi</h2>
        <div class="header-container">
            <div class="button-group">
                <a href="report_transaksi.php" class="btn-laporan">Lihat Laporan Penjualan</a>
                <a href="form_transaksi.php" class="btn-tambah">Tambah Transaksi</a>
            </div>
        </div>

        <table border="0" cellpadding="8" cellspacing="0">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>
            <?php foreach ($penjualan as $row): ?>
            <tr>
                <?php
                    echo "<td>$no</td>";
                    $no+=1;
                ?>
                <td><?= $row['id'] ?></td>
                <td><?= $row['wt'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td><?= "Rp" . number_format($row['total'], 0, ',', '.') ?></td>
                <td class="form_action">
                    <form class="detail" action="detail_transaksi.php" method="get">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="btn-detail" type="submit">Lihat Detail</button>
                    </form>
                    <form action="hapus.php" method="get" onsubmit="return confirm('Anda yakin akan menghapus transaksi ini?')">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="btn-hapus" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>