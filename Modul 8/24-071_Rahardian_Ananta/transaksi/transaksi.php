<?php
    session_start();
    if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
        header("Location: ../login.php");
        exit();
    }
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "penjualan";
    $conn = new mysqli($host, $user, $password, $dbname);
    $nama_user = isset($_SESSION["username"]) ? $_SESSION["username"] : "Admin";
    $sql = "SELECT
    transaksi.id,
    transaksi.waktu_transaksi,
    transaksi.keterangan,
    pelanggan.nama AS nama_pelanggan,
    COALESCE(SUM(transaksi_detail.harga), 0) AS total_dihitung
    FROM
    transaksi
    JOIN
    pelanggan ON transaksi.pelanggan_id = pelanggan.id
    LEFT JOIN
    transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
    GROUP BY
    transaksi.id";
    $transaksi = mysqli_query($conn, $sql);
    $barang = mysqli_query($conn, "SELECT * FROM barang");
    $sql_detail = " SELECT transaksi_detail.*, barang.nama_barang
    FROM transaksi_detail
    JOIN barang ON transaksi_detail.barang_id = barang.id";
    $transaksi_detil = mysqli_query($conn, $sql_detail);
    $no = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Master Transaksi</title>
        <style>
            body {
                margin:0;
                font-family:sans-serif;
            }
            .navbar  {
                width:100%;
                background:#333;
                color:white;
                padding:10px;
                display:flex;
                align-items:center;
                box-sizing: border-box;
            }
            .navbar a  {
                color:white;
                margin-right:20px;
                text-decoration:none;
                font-size:18px;
            }
            .navbar a:hover  {
                text-decoration:underline;
            }
            .user-menu  {
                margin-left:auto;
                position:relative;
                cursor:pointer;
                color:white;
                font-size:18px;
            }
            .dropdown  {
                display:none;
                position:absolute;
                right:0;
                background:#444;
                padding:10px;
                border-radius:5px;
                z-index: 100;
            }
            .dropdown a  {
                display:block;
                color:white;
                text-decoration:none;
                padding:5px 10px;
            }
            .dropdown a:hover  {
                background:#555;
            }
            .user-menu:hover .dropdown  {
                display:block;
            }
            .tombol_merah, .tombol_oren, .tombol_hijau, .tombol_biru  {
                padding:6px 12px;
                border-radius:5px;
                border:none;
                color:white;
                cursor:pointer;
                font-weight:bold;
                font-size:14px;
                transition:0.2s;
                text-decoration: none;
                display: inline-block;
                margin-right: 5px;
            }
            .tombol_merah  {
                background:#e74c3c;
            }
            .tombol_merah:hover  {
                background:#c0392b;
            }
            .tombol_oren  {
                background:#f39c12;
            }
            .tombol_oren:hover  {
                background:#d35400;
            }
            .tombol_hijau  {
                background:#27ae60;
            }
            .tombol_hijau:hover  {
                background:#1e8449;
            }
            .tombol_biru  {
                background:#0d6efd;
            }
            .tombol_biru:hover  {
                background:#0b5ed7;
            }
            .tombol-kanan-container  {
                text-align:right;
                margin-bottom:10px;
            }
            .nav-tab  {
                margin:20px 0;
            }
            .nav-tab a  {
                padding:10px 15px;
                background:#eee;
                color:#333;
                margin-right:5px;
                text-decoration:none;
                cursor:pointer;
                display:inline-block;
            }
            .nav-tab a.active  {
                background:#333;
                color:white;
            }
            .container  {
                max-width:1200px;
                margin:20px auto;
                padding:0 20px;
            }
            .table-wrapper  {
                overflow-x:auto;
            }
            table  {
                border-collapse:collapse;
                width:100%;
                min-width:600px;
            }
            th, td  {
                padding:8px 12px;
                border:1px solid #ccc;
                text-align:left;
            }
            th  {
                background:#333;
                color:white;
            }
            h2  {
                margin-top: 0;
            }
        </style>
    </head>
    <body>
        <div class="navbar">
            <a href="../index.php">Home</a>
            <?php if($_SESSION['level'] == "Admin"): ?>
            <a href="../datamaster/datamaster.php">Data Master</a>
            <?php endif; ?>
            <a href="#">Transaksi</a>
            <a href="../laporan/laporan.php">Laporan</a>
            <div class="user-menu">
                <?= $nama_user ?> ▼
                <div class="dropdown">
                    <a href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="container">
            <h1>Master Transaksi</h1>
            <div class="nav-tab">
                <a class="active" onclick="showTab('tab-transaksi', this)">Data Transaksi</a>
                <a onclick="showTab('tab-barang', this)">Stok Barang</a>
                <a onclick="showTab('tab-detail', this)">Detail Item Transaksi</a>
            </div>
            <div id="tab-transaksi" style="display:block;">
                <h2>Riwayat Transaksi</h2>
                <div class="tombol-kanan-container">
                    <a href="input_transaksi.php" class="tombol_hijau">Tambah Transaksi</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>Waktu</th>
                            <th>Pelanggan</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($transaksi)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["waktu_transaksi"] ?></td>
                            <td><?= $row["nama_pelanggan"] ?></td>
                            <td><?= $row["keterangan"] ?></td>
                            <td>Rp<?= number_format(
                                    $row["total_dihitung"],
                                    0,
                                    ",",
                                    ".",
                                ) ?></td>
                                <td>
                                    <a href="edit_transaksi.php?id=<?= $row['id'] ?>" class="tombol_oren">Edit</a>
                                    <a href="delete_transaksi.php?id=<?= $row['id'] ?>" class="tombol_merah" onclick="return confirm('Yakin ingin menghapus transaksi ini? Data detail barang juga akan terhapus.');">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div id="tab-barang" style="display:none;">
                    <h2>Data Barang</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Supplier ID</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($barang)): ?>
                            <tr>
                                <td><?= $row["id"] ?></td>
                                <td><?= $row["id"] ?></td>
                                <td><?= $row["nama_barang"] ?></td>
                                <td>Rp<?= number_format($row["harga"], 0, ",", ".") ?></td>
                                <td><?= $row["stok"] ?></td>
                                <td><?= $row["supplier_id"] ?></td>
                                <td>
                                    <a href="delete_barang.php?id=<?= $row[
                                        "id"
                                    ] ?>" class="tombol_merah" onclick="return confirm('Yakin ingin menghapus item ini?');">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div id="tab-detail" style="display:none;">
                    <h2>Rincian Item Terjual</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Nama Barang</th>
                                <th>Harga Satuan</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($transaksi_detil)): ?>
                            <tr>
                                <td><?= $row["transaksi_id"] ?></td>
                                <td><?= $row["nama_barang"] ?></td>
                                <td>Rp<?= number_format($row["harga"], 0, ",", ".") ?></td>
                                <td><?= $row["qty"] ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div> <script>
                function showTab(id, el){
                    document.getElementById('tab-transaksi').style.display = 'none';
                    document.getElementById('tab-barang').style.display = 'none';
                    document.getElementById('tab-detail').style.display = 'none';
                    document.getElementById(id).style.display = 'block';
                    document.querySelectorAll('.nav-tab a').forEach(a => a.classList.remove('active'));
                    el.classList.add('active');
                }
            </script>
        </body>
    </html>