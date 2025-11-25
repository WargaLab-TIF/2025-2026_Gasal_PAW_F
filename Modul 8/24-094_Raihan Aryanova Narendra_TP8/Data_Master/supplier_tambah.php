<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) exit();

if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $query = "INSERT INTO supplier (nama_supplier, alamat, no_telp) VALUES ('$nama', '$alamat', '$telp')";
    if(mysqli_query($koneksi, $query)){
        header("location:../home.php?page=supplier&pesan=tambah_sukses");
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Tambah Supplier</title></head>
<body style="font-family:sans-serif; padding:20px; background:#f4f4f4;">
<div style="background:white; padding:30px; max-width:600px; margin:0 auto; border-radius:8px;">
    <h2>Tambah Supplier</h2>
    <form method="POST">
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight:bold;">Nama Supplier</label>
            <input type="text" name="nama" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight:bold;">Alamat</label>
            <textarea name="alamat" required style="width:100%; padding:8px;"></textarea>
        </div>
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight:bold;">No. Telepon</label>
            <input type="text" name="telp" required style="width:100%; padding:8px;">
        </div>
        <button type="submit" name="simpan" style="background:#007bff; color:white; padding:10px 20px; border:none; border-radius:4px; cursor:pointer;">Simpan</button>
        <a href="../home.php?page=supplier" style="text-decoration:none; margin-left:10px; color:#555;">Batal</a>
    </form>
</div>
</body>
</html>