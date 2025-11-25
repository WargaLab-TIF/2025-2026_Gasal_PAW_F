<?php
    session_start();
    if (!isset($_SESSION['login'])) { header("Location: ../login.php"); exit; }
    require "../conn.php";
    $id = $_GET['id'];
    $query_trx = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query_trx);
    $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
    if (isset($_POST['update'])) {
        $waktu = $_POST['waktu_transaksi'];
        $pelanggan_id = $_POST['pelanggan_id'];
        $total = $_POST['total'];
        $keterangan = $_POST['keterangan'];
        $query = "UPDATE transaksi SET
        waktu_transaksi = '$waktu',
        pelanggan_id = '$pelanggan_id',
        total = '$total',
        keterangan = '$keterangan'
        WHERE id = '$id'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Transaksi berhasil diupdate!');window.location='transaksi.php';</script>";
        } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Transaksi</title>
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
                padding:30px;
                border-radius:8px;
                box-shadow:0 4px 10px rgba(0,0,0,0.1);
            }
            h2  {
                margin-top: 0;
                color: #333;
                text-align: center;
                border-bottom: 2px solid #eee;
                padding-bottom: 20px;
            }
            label  {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
                color: #555;
            }
            input, select, textarea  {
                width:100%;
                padding:10px;
                margin-bottom:20px;
                border:1px solid #ddd;
                border-radius:4px;
                box-sizing:border-box;
                font-family: sans-serif;
            }
            input:focus, select:focus, textarea:focus  {
                border-color: #f39c12;
                outline: none;
            }
            button  {
                width:100%;
                padding:12px;
                background:#f39c12;
                color:white;
                border:none;
                border-radius:4px;
                cursor:pointer;
                font-weight: bold;
                font-size: 16px;
            }
            button:hover  {
                background:#d35400;
            }
            .back-btn  {
                background:#555;
                margin-top:10px;
                display:block;
                text-align:center;
                text-decoration:none;
                padding:12px;
                border-radius:4px;
                color:white;
                font-weight: bold;
            }
            .back-btn:hover  {
                background: #333;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Edit Transaksi</h2>
            <form method="POST">
                <label>Waktu Transaksi</label>
                <input type="date" name="waktu_transaksi" value="<?= $data['waktu_transaksi'] ?>" required>
                <label>Pelanggan</label>
                <select name="pelanggan_id" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php while($p = mysqli_fetch_assoc($pelanggan)): ?>
                    <option value="<?= $p['id'] ?>" <?= ($p['id'] == $data['pelanggan_id']) ? 'selected' : '' ?>>
                        <?= $p['nama'] ?> (ID: <?= $p['id'] ?>)
                    </option>
                    <?php endwhile; ?>
                </select>
                <label>Total (Rp)</label>
                <input type="number" name="total" value="<?= $data['total'] ?>" required>
                <small style="color: #999; display: block; margin-top: -15px; margin-bottom: 15px;">*Total ini adalah nilai header manual.</small>
                <label>Keterangan</label>
                <textarea name="keterangan" rows="3"><?= $data['keterangan'] ?></textarea>
                <button type="submit" name="update">Update Transaksi</button>
                <a href="transaksi.php" class="back-btn">Kembali</a>
            </form>
        </div>
    </body>
</html>