<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

if(isset($_POST['simpan'])){
    // Ambil data sesuai struktur tabel baru
    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga       = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok        = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $nama_supplier = mysqli_real_escape_string($koneksi, $_POST['nama_supplier']);

    // Query Insert ke tabel barang (tanpa satuan & harga_beli)
    $query = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, nama_supplier) 
              VALUES ('$kode_barang', '$nama_barang', '$harga', '$stok', '$nama_supplier')";
    
    $simpan = mysqli_query($koneksi, $query);

    if($simpan){
        header("location:../home.php?page=barang&pesan=berhasil_tambah");
    }else{
        header("location:../home.php?page=barang&pesan=gagal_tambah");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 30px; border-radius: 8px; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { border-bottom: 2px solid #ddd; padding-bottom: 10px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; font-size: 16px; margin-right: 10px; text-decoration: none; display: inline-block;}
        .btn-primary { background-color: #007bff; }
        .btn-secondary { background-color: #6c757d; }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Data Barang</h2>
    
    <form method="POST" action="">
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" placeholder="Contoh: BRG001" required>
        </div>
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>
        </div>
        <div class="form-group">
            <label>Harga Satuan</label>
            <input type="number" name="harga" required min="0">
        </div>
        <div class="form-group">
            <label>Stok Awal</label>
            <input type="number" name="stok" required min="0">
        </div>
        <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" placeholder="Contoh: PT. Sumber Berkah" required>
        </div>
        
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="../home.php?page=barang" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>