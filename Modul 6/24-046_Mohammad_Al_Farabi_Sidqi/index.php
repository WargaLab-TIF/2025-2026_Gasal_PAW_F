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
$barang = mysqli_query($conn,"SELECT * FROM barang");
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
$transaksi_detail = mysqli_query($conn, "SELECT * FROM transaksi_detail");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<style>
    body {
        background-color: aqua;
        margin: 3%;
    }

    .layout {
        padding: 3%;
        background-color: white;
    }

    table {
        margin-left: auto;
        margin-right: auto;
    }
    .tombol{
        color: blue;
    }
    .hapus{
        color: red;
    }
</style>

<body>
    <div class="layout">
        <table cellspacing="50">
            <h1>Pengelolaan Master Detail</h1>
            <tr>
                <td colspan="2">
                    <h2>Barang</h2>
                    <table border="1" cellpadding="10">
                        <tr>
                            <th>id</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Nama Supplier</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($barang)) {
                            $supplier_id = $row['supplier_id'];

                            $supplier = mysqli_query($conn, "SELECT nama FROM supplier WHERE id='$supplier_id'");
                            $data_supplier = mysqli_fetch_assoc($supplier);
                            $nama_supplier = $data_supplier ? $data_supplier['nama'] : '-';

                            echo "
                            <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['kode_barang']}</td>
                            <td>{$row['nama_barang']}</td>
                            <td>{$row['harga']}</td>
                            <td>{$row['stok']}</td>
                            <td>{$nama_supplier}</td>
                            <td class='hapus'>
                            [ <a class='hapus' href='index.php?hapus={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus {$row['nama_barang']}?')\">Delete</a> ]
                            </td>
                            </tr>
                            ";
                            $no++;
                        }
                        ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Transaksi</h2>
                    <table border="1" cellpadding="10">
                        <tr>
                            <th>id</th>
                            <th>Waktu Transaksi</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Nama Pelanggan</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($transaksi)) {
                            $pelanggan_id = $row['pelanggan_id'];

                            $pelanggan = mysqli_query($conn, "SELECT nama FROM pelanggan WHERE id='$pelanggan_id'");
                            $data_pelanggan = mysqli_fetch_assoc($pelanggan);
                            $nama_pelanggan = $data_pelanggan ? $data_pelanggan['nama'] : '-';

                            $nom = str_pad($no, 3, "0", STR_PAD_LEFT);

                            echo "
                            <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['waktu_transaksi']}</td>
                            <td>{$row['keterangan']}</td>
                            <td>{$row['total']}</td>
                            <td>{$nama_pelanggan}</td>
                            ";
                            $no++;
                        }
                        ?>
                    </table>
                </td>
                <td>
                    <h2>Transaksi Detail</h2>
                    <table border="1" cellpadding="10">
                        <tr>
                            <th>Transaksi ID</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($transaksi_detail)) {
                            $barang_id = $row['barang_id'];

                            $barang = mysqli_query($conn, "SELECT nama_barang FROM barang WHERE id='$barang_id'");
                            $data_barang = mysqli_fetch_assoc($barang);
                            $nama_barang = $data_barang ? $data_barang['nama_barang'] : '-';

                            echo "
                            <tr>
                            <td>{$row['transaksi_id']}</td>
                            <td>{$nama_barang}</td>
                            <td>{$row['harga']}</td>
                            <td>{$row['qty']}</td>
                            </tr>
                            ";
                            $no++;
                        }
                        ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="tombol">
                    [ <a href="tambah_detail.php">Tambah Transaksi</a> ]
                    [ <a href="transaksi_detail.php">Tambah Transaksi Detail</a> ]
                </td>
            </tr>
        </table>
    </div>
</body>

</html>