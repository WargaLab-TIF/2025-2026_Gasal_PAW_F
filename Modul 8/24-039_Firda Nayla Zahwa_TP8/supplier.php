<?php 
include 'header.php';
require 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Supplier</title>

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
.modal-box input, .modal-box textarea {
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
function showTambah() {
    document.getElementById("modalTambah").style.display = "block";
}

// POPUP EDIT
function showEdit(id, nama, telp, alamat) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_nama").value = nama;
    document.getElementById("edit_telp").value = telp;
    document.getElementById("edit_alamat").value = alamat;

    document.getElementById("modalEdit").style.display = "block";
}

// CLOSE POPUP
function closeModal(id) {
    document.getElementById(id).style.display = "none";
}
</script>

</head>
<body>

<div class="container">
    <h2>Data Supplier</h2>
    <button class="btn tambah" onclick="showTambah()">+ Tambah Supplier</button>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Supplier</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php
        $supplier = mysqli_query($koneksi, "SELECT * FROM supplier");
        while ($s = mysqli_fetch_assoc($supplier)) { ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= $s['nama'] ?></td>
            <td><?= $s['telp'] ?></td>
            <td><?= $s['alamat'] ?></td>
            <td>
                <button class="btn edit"
                    onclick="showEdit(
                        '<?= $s['id'] ?>',
                        '<?= $s['nama'] ?>',
                        '<?= $s['telp'] ?>',
                        '<?= htmlspecialchars($s['alamat']) ?>'
                    )">
                    Edit
                </button>

                <a class="btn hapus" 
                   href="supplier.php?hapus=<?= $s['id'] ?>"
                   onclick="return confirm('Hapus supplier ini?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<!--- TAMBAH --->
<div class="modal-bg" id="modalTambah">
    <div class="modal-box">
        <span class="close" onclick="closeModal('modalTambah')">&times;</span>
        <h3>Tambah Supplier</h3>

        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Supplier" required>
            <input type="text" name="telp" placeholder="Nomor Telepon" required>
            <textarea name="alamat" placeholder="Alamat" required></textarea>

            <button class="btn tambah" name="tambah">Simpan</button>
        </form>
    </div>
</div>

<!--- EDIT --->
<div class="modal-bg" id="modalEdit">
    <div class="modal-box">
        <span class="close" onclick="closeModal('modalEdit')">&times;</span>
        <h3>Edit Supplier</h3>

        <form method="POST">
            <input type="hidden" name="id" id="edit_id">

            <input type="text" name="nama" id="edit_nama" required>
            <input type="text" name="telp" id="edit_telp" required>
            <textarea name="alamat" id="edit_alamat" required></textarea>

            <button class="btn edit" name="edit">Update</button>
        </form>
    </div>
</div>

</body>
</html>

<?php
/* ===== TAMBAH DATA SUPPLIER ===== */
if (isset($_POST['tambah'])) {
    mysqli_query($koneksi, "INSERT INTO supplier VALUES(
        NULL,
        '$_POST[nama]',
        '$_POST[telp]',
        '$_POST[alamat]'
    )");

    echo "<script>alert('Supplier berhasil ditambah'); window.location='supplier.php';</script>";
}

/* ===== UPDATE DATA ===== */
if (isset($_POST['edit'])) {
    mysqli_query($koneksi, "UPDATE supplier SET
        nama='$_POST[nama]',
        telp='$_POST[telp]',
        alamat='$_POST[alamat]'
        WHERE id='$_POST[id]'");

    echo "<script>alert('Supplier berhasil diperbarui'); window.location='supplier.php';</script>";
}

/* ===== HAPUS DATA ===== */
if (isset($_GET['hapus'])) {
    mysqli_query($koneksi, "DELETE FROM supplier WHERE id='$_GET[hapus]'");
    echo "<script>alert('Supplier berhasil dihapus'); window.location='supplier.php';</script>";
}
?>
