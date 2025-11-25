<?php 
include '../koneksi.php'; 

$id_user = '';
$d = [];

// Cek apakah parameter ID ada
if(isset($_GET['id'])){
    $id_user = mysqli_real_escape_string($koneksi, $_GET['id']);
    $data_user = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
    $d = mysqli_fetch_assoc($data_user);
    
    // Jika data tidak ditemukan
    if(!$d) {
        echo "<script>alert('Data tidak ditemukan');window.location='../home.php?page=user';</script>";
        exit();
    }
} else {
    // Jika diakses langsung tanpa ID
    header("location:../home.php?page=user");
    exit();
}

if(isset($_POST['update'])){
    $id_user_update = mysqli_real_escape_string($koneksi, $_POST['id_user']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);
    $password_baru = $_POST['password_baru'];
    
    // Mulai query update dasar
    $query = "UPDATE user SET nama='$nama', username='$username', level='$level'";
    
    // PERBAIKAN: Cek jika password diisi, maka hash password baru dan tambahkan ke query
    if(!empty($password_baru)){
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
        $query .= ", password='$password_hash'";
    }
    
    $query .= " WHERE id_user='$id_user_update'";
    
    $update = mysqli_query($koneksi, $query);
    
    if($update){
        header("location:../home.php?page=user&pesan=berhasil_edit");
    }else{
        header("location:../home.php?page=user&pesan=gagal_edit");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data User</title>
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
    <h2>Edit Data User</h2>

    <form method="POST" action="">
        <input type="hidden" name="id_user" value="<?php echo $d['id_user']; ?>">

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($d['nama']); ?>" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($d['username']); ?>" required>
        </div>

        <div class="form-group">
            <label>Password Baru (kosongkan jika tidak diubah)</label>
            <input type="password" name="password_baru" placeholder="Biarkan kosong jika tetap">
        </div>

        <div class="form-group">
            <label>Level Akses</label>
            <select name="level" required>
                <option value="1" <?php echo ($d['level'] == 1) ? 'selected' : ''; ?>>1 - Owner</option>
                <option value="2" <?php echo ($d['level'] == 2) ? 'selected' : ''; ?>>2 - Kasir</option>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="../home.php?page=user" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>