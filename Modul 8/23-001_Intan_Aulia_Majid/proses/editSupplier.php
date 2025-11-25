<?php
include "../koneksi.php";

$id = htmlspecialchars($_GET['id']);

$stmt = $koneksi->prepare("SELECT * FROM supplier WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $id = $_POST['id'];

    $stmt = $koneksi->prepare("
        UPDATE supplier SET 
            nama = ?, 
            telp = ?, 
            alamat = ? 
        WHERE id = ?
    ");
    $stmt->bind_param("sssi", $nama, $telp, $alamat, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../supplier.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
</head>
<body>

<h3>Edit Supplier</h3>

<form action="editSupplier.php" method="POST">

    <input type="text" name="id" 
           value="<?= htmlspecialchars($data['id'], ENT_QUOTES, 'UTF-8') ?>" hidden>

    <label>Nama</label><br>
    <input type="text" name="nama" 
           value="<?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label>Telepon</label><br>
    <input type="text" name="telp" 
           value="<?= htmlspecialchars($data['telp'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required><?= htmlspecialchars($data['alamat'], ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

    <button type="submit">Update</button>
    <a href="../supplier.php">Kembali</a>
</form>

</body>
</html>
