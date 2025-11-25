<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

if(isset($_GET['id'])){
    $id_barang = mysqli_real_escape_string($koneksi, $_GET['id']);
    $data = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
    $d = mysqli_fetch_assoc($data);
    
    if(!$d) {
        header("location:../home.php?page=barang&pesan=data_tidak_ditemukan");
        exit();
    }
} else {
    header("location:../home.php?page=barang");
    exit();
}

if(isset($_POST['update'])){
    $id_barang_update = mysqli_real_escape_string($koneksi, $_POST['id_barang']);
    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $harga       = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok        = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $nama_supplier = mysqli_real_escape_string($koneksi, $_POST['nama_supplier']);
    $query = "UPDATE barang SET 
        kode_barang='$kode_barang', 
        nama_barang='$nama_barang', 
        harga='$harga', 
        stok='$stok',
        nama_supplier='$nama_supplier' 
        WHERE id_barang='$id_barang_update'";

    $update = mysqli_query($koneksi, $query);

    if($update){
        header("location:../home.php?page=barang&pesan=berhasil_edit");
    }else{
        header("location:../home.php?page=barang&pesan=gagal_edit");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
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
    <h2>Edit Data Barang</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>">
        
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" value="<?php echo htmlspecialchars($d['kode_barang']); ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?php echo htmlspecialchars($d['nama_barang']); ?>" required>
        </div>
        <div class="form-group">
            <label>Harga Satuan</label>
            <input type="number" name="harga" value="<?php echo $d['harga']; ?>" required min="0">
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="<?php echo $d['stok']; ?>" required min="0">
        </div>
        <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" value="" required>
            
        </div>
        
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="../home.php?page=barang" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>