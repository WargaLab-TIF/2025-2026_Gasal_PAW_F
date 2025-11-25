<?php
    session_start();
    if (!isset($_SESSION['login'])) {
    }
    require "../conn.php";
    $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
    if (isset($_POST['submit'])) {
        $waktu = $_POST['waktu_transaksi'];
        $pelanggan_id = $_POST['pelanggan_id'];
        $total = $_POST['total'];
        $keterangan = $_POST['keterangan'];
        $query = "INSERT INTO transaksi (waktu_transaksi, pelanggan_id, total, keterangan) VALUES ('$waktu', '$pelanggan_id', '$total', '$keterangan')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Transaksi berhasil ditambahkan!');window.location='transaksi.php';</script>";
        } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Transaksi</title>
        <style>
            body {
                font-family:sans-serif;
                background:#f4f4f4;
                padding:20px;
            }
            .container {
                background:white;
                max-width:500px;
                margin:auto;
                padding:20px;
                border-radius:5px;
                box-shadow:0 0 10px rgba(0,0,0,0.1);
            }
            input, select, textarea  {
                width:100%;
                padding:10px;
                margin:10px 0;
                border:1px solid #ddd;
                border-radius:4px;
                box-sizing:border-box;
            }
            button  {
                width:100%;
                padding:10px;
                background:#27ae60;
                color:white;
                border:none;
                border-radius:4px;
                cursor:pointer;
            }
            button:hover  {
                background:#1e8449;
            }
            .back-btn  {
                background:#555;
                margin-top:10px;
                display:block;
                text-align:center;
                text-decoration:none;
                padding:10px;
                border-radius:4px;
                color:white;
            }
            label  {
                font-weight: bold;
                font-size: 14px;
                color: #333;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Tambah Transaksi</h2>
            <form method="POST">
                <label>Waktu Transaksi</label>
                <input type="date" name="waktu_transaksi" value="<?= date('Y-m-d') ?>" required>
                <label>Pelanggan</label>
                <select name="pelanggan_id" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php while($p = mysqli_fetch_assoc($pelanggan)): ?>
                    <option value="<?= $p['id'] ?>">
                        <?= $p['nama'] ?> (ID: <?= $p['id'] ?>)
                    </option>
                    <?php endwhile; ?>
                </select>
                <label>Total (Rp)</label>
                <input type="number" name="total" placeholder="0" required>
                <label>Keterangan</label>
                <textarea name="keterangan" rows="3" placeholder="Contoh: Pembelian Grosir..."></textarea>
                <button type="submit" name="submit">Simpan Transaksi</button>
                <a href="transaksi.php" class="back-btn">Kembali</a>
            </form>
        </div>
    </body>
</html>