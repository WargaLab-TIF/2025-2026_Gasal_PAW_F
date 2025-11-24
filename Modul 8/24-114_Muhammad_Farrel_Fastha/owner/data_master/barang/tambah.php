<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

$nama_barang = "";
$harga = "";
$stok = "";
$supplier_id = "";

$stmt_supplier = mysqli_prepare($conn, "SELECT id, nama FROM supplier ORDER BY nama ASC");
mysqli_stmt_execute($stmt_supplier);
$result_supplier = mysqli_stmt_get_result($stmt_supplier);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_barang = trim($_POST['nama_barang'] ?? "");
    $harga       = intval($_POST['harga'] ?? 0);
    $stok        = intval($_POST['stok'] ?? 0);
    $supplier_id = intval($_POST['supplier_id'] ?? 0);

    $stmt = mysqli_prepare($conn, 
        "INSERT INTO barang (nama_barang, harga, stok, supplier_id) 
         VALUES (?, ?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "siii",
            $nama_barang, $harga, $stok, $supplier_id
        );

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: barang.php");
            exit();
        } else {
            echo "Gagal menambahkan barang: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);

    } else {
        echo "Gagal menyiapkan statement: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Barang</title>
    <style>
        body {
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
            width: 380px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        label { margin-top: 8px; font-weight: bold; }
        input, select {
            width: 100%; padding: 8px; margin-top: 4px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            padding: 10px;
            border-radius: 6px;
            border: none;
            width: 100%;
            margin-top: 12px;
            color: white;
            cursor: pointer;
        }
        .btn-save { background: blue; }
        .btn-cancel { background: gray; }
    </style>
</head>
<body>

<form method="POST">
    <h2>Tambah Barang</h2>

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= htmlspecialchars($nama_barang) ?>" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" value="<?= htmlspecialchars($harga) ?>" required>
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" value="<?= htmlspecialchars($stok) ?>" required>
    </div>

    <div class="mb-3">
        <label>Supplier</label>
        <select name="supplier_id" required>
            <option value="" disabled selected>--- Pilih Supplier ---</option>

            <?php while ($row = mysqli_fetch_assoc($result_supplier)) { ?>
                <option value="<?= $row['id']; ?>">
                    <?= $row['nama']; ?>
                </option>
            <?php } ?>

        </select>
    </div>

    <button type="submit" class="btn-save">Tambah Barang</button>
    <button type="button" class="btn-cancel" onclick="window.location.href='barang.php'">Batal</button>

</form>

</body>
</html>
