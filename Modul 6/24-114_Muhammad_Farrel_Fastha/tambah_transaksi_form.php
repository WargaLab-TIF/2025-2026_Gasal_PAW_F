<?php
    include "conn.php";

    $stmt_select = mysqli_prepare($conn, "SELECT id, nama FROM pelanggan");
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Data Transaksi</title>
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
    <form action="./proses/tambah_transaksi.php" method="POST">
        <h2>Tambah Data Transaksi</h2>

        <label>Waktu Transaksi:</label>
        <input type="date" name="waktu_transaksi">

        <label>Keterangan:</label>
        <textarea name="keterangan" placeholder="Masukkan keterangan transaksi"></textarea>

        <label>Total:</label>
        <input type="number" name="total" value="0" default="0">

        <div class="mb-3">
            <label for="pelanggan" class="form-label">Pelanggan:</label>
            <select class="form-select" id="pelanggan" name="pelanggan">
                <option value="">Pilih Pelanggan</option>
                <?php while ($option = mysqli_fetch_assoc($result)): ?>
                    <option value="<?= $option['id'] ?>">
                        <?= htmlspecialchars($option['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit">Tambah Transaksi</button>
    </form>
</body>
</html>
