<?php
    include "conn.php";

    $stmt_select = mysqli_prepare($conn, "SELECT id, nama_barang, stok FROM barang");
    mysqli_stmt_execute($stmt_select);
    $result_barang = mysqli_stmt_get_result($stmt_select);

    $stmt_select = mysqli_prepare($conn, "SELECT id FROM transaksi");
    mysqli_stmt_execute($stmt_select);
    $result_transaksi = mysqli_stmt_get_result($stmt_select);
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
    <form action="./proses/tambah_detail.php" method="POST">
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
