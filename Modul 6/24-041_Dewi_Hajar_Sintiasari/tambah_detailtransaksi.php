<?php
include "koneksi.php";

$errors = [];
$transaksi_id = $barang_id = $qty = "";

$sql = 'SELECT * FROM transaksi';
$transaksi = mysqli_query($conn, $sql);
$barang = mysqli_query($conn, "SELECT * FROM barang");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    if(empty($transaksi_id)){
        $errors['transaksi_id'] = "Pilih transaksi.";
    }

    if(empty($barang_id)){
        $errors['barang_id'] = "Pilih barang.";
    }

    if($qty <= 0){
        $errors['qty'] = "Quantity harus lebih dari 0.";
    }

    if(!empty($transaksi_id) && !empty($barang_id)){
        $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
        if(mysqli_num_rows($cek) > 0){
            $errors['barang_id'] = "Barang ini sudah ada dalam transaksi.";
        } else {
            $harga_barang = mysqli_query($conn, "SELECT harga FROM barang WHERE id='$barang_id'");
            $det_harga = mysqli_fetch_assoc($harga_barang);
            $satuan = $det_harga['harga'];
            $harga = $satuan * $qty;
        }
    }

    if(empty($errors)){

        mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) 
                            VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')");

        $total_query = mysqli_query($conn, 
            "SELECT SUM(harga) AS total FROM transaksi_detail WHERE transaksi_id='$transaksi_id'"
        );
        $total_data = mysqli_fetch_assoc($total_query);
        $total_baru = $total_data['total'];

        mysqli_query($conn, 
            "UPDATE transaksi SET total='$total_baru' WHERE id='$transaksi_id'"
        );

        echo "<script>alert('Detail transaksi berhasil ditambahkan! Total transaksi sudah diperbarui.'); 
            window.location='index.php?transaksi_id=$transaksi_id';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Detail Transaksi</title>
<style>
    label { 
        display:block; 
        margin-top:10px; 
    }
    small { 
        color:red; 
    }
    input, select { 
        width:100%; 
        padding:7px; 
        border:1px solid #ccc; 
        border-radius:4px; 
    }
    .container { 
        width:400px; 
        margin:20px auto; 
        padding:5px 20px; 
        border-radius:8px; 
        box-shadow:0 3px 8px rgba(0,0,0,0.1); 
    }
    button { 
        margin-top:15px; 
        padding:10px 15px; 
        background: yellow;
        border:none; 
        border-radius:5px; 
        cursor:pointer; 
        width:100%; }
</style>
</head>
<body style="font-family:Arial;">

<div class="container">
    <h3 style="text-align:center;">Tambah Detail Transaksi</h3>

    <form method="POST">

        <label><b>Barang</b></label>
        <select name="barang_id">
            <option value="">Pilih Barang</option>
            <?php while($b = mysqli_fetch_assoc($barang)): ?>
            <option value="<?= $b['id']; ?>" <?= ($barang_id == $b['id']) ? 'selected' : ''; ?>>
                <?= $b['nama_barang']; ?>
            </option>
            <?php endwhile; ?>
        </select>
        <?php if(isset($errors['barang_id'])) echo "<small>".$errors['barang_id']."</small>"; ?>

        <label><b>ID Transaksi</b></label>
        <select name="transaksi_id">
            <option value="">Pilih ID Transaksi</option>
            <?php while($t = mysqli_fetch_assoc($transaksi)): ?>
            <option value="<?= $t['id']; ?>" <?= ($transaksi_id == $t['id']) ? 'selected' : ''; ?>>
                <?= $t['id']; ?>
            </option>
            <?php endwhile; ?>
        </select>
        <?php if(isset($errors['transaksi_id'])) echo "<small>".$errors['transaksi_id']."</small>"; ?>

        <label><b>Quantity</b></label>
        <input placeholder = 'Masukkan Jumlah Barang' type="number" name="qty" value="<?= $qty; ?>" min="1">
        <?php if(isset($errors['qty'])) echo "<small>".$errors['qty']."</small>"; ?>

        <button type="submit">Tambah Detail Transaksi</button>
    </form>
</div>

</body>
</html>