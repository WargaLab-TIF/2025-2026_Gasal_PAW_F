<?php
include "../koneksi.php";

$id = htmlspecialchars($_GET['id']);

$stmt = $koneksi->prepare("SELECT * FROM pelanggan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $stmt = $koneksi->prepare("
        UPDATE pelanggan SET 
            nama = ?, 
            telp = ?, 
            alamat = ? 
        WHERE id = ?
    ");
    
    $stmt->bind_param("sssi", $nama, $telp, $alamat, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../pelanggan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
</head>
<body>

<h3>Edit Pelanggan</h3>

<form action="editPelanggan.php?id=<?= htmlspecialchars($id, ENT_QUOTES, 'UTF-8') ?>" method="POST">

    <label>Nama</label><br>
    <input type="text" name="nama" 
           value="<?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label>Telepon</label><br>
    <input type="text" name="telp" 
           value="<?= htmlspecialchars($data['telp'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required><?= htmlspecialchars($data['alamat'], ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

    <button type="submit">Update</button>
    <a href="../pelanggan.php">Kembali</a>
</form>

</body>
</html>
