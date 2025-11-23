<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

$transaksi_id = $_GET['transaksi_id'];

$query_barang = "SELECT * FROM barang";
$barang = mysqli_query($conn, $query_barang);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $cek = mysqli_query(
        $conn,
        "SELECT * FROM transaksi_detail 
         WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id"
    );

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang ini sudah ditambahkan!');</script>";
    } else {
        $harga_barang = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang_id")
        )['harga'];

        $subtotal = $harga_barang * $qty;

        mysqli_query(
            $conn,
            "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) 
             VALUES ($transaksi_id, $barang_id, $qty, $subtotal)"
        );

        mysqli_query(
            $conn,
            "UPDATE transaksi 
             SET total = (
                SELECT SUM(harga) 
                FROM transaksi_detail 
                WHERE transaksi_id = $transaksi_id
              )
             WHERE id = $transaksi_id"
        );

        header("Location: transaksi_detail.php?id=$transaksi_id");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
    <style>
        body {
            margin: 0;
            font-family: Verdana;
            background: #e9eef5;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 60px;
        }

        .container {
            width: 420px;
            background: #fff;
            padding: 25px 28px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 22px;
            font-size: 18px;
            color: #333;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            color: #444;
        }

        select, input[type="number"] {
            width: 100%;
            height: 38px;
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 6px 10px;
            margin-bottom: 14px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        select:focus, input[type="number"]:focus {
            border-color: #007bff;
        }

        .btn-submit {
            width: 100%;
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #005ec2;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Detail Transaksi </h2>

    <form method="POST">

        <label>Barang</label>
        <select name="barang_id" required>
            <option value="">-- Pilih --</option>
            <?php while($b = mysqli_fetch_assoc($barang)) { ?>
                <option value="<?= $b['id'] ?>">
                    <?= $b['nama_barang'] . " - Rp " . number_format($b['harga']) ?>
                </option>
            <?php } ?>
        </select>

        <label>Pilih Transaksi</label><br>
        <select name="transaksi_id" required>
            <?php
            $trx = mysqli_query($conn, "SELECT id, waktu_transaksi, keterangan FROM transaksi ORDER BY id ASC");
            while ($t = mysqli_fetch_assoc($trx)):
            ?>
                <option value="<?= $t['id'] ?>" 
                    <?= $t['id'] == $transaksi_id ? 'selected' : '' ?>>
                    ID <?= $t['id'] ?> - <?= $t['waktu_transaksi'] ?> (<?= $t['keterangan'] ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <label>Qty</label>
        <input type="number" name="qty" min="1" required>

        <button type="submit" class="btn-submit">Simpan</button>
    </form>
    <a class="btn-back" href="transaksi_detail.php?id=<?= $transaksi_id ?>">Kembali</a>
</div>


</body>
</html>
