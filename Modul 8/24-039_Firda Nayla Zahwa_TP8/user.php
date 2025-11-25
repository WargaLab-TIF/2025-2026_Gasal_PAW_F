<?php 
include 'header.php';
require 'koneksi.php';

if ($_SESSION['level'] != 1) {
    echo "<script>alert('Akses hanya untuk Owner'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Data User</title>

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
function showTambah() {
    document.getElementById("modalTambah").style.display = "block";
}
function showEdit(id, username, password, nama, alamat, hp, level) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_username").value = username;
    document.getElementById("edit_password").value = password;
    document.getElementById("edit_nama").value = nama;
    document.getElementById("edit_alamat").value = alamat;
    document.getElementById("edit_hp").value = hp;
    document.getElementById("edit_level").value = level;

    document.getElementById("modalEdit").style.display = "block";
}
function closeModal(id) {
    document.getElementById(id).style.display = "none";
}
</script>

</head>
<body>

<div class="container">
    <h2>Data User</h2>
    <button class="btn tambah" onclick="showTambah()">+ Tambah User</button>

    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>

        <?php
        $user = mysqli_query($koneksi, "SELECT * FROM user");
        while ($u = mysqli_fetch_assoc($user)) { ?>
        <tr>
            <td><?= $u['id_user'] ?></td>
            <td><?= $u['username'] ?></td>
            <td><?= $u['password'] ?></td>
            <td><?= $u['nama'] ?></td>
            <td><?= $u['alamat'] ?></td>
            <td><?= $u['hp'] ?></td>
            <td><?= $u['level'] ?></td>

            <td>
                <button class="btn edit"
                    onclick="showEdit(
                        '<?= $u['id_user'] ?>',
                        '<?= $u['username'] ?>',
                        '<?= $u['password'] ?>',
                        '<?= $u['nama'] ?>',
                        '<?= htmlspecialchars($u['alamat']) ?>',
                        '<?= $u['hp'] ?>',
                        '<?= $u['level'] ?>'
                    )">
                    Edit
                </button>

                <a class="btn hapus"
                   href='user.php?hapus=<?= $u['id_user'] ?>'
                   onclick="return confirm('Hapus user ini?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
<div class="modal-bg" id="modalTambah">
    <div class="modal-box">
        <span class="close" onclick="closeModal('modalTambah')">&times;</span>
        <h3>Tambah User</h3>

        <form method="POST">

            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="password" placeholder="Password" required>
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <textarea name="alamat" placeholder="Alamat" required></textarea>
            <input type="text" name="hp" placeholder="Nomor HP" required>

            <select name="level" required>
                <option disabled selected>Pilih Level</option>
                <option value="1">Owner</option>
                <option value="2">Kasir</option>
            </select>

            <button class="btn tambah" name="tambah">Simpan</button>
        </form>
    </div>
</div>
<div class="modal-bg" id="modalEdit">
    <div class="modal-box">
        <span class="close" onclick="closeModal('modalEdit')">&times;</span>
        <h3>Edit User</h3>

        <form method="POST">

            <input type="hidden" name="id_user" id="edit_id">

            <input type="text" name="username" id="edit_username" required>
            <input type="text" name="password" id="edit_password" required>
            <input type="text" name="nama" id="edit_nama" required>
            <textarea name="alamat" id="edit_alamat" required></textarea>
            <input type="text" name="hp" id="edit_hp" required>

            <select name="level" id="edit_level" required>
                <option value="1">Owner</option>
                <option value="2">Kasir</option>
            </select>

            <button class="btn edit" name="edit">Update</button>
        </form>
    </div>
</div>

</body>
</html>


<?php
if (isset($_POST['tambah'])) {

    mysqli_query($koneksi, "INSERT INTO user VALUES(
        NULL,
        '$_POST[username]',
        '$_POST[password]',
        '$_POST[nama]',
        '$_POST[alamat]',
        '$_POST[hp]',
        '$_POST[level]'
    )");

    echo "<script>alert('User berhasil ditambah'); window.location='user.php';</script>";
}
if (isset($_POST['edit'])) {

    mysqli_query($koneksi, "UPDATE user SET
        username='$_POST[username]',
        password='$_POST[password]',
        nama='$_POST[nama]',
        alamat='$_POST[alamat]',
        hp='$_POST[hp]',
        level='$_POST[level]'
        WHERE id_user='$_POST[id_user]'");

    echo "<script>alert('User berhasil diperbarui'); window.location='user.php';</script>";
}
if (isset($_GET['hapus'])) {

    mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$_GET[hapus]'");

    echo "<script>alert('User berhasil dihapus'); window.location='user.php';</script>";
}
?>
