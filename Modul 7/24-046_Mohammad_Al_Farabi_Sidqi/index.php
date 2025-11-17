<?php
include "koneksi.php";
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
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

    .tombol {
        color: blue;
    }

    .hapus {
        color: red;
    }
</style>

<body>
    <div class="layout">
        <table>
            <h1>PENJUALAN XYZ</h1>
            <tr>
                <td>
                    <h2>Data Master Transaksi</h2>
                </td>
                <td>
                    <form action="report_transaksi.php">
                        <button class="tombol">Lihat Laporan Penjualan</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <table border="1" cellpadding="10">
                        <tr>
                            <th>No</th>
                            <th>id</th>
                            <th>Waktu Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                        <?php

                        $no = 1;
                        while ($row = mysqli_fetch_assoc($transaksi)) {
                            $pelanggan_id = $row['pelanggan_id'];

                            $pelanggan = mysqli_query($conn, "SELECT nama FROM pelanggan WHERE id='$pelanggan_id'");
                            $data_pelanggan = mysqli_fetch_assoc($pelanggan);
                            $nama_pelanggan = $data_pelanggan ? $data_pelanggan['nama'] : '-';

                            echo "
                            <tr>
                            <td> $no </td>
                            <td>{$row['id']}</td>
                            <td>{$row['waktu_transaksi']}</td>
                            <td>{$nama_pelanggan}</td>
                            <td>{$row['keterangan']}</td>
                            <td>{$row['total']}</td>
                            <td>
                            <p class='tombol'> [ <a class='tombol' href=''>Lihat Detail</a> ] </p>
                            <p class='hapus'> [ <a class='hapus' href=''>Hapus</a> ] </p>
                            </td>
                            </tr>
                            ";
                            $no++;
                        }
                        ?>
                    </table>
                </td>
        </table>
    </div>
</body>

</html>