<?php

if(!isset($_SESSION['login']) || $_SESSION['login'] !== true ){
    echo "Anda tidak berhak mengakses halaman ini. Silahkan <a href='index.php'>login</a> terlebih dahulu";
    exit();
}
if ($_SESSION['level'] != '1') {
    echo "Akses ditolak! Hak akses Admin diperlukan.";
    exit();
}

require_once "conn.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$nama_barang = "";
$harga= "";
$stok= "";
$supplier_id = "";
$id_value= "";
$error= "";
$sukses= "";
$op= isset($_GET['op']) ? $_GET['op'] : ""; 


if($op == 'delete'){
    $id_del = $_GET['id'];
    try {
        $sql_del = "DELETE FROM barang WHERE id = '$id_del'";
        if(mysqli_query($conn, $sql_del)){
            $sukses = "Data barang berhasil dihapus";
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?page=barang';</script>";
        }
    } catch (mysqli_sql_exception $e) {
        $error = "Gagal menghapus! Barang ini sudah digunakan dalam transaksi.";
    }
}


if($op == 'edit'){
    $id_edit = $_GET['id'];
    try {
        $sql1 = "SELECT * FROM barang WHERE id = '$id_edit'";
        $q1   = mysqli_query($conn, $sql1);
        $r1   = mysqli_fetch_array($q1);
        
        if($r1){
            $nama_barang = $r1['nama_barang'];
            $harga       = $r1['harga'];
            $stok        = $r1['stok'];
            $supplier_id = $r1['supplier_id'];
            $id_value    = $r1['id'];
        } else {
            $error = "Data tidak ditemukan";
        }
    } catch (Exception $e) { $error = "Error mengambil data."; }
}


if(isset($_POST['simpan'])){
    $nama_barang = $_POST['nama_barang'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];
    $id_post     = $_POST['id'];

    if($nama_barang && $harga && $stok && $supplier_id){
        try {
            if($id_post){
                // Update
                $sql1 = "UPDATE barang SET nama_barang='$nama_barang', harga='$harga', stok='$stok', supplier_id='$supplier_id' WHERE id='$id_post'";
                if(mysqli_query($conn, $sql1)) $sukses = "Data berhasil diupdate";
            } else {
                // Insert
                $sql1 = "INSERT INTO barang (nama_barang, harga, stok, supplier_id) VALUES ('$nama_barang', '$harga', '$stok', '$supplier_id')";
                if(mysqli_query($conn, $sql1)) $sukses = "Berhasil menambah barang baru";
            }
            if($sukses) echo "<script>window.location='index.php?page=barang';</script>";
        } catch (mysqli_sql_exception $e) {
            $error = "Gagal menyimpan: " . $e->getMessage();
        }
    } else {
        $error = "Silakan lengkapi semua data";
    }
}


$sql_barang   = "SELECT b.*, s.nama as nama_supplier FROM barang b JOIN supplier s ON b.supplier_id = s.id ORDER BY b.id ASC";
$q_barang     = mysqli_query($conn, $sql_barang);
$result_barang = mysqli_fetch_all($q_barang, MYSQLI_ASSOC);

$sql_supp     = "SELECT * FROM supplier ORDER BY nama ASC";
$q_supp       = mysqli_query($conn, $sql_supp); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <link rel="stylesheet" href="./css/datamaster.css">
</head>
<body>
    <div class="container">
        <h2 class="judul">Data Barang</h2>
        <div class="btn-top">
            <a href="index.php?page=barang#form-barang">
                <button class="tambah" type="button"> + Tambah barang</button>
            </a>
        </div>

        <?php if($error){ ?><div class="alert alert-error" style="background:#f8d7da;color:#721c24;padding:10px;margin-bottom:10px;border-radius:4px;"><?= $error ?></div><?php } ?>
        <?php if($sukses){ ?><div class="alert alert-success" style="background:#d4edda;color:#155724;padding:10px;margin-bottom:10px;border-radius:4px;"><?= $sukses ?></div><?php } ?>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier</th>
                <th>Tindakan</th>
            </tr>
            <?php $no = 1; if(!empty($result_barang)): foreach($result_barang as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= $row['nama_supplier'] ?></td>
                <td>
                    <a href="index.php?page=barang&op=edit&id=<?= $row['id'] ?>"><button class="edit" type="button">Edit</button></a>
                    <a href="index.php?page=barang&op=delete&id=<?= $row['id'] ?>" onclick="return confirm('Hapus barang ini?')"><button class="hapus" type="button">Hapus</button></a>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="6">Data barang kosong.</td></tr>
            <?php endif; ?>
        </table>

        <div class="form-container"id="form-barang" style="margin-top:20px;">
            <h3><?= ($op == 'edit') ? "Edit Barang" : "Tambah Barang"; ?></h3>
            <form action="index.php?page=barang" method="POST">
                <input type="hidden" name="id" value="<?= $id_value ?>">
                
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" value="<?= $nama_barang ?>" required>
                </div>
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" value="<?= $harga ?>" required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" value="<?= $stok ?>" required>
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="supplier_id" required>
                        <option value="">- Pilih Supplier -</option>
                        <?php foreach($q_supp as $sup): ?>
                            <option value="<?= $sup['id'] ?>" <?= ($supplier_id == $sup['id']) ? 'selected' : '' ?>>
                                <?= $sup['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" name="simpan" class="btn-simpan">Simpan</button>
                <a href="index.php?page=barang" class="btn-batal"><button type="button" class="btn-batal">Reset</button></a>
            </form>
        </div>
    </div>
</body>
</html>