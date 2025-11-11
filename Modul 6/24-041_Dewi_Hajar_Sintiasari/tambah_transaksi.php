<?php
include 'koneksi.php';

$sql = 'SELECT * FROM pelanggan';
$pelanggan = mysqli_query($conn, $sql);
$errors = [];
$waktu_transaksi = $keterangan = $pelanggan_id = '';

if($_SERVER['REQUEST_METHOD']=='POST'){

    $waktu_transaksi = $_POST['waktu_transaksi'];
    $today = date('Y-m-d');

    if($waktu_transaksi < $today){
        $errors['waktu_transaksi'] = "Transaksi tidak boleh kurang dari hari ini.";
    }

    $keterangan = trim($_POST['keterangan']);
    if(strlen($keterangan) < 3){
        $errors['keterangan'] = "Keterangan minimal 3 karakter.";
    }

    $total = 0;

    if(empty($_POST['pelanggan_id'])){
        $errors['pelanggan_id'] = "Pilih Pelanggan.";
    } else {
        $pelanggan_id = $_POST['pelanggan_id'];

    }

    if(empty($errors)){
        $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";

        if(mysqli_query($conn, $sql)){
            $id = mysqli_insert_id($conn);
            header('Location: index.php?transaksi_id=$id');
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
    <style>
        label { 
            display:block; 
            margin-top:10px; 
        }
        small { 
            color:red; 
        }
        input, textarea, select { 
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
            width: 100%;
        }
    </style>
</head>
<body style = 'font-family:Arial;'>

<div class="container">
    <h3 style="text-align:center;">Tambah Transaksi</h3>

    <form method="POST">

        <label><b>Waktu Transaksi</b></label>
        <input type="date" name="waktu_transaksi" value="<?php echo $waktu_transaksi; ?>">
        <?php if(isset($errors['waktu_transaksi'])) echo '<small>'.$errors['waktu_transaksi'].'</small>'; ?>

        <label><b>Keterangan</b></label>
        <textarea name="keterangan" placeholder='Masukkan keterangan transaksi'><?php echo $keterangan; ?></textarea>
        <?php if(isset($errors['keterangan'])) echo '<small>'.$errors['keterangan'].'</small>'; ?>

        <label for=""><b>Total</b></label>
        <input type="number" name="total" id="total" value='0' readonly>

        <label><b>Pelanggan</b></label>
        <select name="pelanggan_id">
            <option value="">Pilih Pelanggan</option>
            <?php foreach($pelanggan as $row) :?>
            <option value="<?= $row['id']; ?>">
            <?= $row['nama'] ?></option>
            <?php endforeach ?>
        </select>
        <?php if(isset($errors['pelanggan_id'])) echo '<small>'.$errors['pelanggan_id'].'</small>'; ?>

        <br>
        <button type="submit">Tambah Transaksi</button>
    </form>
</div>

</body>
</html>