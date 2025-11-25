<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM supplier WHERE id_supplier = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    $update = "UPDATE supplier SET 
                nama = '$nama_supplier', 
                alamat = '$alamat', 
                telp = '$no_telepon' 
                WHERE id_supplier = '$id'";

    if (mysqli_query($conn, $update)) {
        echo "Data berhasil diperbarui!";
        header("Location: supplier.php");
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
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Edit Supplier</h2>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <label for="id_supplier" class="form-label">ID Supplier</label>
            <input type="text" id="id_supplier" name="id_supplier" class="form-control" 
                   value="<?php echo $data['id_supplier']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama Supplier</label>
            <input type="text" id="nama_supplier" name="nama_supplier" class="form-control" 
                   value="<?php echo $data['nama']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-control" rows="3" required><?php echo $data['alamat']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="no_telepon" class="form-label">No. Telepon</label>
            <input type="text" id="no_telepon" name="no_telepon" class="form-control" 
                   value="<?php echo $data['telp']; ?>" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
