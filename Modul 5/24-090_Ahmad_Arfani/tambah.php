<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #cccccc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 60px auto;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 15px;
            box-sizing: border-box; 
        }

        .btn-save {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-save:hover {
            background-color: #0069d9;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 5px;
            transition: background 0.3s;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Data Master Supplier Baru</h2>

        <?php
        $nama = "";
        $telp = "";
        $alamat = "";

        $err_nama = "";
        $err_telp = "";
        $err_alamat = "";

        if (isset($_POST['simpan'])) {
            $nama = trim($_POST['nama']);
            $telp = trim($_POST['telp']);
            $alamat = trim($_POST['alamat']);

            $valid = true;

            // Validasi nama
            if (empty($nama)) {
                $err_nama = "Nama tidak boleh kosong.";
                $valid = false;
            } elseif (!preg_match("/^[a-zA-Z ]+$/", $nama)) {
                $err_nama = "Nama hanya boleh berisi huruf.";
                $valid = false;
            }

            // Validasi telp
            if (empty($telp)) {
                $err_telp = "Telp tidak boleh kosong.";
                $valid = false;
            } elseif (!preg_match("/^[0-9]+$/", $telp)) {
                $err_telp = "Telp hanya boleh berisi angka.";
                $valid = false;
            }

            // Validasi alamat
            if (empty($alamat)) {
                $err_alamat = "Alamat tidak boleh kosong.";
                $valid = false;
            } elseif (!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])[A-Za-z0-9 ]+$/", $alamat)) {
                $err_alamat = "Alamat harus berisi huruf dan angka (alfanumerik).";
                $valid = false;
            }

            if ($valid) {
                mysqli_query($koneksi, "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama','$telp','$alamat')");
                echo "<script>alert('Data berhasil disimpan!');window.location='index.php';</script>";
            }
        }
        ?>

        <form method="POST">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $nama ?>">
            <div class="error"><?= $err_nama ?></div>

            <label>Telp</label>
            <input type="text" name="telp" value="<?= $telp ?>">
            <div class="error"><?= $err_telp ?></div>

            <label>Alamat</label>
            <input type="text" name="alamat" value="<?= $alamat ?>">
            <div class="error"><?= $err_alamat ?></div>

            <button type="submit" name="simpan" class="btn-save">Simpan</button>
            <a href="index.php" class="btn-cancel">Batal</a>
        </form>
    </div>
</body>
</html>