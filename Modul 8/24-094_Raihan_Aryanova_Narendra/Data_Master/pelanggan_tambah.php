<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']); // Ambil dari input name='no_telp'

    // Perbaikan: Kolom database 'no_telp'
    $query = "INSERT INTO pelanggan (nama_pelanggan, alamat, no_telp) VALUES ('$nama', '$alamat', '$telp')";
    
    if(mysqli_query($koneksi, $query)){
        header("location:../home.php?page=pelanggan&pesan=berhasil_tambah");
    }else{
        header("location:../home.php?page=pelanggan&pesan=gagal_tambah");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Pelanggan</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; text-decoration: none; display: inline-block; margin-right: 10px;}
        .btn-primary { background: #007bff; }
        .btn-secondary { background: #6c757d; }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Data Pelanggan</h2>
    
    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="no_telp" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="../home.php?page=pelanggan" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>