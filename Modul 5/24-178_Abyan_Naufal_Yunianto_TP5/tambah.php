<?php
    include "koneksi.php";
    $nama = "";
    $telp = "";
    $alamat = "";
    $error = "";
    $sukses = "";
    function validate_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (isset($_POST['simpan'])) {
        $nama = validate_data($_POST['nama']);
        $telp = validate_data($_POST['telp']);
        $alamat = validate_data($_POST['alamat']);   
        if (empty($nama) || empty($telp) || empty($alamat)) {
            $error = "Semua kolom wajib diisi.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
            $error = "Nama hanya boleh mengandung huruf dan spasi.";
        } elseif (!preg_match("/^[0-9]+$/", $telp)) {
            $error = "Nomor Telepon hanya boleh mengandung angka.";
        } elseif (!preg_match("/[0-9]/", $alamat) || !preg_match("/[a-zA-Z]/", $alamat)) {
            $error = "Alamat harus mengandung minimal 1 angka dan 1 huruf (alfanumerik).";
        }
        if (empty($error)) {
            $sql = "INSERT INTO supplier(nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
            $q1 = mysqli_query($koneksi, $sql);
            
            if($q1) {
                $sukses = "Data berhasil ditambahkan.";
                $nama = "";
                $telp = "";
                $alamat = "";
                header("Location: index.php?status=tambah_sukses");
                exit();
            } else {
                $error = "Gagal menyimpan data ke database: " . mysqli_error($koneksi);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .mx-auto{width:800px}
        .card{margin-top:15px}
    </style>
</head>
<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Tambah Data Master Supplier Baru
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error; ?>
                    </div>
                <?php endif; ?>
                <?php if ($sukses): ?>
                    <div class="alert alert-success" role="alert">
                        <?= $sukses; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>" placeholder="Nama">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telp" class="col-sm-2 col-form-label">Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telp" name="telp" value="<?= htmlspecialchars($telp) ?>" placeholder="Telp">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($alamat) ?>" placeholder="Alamat">
                        </div>
                    </div>

                    <div class="col-12 mt-4 d-flex justify-content-start">
                        <button type="submit" name="simpan" class="btn btn-success me-2">Simpan</button>
                        <a href="index.php" class="btn btn-danger" role="button">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>