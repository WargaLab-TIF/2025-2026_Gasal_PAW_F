<?php 
include 'header.php';
require 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Pelanggan</title>

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
    border: 1px solid #ddd;
    padding: 10px;
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
.edit   { background: #ffaa00; }
.hapus  { background: #ff4444; }
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
    padding: 20px;
    margin: 120px auto;
    border-radius: 10px;
}
.modal-box input, .modal-box textarea, .modal-box select {
    width: 100%;
    padding: 7px;
    margin-bottom: 10px;
}
.close {
    float: right;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    color: red;
}

</style>

<script>
//POPUP TAMBAH
function showTambah() {
    document.getElementById("modalTambah").style.display = "block";
}

//POPUP EDIT
function showEdit(id, nama, jk, telp, alamat) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_nama").value = nama;
    document.getElementById("edit_jk").value = jk;
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
    <h2>Data Pelanggan</h2>
    <button class="btn tambah" onclick="showTambah()">+ Tambah Pelanggan</button>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php
        $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
        while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['jenis_kelamin'] ?></td>
            <td><?= $p['telp'] ?></td>
            <td><?= $p['alamat'] ?></td>
            <td>
                <button class="btn edit"
                    onclick="showEdit(
                        '<?= $p['id'] ?>',
                        '<?= $p['nama'] ?>',
                        '<?= $p['jenis_kelamin'] ?>',
                        '<?= $p['telp'] ?>',
                        '<?= htmlspecialchars($p['alamat']) ?>'
                    )">
                    Edit
                </button>

                <a class="btn hapus" 
                   href="pelanggan.php?hapus=<?= $p['id'] ?>"
                   onclick="return confirm('Hapus pelanggan ini?')">
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
        <h3>Tambah Pelanggan</h3>

        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Pelanggan" required>

            <select name="jenis_kelamin" required>
                <option disabled selected>Pilih Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <input type="text" name="telp" placeholder="No. Telepon" required>
            <textarea name="alamat" placeholder="Alamat lengkap" required></textarea>

            <button class="btn tambah" name="tambah">Simpan</button>
        </form>
    </div>
</div>

<!--- POPUP EDIT  --->
<div class="modal-bg" id="modalEdit">
    <div class="modal-box">
        <span class="close" onclick="closeModal('modalEdit')">&times;</span>
        <h3>Edit Pelanggan</h3>

        <form method="POST">
            <input type="hidden" name="id" id="edit_id">

            <input type="text" name="nama" id="edit_nama" required>

            <select name="jenis_kelamin" id="edit_jk" required>
                <option value="L">L</option>
                <option value="P">P</option>
            </select>

            <input type="text" name="telp" id="edit_telp" required>
            <textarea name="alamat" id="edit_alamat" required></textarea>

            <button class="btn edit" name="edit">Update</button>
        </form>
    </div>
</div>

</body>
</html>


<?php
/*-- Tambah Data Pelanggan --*/
if (isset($_POST['tambah'])) {
    mysqli_query($koneksi, "INSERT INTO pelanggan VALUES(
        '".uniqid()."',
        '$_POST[nama]',
        '$_POST[jenis_kelamin]',
        '$_POST[telp]',
        '$_POST[alamat]'
    )");

    echo "<script>alert('Pelanggan berhasil ditambah'); window.location='pelanggan.php';</script>";
}

/* --- Update Data --- */
if (isset($_POST['edit'])) {
    mysqli_query($koneksi, "UPDATE pelanggan SET
        nama='$_POST[nama]',
        jenis_kelamin='$_POST[jenis_kelamin]',
        telp='$_POST[telp]',
        alamat='$_POST[alamat]'
        WHERE id='$_POST[id]'");

    echo "<script>alert('Pelanggan berhasil diperbarui'); window.location='pelanggan.php';</script>";
}

/* --- Hapus Data --- */
if (isset($_GET['hapus'])) {
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id='$_GET[hapus]'");
    echo "<script>alert('Pelanggan berhasil dihapus'); window.location='pelanggan.php';</script>";
}
?>
