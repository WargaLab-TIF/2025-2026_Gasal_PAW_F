<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "penjualan_tp6";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql_barang = "
    SELECT 
        barang.id, 
        barang.kode_barang, 
        barang.nama_barang, 
        barang.harga,
        supplier.nama
    FROM 
        barang
    LEFT JOIN 
        supplier ON barang.supplier_id = supplier.id
    ORDER BY 
        barang.id ASC
";
$query_barang = mysqli_query($conn, $sql_barang);
$list_barang = mysqli_fetch_all($query_barang, MYSQLI_ASSOC);

$sql_cek_detail = "SELECT DISTINCT barang_id FROM transaksi_detail";
$query_cek_detail = mysqli_query($conn, $sql_cek_detail);
$list_barang_terpakai = mysqli_fetch_all($query_cek_detail, MYSQLI_ASSOC);
$ids_barang_terpakai = array_column($list_barang_terpakai, 'barang_id');

$sql_transaksi = "
    SELECT 
        transaksi.id, 
        transaksi.waktu_transaksi, 
        transaksi.keterangan, 
        transaksi.total,
        pelanggan.nama
    FROM 
        transaksi
    LEFT JOIN 
        pelanggan ON transaksi.pelanggan_id = pelanggan.id
    ORDER BY 
        transaksi.id ASC
";
$query_transaksi = mysqli_query($conn, $sql_transaksi);
$list_transaksi = mysqli_fetch_all($query_transaksi, MYSQLI_ASSOC);

$sql_transaksi_detail = "
    SELECT 
        transaksi_detail.transaksi_id, 
        barang.nama_barang, 
        transaksi_detail.harga, 
        transaksi_detail.qty
    FROM 
        transaksi_detail
    LEFT JOIN 
        barang ON transaksi_detail.barang_id = barang.id
    ORDER BY 
        transaksi_detail.transaksi_id ASC
";
$query_transaksi_detail = mysqli_query($conn, $sql_transaksi_detail);
$list_transaksi_detail = mysqli_fetch_all($query_transaksi_detail, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 20px;
            color: #333;
        }
        
        h2 {
            color: #005a9c;
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
        }

        .transaksi {
            display: flex;
            gap: 20px;
        }

        .t1, .t2 {
            flex: 1;
        }
        .buttonWrapper {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .tambah, .hapus {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .tambah {
            background-color: #28a745;
        }
        .tambah:hover {
            background-color: #218838;
        }

        .hapus {
            background-color: #dc3545; 
            width: 100%; 
        }
        .hapus:hover {
            background-color: #c82333;
        }
        td form {
            margin: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>Barang</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>id</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Nama Supplier</th>
            <th>Action</th>
        </tr>
        <?php foreach ($list_barang as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['kode_barang'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['harga'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td>
                <?php
                $is_used = in_array($row['id'], $ids_barang_terpakai);
                $onsubmit_script = "";
                if ($is_used) {
                    $onsubmit_script = "alert('Barang ini TIDAK BISA dihapus karena sudah digunakan dalam transaksi.'); return false;";
                } else {
                    $onsubmit_script = "return confirm('Anda yakin akan menghapus barang ini?');";
                }
                ?>
                
                <form action="hapus.php" method="get" onsubmit="<?= $onsubmit_script ?>">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button class="hapus" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="transaksi">
        <div class="t1">
            <h2>Transaksi</h2>
            <table border="1" cellpadding="8" cellspacing="0">
                <tr>
                    <th>id</th>
                    <th>Waktu_transaksi</th>
                    <th>keterangan</th>
                    <th>Total</th>
                    <th>Nama Pelanggan</th>
                </tr>
                <?php foreach ($list_transaksi as $row2): ?>
                <tr>
                    <td><?= $row2['id'] ?></td>
                    <td><?= $row2['waktu_transaksi'] ?></td>
                    <td><?= $row2['keterangan'] ?></td>
                    <td><?= $row2['total'] ?></td>
                    <td><?= $row2['nama'] ?></td>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="t2">
            <h2>Transaksi Detail</h2>
            <table border="1" cellpadding="8" cellspacing="0">
                <tr>
                    <th>Transaksi ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Nama Supplier</th>
                </tr>
                <?php foreach ($list_transaksi_detail as $row3): ?>
                <tr>
                    <td><?= $row3['transaksi_id'] ?></td>
                    <td><?= $row3['nama_barang'] ?></td>
                    <td><?= $row3['harga'] ?></td>
                    <td><?= $row3['qty'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="buttonWrapper">
        <form action="form_transaksi.php" method="get" class="formTambah1">
            <button class="tambah" type="submit">Tambah transaksi</button>
        </form>
        <form action="form_transaksi_detail.php" method="get" class="formTambah2">
            <button class="tambah" type="submit">Tambah transaksi detail</button>
        </form>
    </div>
</body>
</html>