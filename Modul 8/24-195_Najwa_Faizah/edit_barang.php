<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM barang WHERE id_barang = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $kode = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $update = "UPDATE barang SET
                kode_barang = '$kode', 
                nama_barang = '$nama_barang', 
                harga = '$harga', 
                stok = '$stok' 
                WHERE id_barang = '$id'";

    if (mysqli_query($conn, $update)) {
        echo "Data berhasil diperbarui!";
        header("Location: barang.php");
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
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Edit Barang</h2>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <label for="id_barang" class="form-label">ID Barang</label>
            <input type="text" id="id_barang" name="id_barang" class="form-control" 
                   value="<?php echo $data['id_barang']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="kode_barang" class="form-label">Kode Barang</label>
            <input type="text" id="kode_barang" name="kode_barang" class="form-control" 
                   value="<?php echo $data['kode_barang']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Stok Barang</label>
            <input id="nama_barang" name="nama_barang" class="form-control" rows="3" value="<?php echo $data['nama_barang']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" id="harga" name="harga" class="form-control" 
                   value="<?php echo $data['harga']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok Barang</label>
            <input id="stok" name="stok" class="form-control" rows="3" value="<?php echo $data['stok']; ?>" required>
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
