<?php

include "../koneksi.php"; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_transaksi = (int)$_GET['id'];
} else {
    
    header("Location: transaksi.php");
    exit;
}

$q_transaksi = mysqli_query($conn, "SELECT * FROM transaksi WHERE id= '$id_transaksi'");

if (mysqli_num_rows($q_transaksi) === 0) {
    echo "<h1>Data Transaksi tidak ditemukan.</h1>";
    exit;
}
$transaksi = mysqli_fetch_assoc($q_transaksi);



$q_items = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id = '$id_transaksi'");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi #<?= $id_transaksi ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        .container { 
            background: white; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        h2 { color: #0056A6; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .detail-group p { margin: 5px 0; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
        }
        .total-info { 
            font-size: 1.2em; 
            font-weight: bold; 
            text-align: right; 
            margin-top: 15px; 
        }
        .btn-back {
            display: inline-block;
            padding: 10px 15px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
        .btn-nota {
            display: inline-block;
            padding: 10px 15px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2> Detail Transaksi #<?= $transaksi['id'] ?></h2>
    
    <div class="detail-group">
        <p><strong>Tanggal Transaksi:</strong> <?= date('d-m-Y H:i:s', strtotime($transaksi['waktu_transaksi'])) ?></p>
        <p><strong>Nama Pelanggan:</strong> <?= $transaksi['pelanggan_id'] ?></p>
        <p><strong>Keterangan:</strong> <?= $transaksi['keterangan'] ?></p>
    </div>

    <hr>
    
    <h3>Barang yang Dibeli</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th style="text-align: right;">Harga Satuan</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($item = mysqli_fetch_assoc($q_items)) { 
                $subtotal_item = $item['harga'] * $item['qty']; 
            ?>
            <tr>
                <td><?= htmlspecialchars($item['barang_id']) ?></td>
                <td style="text-align: right;">Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                <td style="text-align: center;"><?= number_format($item['qty'], 0, ',', '.') ?></td>
                <td style="text-align: right;">Rp<?= number_format($subtotal_item, 0, ',', '.') ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="total-info">
        Total Transaksi: Rp<?= number_format($transaksi['total'], 0, ',', '.') ?>
    </div>
    
    <a href="transaksi.php" class="btn-back">Kembali ke Daftar Transaksi</a>
    <a href="cetak_nota.php?id=<?= $id_transaksi ?>" class="btn btn-nota mt-3" target="_blank">Cetak Nota</a>

</div>

</body>
</html>