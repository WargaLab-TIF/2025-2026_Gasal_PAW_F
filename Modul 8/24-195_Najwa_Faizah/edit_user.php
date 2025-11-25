<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM user WHERE id_user = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $nama_user = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['hp'];

    $update = "UPDATE user SET 
                username = '$username', 
                nama = '$nama_user',  
                alamat = '$alamat', 
                hp = '$no_telepon'
                WHERE id_user = '$id'";

    if (mysqli_query($conn, $update)) {
        echo "Data berhasil diperbarui!";
        header("Location: user.php");
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Edit user</h2>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <label for="id_user" class="form-label">ID user</label>
            <input type="text" id="id_user" name="id_user" class="form-control" 
                   value="<?php echo $data['id_user']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" 
                   value="<?php echo $data['username']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama user</label>
            <input type="text" id="nama" name="nama" class="form-control" 
                   value="<?php echo $data['nama']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-control" rows="3" required><?php echo $data['alamat']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="hp" class="form-label">No. Telepon</label>
            <input type="text" id="hp" name="hp" class="form-control" 
                   value="<?php echo $data['hp']; ?>" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
