<?php
// pages/supplier/supplier_edit.php
include "../../includes/config.php";

if (!isset($_SESSION['login']) || $_SESSION['level'] != 1) {
    header("Location: ../../index.php");
    exit;
}

// PENCEGAHAN SQL INJECTION: Type Casting
$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM supplier WHERE id_supplier=$id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];

    // PENCEGAHAN SQL INJECTION: mysqli_real_escape_string()
    $nama = mysqli_real_escape_string($conn, $nama);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $hp = mysqli_real_escape_string($conn, $hp);

    mysqli_query($conn, "UPDATE supplier 
                         SET nama_supplier='$nama', alamat='$alamat', hp='$hp'
                         WHERE id_supplier=$id");
    
    header("Location: supplier_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <?php include "../../includes/navigasi.php"; ?>

    <div class="container" style="width: 450px;">
        <h2 style="text-align:left; color: #007bff; margin-bottom: 25px;">Edit Supplier: <?= htmlspecialchars($data['nama_supplier']) ?></h2>

        <form method="POST">

            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" value="<?= htmlspecialchars($data['nama_supplier']) ?>" required>

            <label>Alamat</label>
            <textarea name="alamat" rows="4"><?= htmlspecialchars($data['alamat']) ?></textarea>
            
            <label>Nomor HP</label>
            <input type="text" name="hp" value="<?= htmlspecialchars($data['hp']) ?>">

            <div style="margin-top: 20px;">
                <button class="btn btn-blue" type="submit">Update</button>
                <a class="btn btn-red" href="supplier_list.php">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>