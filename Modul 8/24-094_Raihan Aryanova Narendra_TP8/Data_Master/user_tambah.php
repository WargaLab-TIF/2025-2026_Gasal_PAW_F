<?php 
include '../cek_session.php'; 
include '../koneksi.php';

if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password_input = mysqli_real_escape_string($koneksi, $_POST['password']);
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);

    // PERBAIKAN: Gunakan password_hash untuk mengenkripsi password sebelum disimpan
    // Bukan password_verify (itu untuk login)
    $password_hash = password_hash($password_input, PASSWORD_DEFAULT);

    // Query Insert
    $simpan = mysqli_query($koneksi, "INSERT INTO user (nama, username, password, level) 
        VALUES ('$nama', '$username', '$password_hash', '$level')");

    if($simpan){
        // Redirect disesuaikan agar kembali ke halaman list user
        header("location:../home.php?page=user&pesan=berhasil_tambah");
    }else{
        header("location:../home.php?page=user&pesan=gagal_tambah");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data User</title>
    <style>
        /* CSS Sama seperti sebelumnya */
        body { background: #f4f4f4; font-family: Arial, sans-serif; margin: 0; }
        .container { max-width: 450px; background: white; margin: 40px auto; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { margin: 0 0 20px 0; }
        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; }
        label { margin-bottom: 5px; font-weight: bold; }
        input, select { padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; }
        .btn { display: inline-block; padding: 10px 16px; border-radius: 6px; text-decoration: none; color: white; font-size: 14px; margin-top: 10px; border: none; cursor: pointer; }
        .btn-primary { background: #007bff; }
        .btn-secondary { background: #6c757d; }
        .btn:hover { opacity: 0.85; }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Data User</h2>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Level Akses</label>
            <select name="level" required>
                <option value="">Pilih Level</option>
                <option value="1">1 - Owner</option>
                <option value="2">2 - Kasir</option>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="../home.php?page=user" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>