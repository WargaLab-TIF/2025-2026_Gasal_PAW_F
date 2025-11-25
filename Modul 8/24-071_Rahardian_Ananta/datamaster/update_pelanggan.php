<?php
    session_start();
    if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
    require "../conn.php";
    $id = $_GET['id'];
    $data = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = '$id'");
    $row = mysqli_fetch_assoc($data);
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $jk = $_POST['jenis_kelamin'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $query = "UPDATE pelanggan SET nama='$nama', jenis_kelamin='$jk', telp='$telp', alamat='$alamat' WHERE id='$id'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Pelanggan diupdate!');window.location='datamaster.php';</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Pelanggan</title>
        <style>
            body {
                font-family:sans-serif;
                background:#f4f4f4;
                padding:20px;
            }
            .container {
                background:white;
                max-width:500px;
                margin:auto;
                padding:20px;
                border-radius:5px;
                box-shadow:0 0 10px rgba(0,0,0,0.1);
            }
            input, select, textarea  {
                width:100%;
                padding:10px;
                margin:10px 0;
                border:1px solid #ddd;
                border-radius:4px;
                box-sizing:border-box;
            }
            button  {
                width:100%;
                padding:10px;
                background:#f39c12;
                color:white;
                border:none;
                border-radius:4px;
                cursor:pointer;
            }
            .back-btn  {
                background:#555;
                margin-top:10px;
                display:block;
                text-align:center;
                text-decoration:none;
                padding:10px;
                border-radius:4px;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Edit Pelanggan</h2>
            <form method="POST">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama" value="<?= $row['nama'] ?>" required>
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin">
                    <option value="L-laki" <?= ($row['jenis_kelamin']=='Laki-laki')?'selected':'' ?>>Laki-laki</option>
                    <option value="P" <?= ($row['jenis_kelamin']=='Perempuan')?'selected':'' ?>>Perempuan</option>
                </select>
                <label>No Telp</label>
                <input type="text" name="telp" value="<?= $row['telp'] ?>" required>
                <label>Alamat</label>
                <textarea name="alamat" rows="3" required><?= $row['alamat'] ?></textarea>
                <button type="submit" name="update">Update</button>
                <a href="datamaster.php" class="back-btn">Kembali</a>
            </form>
        </div>
    </body>
</html>