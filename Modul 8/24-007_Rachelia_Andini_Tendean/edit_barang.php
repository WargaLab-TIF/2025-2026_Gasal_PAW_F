<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: index.php");
    exit;
}

$errors = []; 
$pesan = "";
$id = $_GET['id'] ?? null; 

$supplier_list = mysqli_query($koneksi, "SELECT id, nama FROM supplier ORDER BY nama ASC");

$data_lama_q = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
if (mysqli_num_rows($data_lama_q) == 0) {
    $errors[] = "Data barang tidak ditemukan.";
} else {
    $data_lama = mysqli_fetch_assoc($data_lama_q);
    $nama = $data_lama['nama_barang'] ?? '';
    $harga = $data_lama['harga'] ?? '';
    $stok = $data_lama['stok'] ?? '';
    $supplier_id = $data_lama['supplier_id'] ?? '';
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $nama = mysqli_real_escape_string($koneksi, trim($_POST["nama"] ?? ""));
    $harga = mysqli_real_escape_string($koneksi, $_POST["harga"] ?? "");
    $stok = mysqli_real_escape_string($koneksi, $_POST["stok"] ?? "");
    $supplier_id = mysqli_real_escape_string($koneksi, $_POST["supplier_id"] ?? "");

    if (empty($nama) || empty($harga) || empty($stok) || empty($supplier_id)) {
        $errors[] = "Semua field harus diisi.";
    } elseif (!is_numeric($harga) || $harga <= 0) {
        $errors[] = "Harga harus angka positif.";
    } elseif (!is_numeric($stok) || $stok < 0) {
        $errors[] = "Stok harus angka valid.";
    }
    
    if (empty($errors)) {
        $query = "UPDATE barang SET 
                  nama_barang='$nama', 
                  harga='$harga', 
                  stok='$stok', 
                  supplier_id='$supplier_id'
                  WHERE id='$id'";
        
        if (mysqli_query($koneksi, $query)) {
            $pesan = "Data barang berhasil diperbarui!";
            $data_lama_q = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
            $data_lama = mysqli_fetch_assoc($data_lama_q);
            $nama = $data_lama['nama_barang'];
            $harga = $data_lama['harga'];
            $stok = $data_lama['stok'];
            $supplier_id = $data_lama['supplier_id'];

        } else {
            $errors[] = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
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
        <h3>Edit Data Barang</h3>

        <?php if (!empty($errors)): ?>
            <div class="error"><ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
        <?php elseif ($pesan): ?>
            <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <table>
                <tr><td><label>Nama Barang</label></td><td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required></td></tr>
                <tr><td><label>Harga</label></td><td><input type="number" name="harga" value="<?= htmlspecialchars($harga) ?>" min="1" required></td></tr>
                <tr><td><label>Stok</label></td><td><input type="number" name="stok" value="<?= htmlspecialchars($stok) ?>" min="0" required></td></tr>
                <tr><td><label>Supplier</label></td>
                    <td>
                        <select name="supplier_id" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php mysqli_data_seek($supplier_list, 0); // Reset pointer ?>
                            <?php while ($s = mysqli_fetch_assoc($supplier_list)): ?>
                                <option value="<?= $s['id']; ?>" <?= $supplier_id == $s['id'] ? 'selected' : '' ?>>
                                    <?= $s['nama']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td>
                    <button class="btn-simpan" type="submit" name="submit" >Update</button>
                    <button class="btn-batal" type="button" onclick="window.location.href='master.php';">Batal</button>
                </td></tr>
            </table>
        </form>
    </div>
</body>
</html>