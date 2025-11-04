<?php
include "koneksi.php";

$id = $_GET['id'] ?? null;
$errors = [];
$pesan = "";

// Ambil data lama dari database jika ID valid
if ($id) {
    $data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
    if ($data && mysqli_num_rows($data) > 0) {
        $row = mysqli_fetch_assoc($data);
        // Inisialisasi nilai awal
        $nama = $row['nama'];
        $telp = $row['telp'];
        $alamat = $row['alamat'];
    } else {
        $errors[] = "Data supplier tidak ditemukan!";
        $nama = $telp = $alamat = "";
    }
} else {
    $errors[] = "ID tidak ditemukan.";
    $nama = $telp = $alamat = "";
}

// Proses saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input user
    $nama = trim($_POST['nama'] ?? "");
    $telp = trim($_POST['telp'] ?? "");
    $alamat = trim($_POST['alamat'] ?? "");

    // Validasi
    if ($nama === "") {
        $errors[] = "Nama tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $errors[] = "Nama hanya boleh huruf dan spasi.";
    }

    if ($telp === "") {
        $errors[] = "Telp tidak boleh kosong.";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $errors[] = "Telp hanya boleh angka.";
    }

    if ($alamat === "") {
        $errors[] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match("/[a-zA-Z]/", $alamat) || !preg_match("/[0-9]/", $alamat)) {
        $errors[] = "Alamat harus alfanumerik (minimal 1 huruf dan 1 angka).";
    }

    // Jika tidak ada error maka update ke database
    if (empty($errors)) {
        mysqli_query($koneksi, "UPDATE supplier SET 
            nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");
        $pesan = "Data berhasil diperbarui!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        label { display: block; margin-top: 8px; }
        input { width: 300px; padding: 5px; }
        button { padding: 6px 12px; margin-top: 10px; cursor: pointer; }
        .btn-simpan { background: #28a745; color: white; border: none; }
        .btn-batal { background: #dc3545; color: white; border: none; margin-left: 5px; }
        .error { color: red; margin-top: 10px; }
        .pesan { color: green; margin-top: 10px; }
        h3 { color: #8dadddff; }
        table { border-collapse: collapse; }
        td { padding: 5px; }
    </style>
</head>
<body>

<h3>Edit Data Supplier</h3>

<?php if (!empty($errors)): ?>
    <div class="error">
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($pesan): ?>
    <div class="pesan"><?= htmlspecialchars($pesan) ?></div>
<?php endif; ?>

<form method="post">
    <table>
        <tr>
            <td><label>Nama</label></td>
            <td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>"></td>
        </tr>
        <tr>
            <td><label>Telp</label></td>
            <td><input type="text" name="telp" value="<?= htmlspecialchars($telp) ?>"></td>
        </tr>
        <tr>
            <td><label>Alamat</label></td>
            <td><input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button class="btn-simpan" type="submit">Simpan</button>
                <button class="btn-batal" type="button" onclick="window.location.href='index.php';">Batal</button>
            </td>
        </tr>
    </table>
</form>

</body>
</html>