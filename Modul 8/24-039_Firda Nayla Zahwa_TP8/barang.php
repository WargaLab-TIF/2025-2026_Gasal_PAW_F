<?php 
include 'header.php';
require 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Barang</title>

<style>
.container {
    width: 900px;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}
th, td {
    padding: 10px;
    border: 1px solid #ddd;
}
th {
    background: #003399;
    color: white;
}
.btn {
    padding: 7px 12px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-weight: bold;
    cursor: pointer;
}
.tambah { background: #0066ff; }
.edit { background: #ffaa00; }
.hapus { background: #ff4444; }
.modal-bg {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.4);
}
.modal-box {
    background: white;
    width: 400px;
    margin: 120px auto;
    padding: 20px;
    border-radius: 10px;
}
.modal-box input, .modal-box select {
    width: 100%;
    padding: 7px;
    margin-bottom: 10px;
}
.close {
    float: right;
    cursor: pointer;
    color: red;
    font-weight: bold;
    font-size: 20px;
}
</style>

<script>
// TAMPILKAN POPUP TAMBAH
function showTambah() {
    document.getElementById("modalTambah").style.display = "block";
}
// TAMPILKAN POPUP EDIT + ISI DATA
function showEdit(id, nama, harga, stok, supplier) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_nama").value = nama;
    document.getElementById("edit_harga").value = harga;
    document.getElementById("edit_stok").value = stok;
    document.getElementById("edit_supplier").value = supplier;

    document.getElementById("modalEdit").style.display = "block";
}
// TUTUP POPUP
function closeModal(id) {
    document.getElementById(id).style.display = "none";
}
</script>

</head>
<body>

<div class="container">
    <h2>Data Barang</h2>
    <button class="btn tambah" onclick="showTambah()">+ Tambah Barang</button>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>

        <?php
        $barang = mysqli_query($koneksi,
            "SELECT barang.*, supplier.nama AS supplier 
             FROM barang
             JOIN supplier ON barang.supplier_id = supplier.id");

        while ($b = mysqli_fetch_assoc($barang)) { ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['nama_barang'] ?></td>
            <td><?= number_format($b['harga']) ?></td>
            <td><?= $b['stok'] ?></td>
            <td><?= $b['supplier'] ?></td>
            <td>
                <button class="btn edit" 
                    onclick="showEdit('<?= $b['id'] ?>','<?= $b['nama_barang'] ?>','<?= $b['harga'] ?>','<?= $b['stok'] ?>','<?= $b['supplier_id'] ?>')">
                    Edit
                </button>

                <a class="btn hapus" href="barang.php?hapus=<?= $b['id'] ?>"
                   onclick="return confirm('Hapus barang ini?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<!--- POPUP TAMBAH --->
<div class="modal-bg" id="modalTambah">
    <div class="modal-box">
        <span class="close" onclick="closeModal('modalTambah')">&times;</span>
        <h3>Tambah Barang</h3>

        <form method="POST">
            <input type="text" name="nama_barang" placeholder="Nama Barang" required>
            <input type="number" name="harga" placeholder="Harga" required>
            <input type="number" name="stok" placeholder="Stok" required>

            <select name="supplier_id" required>
                <option disabled selected>Pilih Supplier</option>
                <?php 
                $sup = mysqli_query($koneksi, "SELECT * FROM supplier");
                while ($s = mysqli_fetch_assoc($sup)) { ?>
                    <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
                <?php } ?>
            </select>

            <button class="btn tambah" name="tambah">Simpan</button>
        </form>
    </div>
</div>

<!--- POPUP EDIT --->
<div class="modal-bg" id="modalEdit">
    <div class="modal-box">
        <span class="close" onclick="closeModal('modalEdit')">&times;</span>
        <h3>Edit Barang</h3>

        <form method="POST">
            <input type="hidden" name="id" id="edit_id">

            <input type="text" name="nama_barang" id="edit_nama" required>
            <input type="number" name="harga" id="edit_harga" required>
            <input type="number" name="stok" id="edit_stok" required>

            <select name="supplier_id" id="edit_supplier" required>
                <?php 
                $sup = mysqli_query($koneksi, "SELECT * FROM supplier");
                while ($s = mysqli_fetch_assoc($sup)) { ?>
                    <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
                <?php } ?>
            </select>

            <button class="btn edit" name="edit">Update</button>
        </form>
    </div>
</div>

</body>
</html>

<?php
// PROSES TAMBAH
if (isset($_POST['tambah'])) {
    mysqli_query($koneksi, "INSERT INTO barang VALUES(
        NULL,
        '$_POST[nama_barang]',
        '$_POST[harga]',
        '$_POST[stok]',
        '$_POST[supplier_id]'
    )");

    echo "<script>alert('Berhasil ditambah'); window.location='barang.php';</script>";
}

// PROSES EDIT
if (isset($_POST['edit'])) {
    mysqli_query($koneksi, "UPDATE barang SET
        nama_barang='$_POST[nama_barang]',
        harga='$_POST[harga]',
        stok='$_POST[stok]',
        supplier_id='$_POST[supplier_id]'
        WHERE id='$_POST[id]'");

    echo "<script>alert('Berhasil diedit'); window.location='barang.php';</script>";
}

// PROSES HAPUS
if (isset($_GET['hapus'])) {
    mysqli_query($koneksi, "DELETE FROM barang WHERE id='$_GET[hapus]'");
    echo "<script>alert('Berhasil dihapus'); window.location='barang.php';</script>";
}
?>