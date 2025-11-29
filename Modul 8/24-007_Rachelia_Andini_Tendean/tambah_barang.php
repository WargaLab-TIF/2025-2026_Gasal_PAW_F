<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}

$errors = []; 
$pesan = "";
$nama = "";
$harga = "";
$stok = "";
$supplier_id = ""; 
$supplier_list = mysqli_query($koneksi, "SELECT id, nama FROM supplier ORDER BY nama ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $nama = mysqli_real_escape_string($koneksi, trim($_POST["nama"] ?? ""));
    $harga = mysqli_real_escape_string($koneksi, $_POST["harga"] ?? "");
    $stok = mysqli_real_escape_string($koneksi, $_POST["stok"] ?? "");
    $supplier_id = mysqli_real_escape_string($koneksi, $_POST["supplier_id"] ?? "");

    if ($nama === "") {
        $errors[] = "Nama barang tidak boleh kosong.";
    }
    
    if ($harga === "" || !is_numeric($harga) || $harga <= 0) {
        $errors[] = "Harga harus diisi dengan angka positif.";
    }
    
    if ($stok === "" || !is_numeric($stok) || $stok < 0) {
        $errors[] = "Stok harus diisi dengan angka valid.";
    }

    if ($supplier_id === "") {
        $errors[] = "Supplier harus dipilih.";
    }

    if (empty($errors)) {
        $query = "INSERT INTO barang (nama_barang, harga, stok, supplier_id) 
                  VALUES ('$nama', '$harga', '$stok', '$supplier_id')";
        
        if (mysqli_query($koneksi, $query)) {
            $pesan = "Data barang berhasil ditambahkan!";
            // Reset form
            $nama = $harga = $stok = $supplier_id = ""; 
        } else {
            $errors[] = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 300px; padding: 6px; }
        .btn-simpan { background: #28a745; color: white; padding: 8px 15px; border-radius: 4px; border: none; margin-top: 10px; cursor: pointer; }
        .btn-batal { background: #dc3545; color: white; padding: 8px 15px; border-radius: 4px; border: none; margin-left: 10px; cursor: pointer; }
        .error { color: red; margin: 10px 0; }
        .pesan { color: green; margin: 10px 0; }
        h3 { color: #8dadddff; }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div style="padding: 20px;">
        <h3>Tambah Data Barang</h3>

        <?php if (!empty($errors)): ?>
            <div class="error"><ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
        <?php elseif ($pesan): ?>
            <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <table>
                <tr>
                    <td><label>Nama Barang</label></td>
                    <td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required></td>
                </tr>
                <tr>
                    <td><label>Harga</label></td>
                    <td><input type="number" name="harga" value="<?= htmlspecialchars($harga) ?>" min="1" required></td>
                </tr>
                <tr>
                    <td><label>Stok Awal</label></td>
                    <td><input type="number" name="stok" value="<?= htmlspecialchars($stok) ?>" min="0" required></td>
                </tr>
                <tr>
                    <td><label>Supplier</label></td>
                    <td>
                        <select name="supplier_id" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php while ($s = mysqli_fetch_assoc($supplier_list)) { ?>
                                <option value="<?= $s['id']; ?>" <?= $supplier_id == $s['id'] ? 'selected' : '' ?>>
                                    <?= $s['nama']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button class="btn-simpan" type="submit" name="submit">Simpan</button>
                        <button class="btn-batal" type="button" onclick="window.location.href='master.php';">Batal</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>