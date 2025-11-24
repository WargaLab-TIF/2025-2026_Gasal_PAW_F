<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

if (!isset($_GET['id'])) {
    header("Location: pelanggan.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare($conn, "SELECT * FROM pelanggan WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_stmt_get_result($stmt)->fetch_assoc();

if (!$data) {
    echo "Pelanggan tidak ditemukan!";
    exit;
}

$nama = $data['nama'];
$alamat = $data['alamat'];
$telp = $data['telp'];
$jenis_kelamin = $data['jenis_kelamin'] ?? "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $telp = trim($_POST['telp']);
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? "";

    $update = mysqli_prepare($conn,
        "UPDATE pelanggan SET nama=?, alamat=?, telp=?, jenis_kelamin=? WHERE id=?"
    );

    mysqli_stmt_bind_param($update, "ssssi",
        $nama, $alamat, $telp, $jenis_kelamin, $id
    );

    if (mysqli_stmt_execute($update)) {
        header("Location: pelanggan.php");
        exit();
    } else {
        echo "Gagal mengupdate pelanggan: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Pelanggan</title>

    <style>
        body {
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 380px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        label { margin-top: 8px; font-weight: bold; }
        input, textarea, select {
            width: 100%; padding: 8px; margin-top: 4px;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 6px;
            margin-top: 15px;
            cursor: pointer;
        }
        .btn-save { background: orange; }
        .btn-cancel { background: gray; }
    </style>
</head>
<body>

<form method="POST">
    <h2>Edit Pelanggan</h2>

    <div class="mb-3">
        <label>Nama Pelanggan</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="L" <?= $jenis_kelamin == "L" ? "selected" : "" ?>>Laki-laki</option>
            <option value="P" <?= $jenis_kelamin == "P" ? "selected" : "" ?>>Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Telepon</label>
        <input type="text" name="telp" value="<?= htmlspecialchars($telp) ?>" required>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" rows="3" required><?= htmlspecialchars($alamat) ?></textarea>
    </div>

    <button type="submit">Update Pelanggan</button>
    <button type="button" class="btn-cancel" onclick="window.location.href='pelanggan.php'">Batal</button>

</form>

</body>
</html>
