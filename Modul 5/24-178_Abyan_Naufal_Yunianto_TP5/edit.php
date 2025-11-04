<?php
    include "koneksi.php";
    $id = "";
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
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql_select = "SELECT * FROM supplier WHERE id = '$id'";
        $q_select = mysqli_query($koneksi, $sql_select);
        $data = mysqli_fetch_array($q_select);   
        if ($data) {
            $nama = $data['nama'];
            $telp = $data['telp'];
            $alamat = $data['alamat'];
        } else {
            $error = "Data tidak ditemukan.";
        }
    } else {
        header("Location: index.php");
        exit();
    }
    if (isset($_POST['update'])) {
        $nama_baru = validate_data($_POST['nama']);
        $telp_baru = validate_data($_POST['telp']);
        $alamat_baru = validate_data($_POST['alamat']);

        $nama = $nama_baru;
        $telp = $telp_baru;
        $alamat = $alamat_baru;   
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
            $sql_update = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
            $q_update = mysqli_query($koneksi, $sql_update);
            
            if($q_update) {
                $sukses = "Data berhasil diupdate.";
                header("Location: index.php?status=edit_sukses");
                exit();
            } else {
                $error = "Gagal mengupdate data: " . mysqli_error($koneksi);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Master Supplier</title>
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
                Edit Data Master Supplier
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
                        <button type="submit" name="update" class="btn btn-success me-2">Update</button>
                        <a href="index.php" class="btn btn-danger" role="button">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>