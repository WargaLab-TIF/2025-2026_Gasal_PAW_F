<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $jk = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update = "UPDATE pelanggan SET
                jenis_kelamin = '$jk', 
                nama_pelanggan = '$nama_pelanggan', 
                telp = '$telp', 
                alamat = '$alamat' 
                WHERE id_pelanggan = '$id'";

    if (mysqli_query($conn, $update)) {
        echo "Data berhasil diperbarui!";
        header("Location: pelanggan.php");
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
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Edit Pelanggan</h2>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
            <input type="text" id="id_pelanggan" name="id_pelanggan" class="form-control" 
                   value="<?php echo $data['id_pelanggan']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" 
                   value="<?php echo $data['nama_pelanggan']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <input id="jenis_kelamin" name="jenis_kelamin" class="form-control" rows="3" value="<?php echo $data['jenis_kelamin']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="telp" class="form-label">No Telp</label>
            <input type="text" id="telp" name="telp" class="form-control" 
                   value="<?php echo $data['telp']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input id="alamat" name="alamat" class="form-control" rows="3" value="<?php echo $data['alamat']; ?>" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
