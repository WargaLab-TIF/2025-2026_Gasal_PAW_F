<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

$stmt_select = mysqli_prepare($conn, "SELECT id, nama_barang, stok FROM barang");
mysqli_stmt_execute($stmt_select);
$result_barang = mysqli_stmt_get_result($stmt_select);

$stmt_select2 = mysqli_prepare($conn, "SELECT id FROM transaksi");
mysqli_stmt_execute($stmt_select2);
$result_transaksi = mysqli_stmt_get_result($stmt_select2);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pilih_barang  = $_POST["pilih_barang"];
    $id_transaksi = $_POST["id_transaksi"];
    $qty = $_POST["qty"];

    if (empty($pilih_barang) || empty($id_transaksi) || empty($qty)) {
        echo "<script> alert('Tidak boleh ada input kosong !!');
        window.location.href = './tambah_detail.php'; </script>";
        exit;
    }

    $stmt_detail_barang = mysqli_prepare($conn, "SELECT harga, stok FROM barang WHERE id = ?");
    mysqli_stmt_bind_param($stmt_detail_barang, "i", $pilih_barang);
    mysqli_stmt_execute($stmt_detail_barang);
    $result_barang2 = mysqli_stmt_get_result($stmt_detail_barang);
    $barang = mysqli_fetch_assoc($result_barang2);

    $harga = $barang['harga'];
    $stok  = $barang['stok'];

    if ($qty > $stok) {
        echo "<script>alert('Stok tidak cukup!'); window.location.href='tambah_detail.php';</script>";
        exit;
    }

    $stmt_insert = mysqli_prepare($conn,
        "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt_insert, "iidi", $id_transaksi, $pilih_barang, $harga, $qty);
    mysqli_stmt_execute($stmt_insert);

    $update_stok = mysqli_prepare($conn, "UPDATE barang SET stok = stok - ? WHERE id = ?");
    mysqli_stmt_bind_param($update_stok, "ii", $qty, $pilih_barang);
    mysqli_stmt_execute($update_stok);

    $update_total = mysqli_prepare($conn, "
        UPDATE transaksi
        SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_id = ?)
        WHERE id = ?
    ");
    mysqli_stmt_bind_param($update_total, "ii", $id_transaksi, $id_transaksi);
    mysqli_stmt_execute($update_total);

    echo "<script>alert('Berhasil menambah detail!'); window.location.href='transaksi.php';</script>";
    exit;
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Detail Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
       
        button {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <form action="" method="POST">
        <h2>Tambah Detail Transaksi</h2>

        <div class="mb-3">
            <label for="pilih_barang" class="form-label">Pilih Barang:</label>
            <select class="form-select" id="pilih_barang" name="pilih_barang">
                <?php while ($option = mysqli_fetch_assoc($result_barang)): ?>
                    <option value="<?= $option['id'] ?>">
                        <?= htmlspecialchars($option['nama_barang']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_transaksi" class="form-label">Id Transaksi:</label>
            <select class="form-select" id="id_transaksi" name="id_transaksi">
                <?php while ($option = mysqli_fetch_assoc($result_transaksi)): ?>
                    <option value="<?= $option['id'] ?>">
                        <?= htmlspecialchars($option['id']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <label>Quantity:</label>
        <input type="number" name="qty" >

        <button type="submit">Tambah Transaksi</button>
    </form>
</body>
</html>
