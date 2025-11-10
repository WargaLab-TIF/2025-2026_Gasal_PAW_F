<?php
include "koneksi.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $cek = mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi_detail WHERE barang_id = '$id'");
    $data = mysqli_fetch_assoc($cek);

    if ($data['total'] > 0) {
        echo "<script>
            alert('Barang tidak bisa dihapus karena sudah digunakan dalam transaksi!');
            window.location.href = 'index.php';
        </script>";
        exit;
    } else {
        $hapus = mysqli_query($conn, "DELETE FROM barang WHERE id='$id'");
        if ($hapus) {
            echo "<script>
                alert('Barang berhasil dihapus.');
                window.location.href = 'index.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Gagal menghapus barang: " . mysqli_error($conn) . "');
                window.location.href = 'index.php';
            </script>";
            exit;
        }
    }
}

$barang = mysqli_query($conn, "SELECT * FROM barang");
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
$transaksi_detail = mysqli_query($conn, "SELECT * FROM transaksi_detail");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Master Detail</title>
</head>

<style>
    body {
        background: #eef3f7;
        margin: 3%;
        font-family: Arial, sans-serif;
    }

    .layout {
        padding: 25px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h1, h2 {
        text-align: center;
        color: #333;
        margin-bottom: 10px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 40px;
    }

    table th {
        background: #ff6600ff;
        color: white;
        padding: 10px;
        text-align: center;
    }

    table td {
        padding: 10px;
        border: 1px solid #dddddda5;
        text-align: center;
    }

    a.btn {
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 14px;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #b91d2b;
    }

    .btn-add {
        background: #28a745;
        color: white;
        margin-right: 10px;
    }

    .btn-add:hover {
        background: #218838;
    }
</style>

<body>
    <div class="layout">
        <h1>Pengelolaan Master Detail</h1>

        <h2>Barang</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Nama Supplier</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($barang)) {
                $supplier_id = $row['supplier_id'];
                $supplier = mysqli_query($conn, "SELECT nama FROM supplier WHERE id='$supplier_id'");
                $data_supplier = mysqli_fetch_assoc($supplier);
                $nama_supplier = $data_supplier ? $data_supplier['nama'] : '-';
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['kode_barang'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= $nama_supplier ?></td>
                <td>
                    <a class="btn btn-delete" href="index.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus <?= $row['nama_barang'] ?>?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <h2>Transaksi</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Nama Pelanggan</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($transaksi)) {
                $pelanggan_id = $row['pelanggan_id'];
                $pelanggan = mysqli_query($conn, "SELECT nama FROM pelanggan WHERE id='$pelanggan_id'");
                $data_pelanggan = mysqli_fetch_assoc($pelanggan);
                $nama_pelanggan = $data_pelanggan ? $data_pelanggan['nama'] : '-';
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['waktu_transaksi'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td><?= $row['total'] ?></td>
                <td><?= $nama_pelanggan ?></td>
            </tr>
            <?php } ?>
        </table>

        <h2>Transaksi Detail</h2>
        <table>
            <tr>
                <th>Transaksi ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($transaksi_detail)) {
                $barang_id = $row['barang_id'];
                $barang_nama = mysqli_query($conn, "SELECT nama_barang FROM barang WHERE id='$barang_id'");
                $data_barang = mysqli_fetch_assoc($barang_nama);
                $nama_barang = $data_barang ? $data_barang['nama_barang'] : '-';
            ?>
            <tr>
                <td><?= $row['transaksi_id'] ?></td>
                <td><?= $nama_barang ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['qty'] ?></td>
            </tr>
            <?php } ?>
        </table>

        <a class="btn btn-add" href="tambah_detail.php">Tambah Transaksi</a>
        <a class="btn btn-add" href="transaksi_detail.php">Tambah Transaksi Detail</a>

    </div>
</body>

</html>
