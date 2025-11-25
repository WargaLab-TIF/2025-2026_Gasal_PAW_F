<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) {
    header("location:../home.php?pesan=akses_ditolak");
    exit(); 
}

// 1. Ambil data lama
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $data = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
    $d = mysqli_fetch_assoc($data);
    
    if(!$d) {
        header("location:../home.php?page=pelanggan&pesan=data_tidak_ditemukan");
        exit();
    }
} else {
    header("location:../home.php?page=pelanggan");
    exit();
}

// 2. Proses Update
if(isset($_POST['update'])){
    $id_up = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);

    // Update kolom no_telp
    $query = "UPDATE pelanggan SET 
        nama_pelanggan='$nama', 
        alamat='$alamat', 
        no_telp='$telp'
        WHERE id_pelanggan='$id_up'";

    if(mysqli_query($koneksi, $query)){
        header("location:../home.php?page=pelanggan&pesan=berhasil_edit");
    }else{
        header("location:../home.php?page=pelanggan&pesan=gagal_edit");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pelanggan</title>
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
    <h2>Edit Data Pelanggan</h2>
    
    <form method="POST" action="">
        <input type="hidden" name="id_pelanggan" value="<?php echo $d['id_pelanggan']; ?>">
        
        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" value="<?php echo htmlspecialchars($d['nama_pelanggan']); ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required rows="3"><?php echo htmlspecialchars($d['alamat']); ?></textarea>
        </div>
        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="no_telp" value="<?php echo htmlspecialchars($d['no_telp']); ?>" required>
        </div>
        
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="../home.php?page=pelanggan" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>