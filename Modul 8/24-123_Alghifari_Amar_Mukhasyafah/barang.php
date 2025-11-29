<?php
include "conn.php";
include "cek_session.php";

// Cek Level Admin
if ($_SESSION['level'] != 1) {
    echo "<script>alert('Anda bukan Admin!'); window.location='index.php';</script>";
    exit();
}

// --- LOGIC CRUD ---

// 1. Hapus
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $q = mysqli_query($conn, "DELETE FROM barang WHERE id='$id'");
    if($q){
        echo "<script>alert('Data Berhasil Dihapus'); window.location='barang.php';</script>";
    } else {
        echo "<script>alert('Gagal Hapus! Barang ini mungkin sudah ada di data transaksi.'); window.location='barang.php';</script>";
    }
}

// 2. Tambah & Edit (Simpan)
if(isset($_POST['simpan'])){
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];
    
    if($_POST['id_barang'] != ""){
        // Update
        mysqli_query($conn, "UPDATE barang SET nama_barang='$nama', harga='$harga', stok='$stok', supplier_id='$supplier_id' WHERE id='$_POST[id_barang]'");
    } else {
        // Insert
        mysqli_query($conn, "INSERT INTO barang (nama_barang, harga, stok, supplier_id) VALUES ('$nama', '$harga', '$stok', '$supplier_id')");
    }
    header("Location: barang.php");
}

// 3. Ambil Data untuk Edit
$data_edit = null;
if(isset($_GET['edit'])){
    $q_edit = mysqli_query($conn, "SELECT * FROM barang WHERE id='$_GET[edit]'");
    $data_edit = mysqli_fetch_assoc($q_edit);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Barang</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .form-box { background: #f4f4f4; padding: 15px; border: 1px solid #ddd; margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #333; color: #fff; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; font-size: 14px;}
        .edit { background: #ffc107; color: black; }
        .del { background: #dc3545; }
        .save { background: #28a745; cursor: pointer; border: none; padding: 8px 15px; }
    </style>
</head>
<body>
    <a href="admin.php" style="text-decoration:none;">&larr; Kembali ke Dashboard</a>
    <h2>Manajemen Barang</h2>

    <div class="form-box">
        <h3><?= isset($_GET['edit']) ? 'Edit Barang' : 'Tambah Barang Baru' ?></h3>
        <form method="post">
            <input type="hidden" name="id_barang" value="<?= @$data_edit['id'] ?>">
            
            <label>Nama Barang:</label><br>
            <input type="text" name="nama_barang" value="<?= @$data_edit['nama_barang'] ?>" required style="width: 300px;"><br><br>
            
            <label>Harga (Rp):</label><br>
            <input type="number" name="harga" value="<?= @$data_edit['harga'] ?>" required><br><br>
            
            <label>Stok Awal:</label><br>
            <input type="number" name="stok" value="<?= @$data_edit['stok'] ?>" required><br><br>
            
            <label>Supplier:</label><br>
            <select name="supplier_id" required>
                <option value="">- Pilih Supplier -</option>
                <?php
                $sup = mysqli_query($conn, "SELECT * FROM supplier");
                while($s = mysqli_fetch_assoc($sup)){
                    $selected = (@$data_edit['supplier_id'] == $s['id']) ? 'selected' : '';
                    echo "<option value='$s[id]' $selected>$s[nama]</option>";
                }
                ?>
            </select><br><br>

            <button type="submit" name="simpan" class="btn save">Simpan Data</button>
            <?php if(isset($_GET['edit'])): ?>
                <a href="barang.php" class="btn del">Batal</a>
            <?php endif; ?>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $q = mysqli_query($conn, "SELECT barang.*, supplier.nama as nama_sup FROM barang JOIN supplier ON barang.supplier_id = supplier.id ORDER BY id DESC");
            while($row = mysqli_fetch_assoc($q)){
                echo "<tr>
                    <td>$no++</td>
                    <td>$row[nama_barang]</td>
                    <td>Rp " . number_format($row['harga']) . "</td>
                    <td>$row[stok]</td>
                    <td>$row[nama_sup]</td>
                    <td>
                        <a href='barang.php?edit=$row[id]' class='btn edit'>Edit</a>
                        <a href='barang.php?hapus=$row[id]' class='btn del' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>