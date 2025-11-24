<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

session_start();
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: /praktikum 8/24-114_Muhammad_Farrel_Fastha/login.php");
        exit;
    }

if (!isset($_GET['id'])) {
    echo "ID supplier tidak valid!";
    exit;
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare($conn, "SELECT * FROM supplier WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result_query = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result_query) > 0) {
    $result = mysqli_fetch_assoc($result_query);
} else {
    echo "Data supplier tidak ditemukan!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp   = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $stmt_update = mysqli_prepare($conn,
        "UPDATE supplier SET nama=?, telp=?, alamat=? WHERE id=?"
    );
    mysqli_stmt_bind_param($stmt_update, "sssi", $nama, $telp, $alamat, $id);

    if (mysqli_stmt_execute($stmt_update)) {
        header("Location: supplier.php");
        exit;
    } else {
        echo "Gagal mengupdate data!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 { text-align: center; }
        label { font-weight: bold; margin-top: 10px; display: block; }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
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
        .btn-cancel {
            background: gray;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<form action="" method="POST">
    <h2>Edit Supplier</h2>

    <div class="mb-3">
        <label>Nama Supplier</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($result['nama']); ?>" required>
    </div>

    <div class="mb-3">
        <label>No Telepon</label>
        <input type="text" name="telp" value="<?= htmlspecialchars($result['telp']); ?>" required>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" required><?= htmlspecialchars($result['alamat']); ?></textarea>
    </div>

    <button type="submit">Update Supplier</button>
    <button type="button" class="btn-cancel" onclick="window.location.href='supplier.php'">Batal</button>
</form>

</body>
</html>
