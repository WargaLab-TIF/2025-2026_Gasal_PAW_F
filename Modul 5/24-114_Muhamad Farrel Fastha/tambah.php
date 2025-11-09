<?php
function ceknama($field_list, $field_name, &$error) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $error[$field_name] = "Kolom $field_name harus diisi.";
        return false;
    }
    $format = "/^[a-zA-Z\s'-]+$/";
    if (!preg_match($format, $field_list[$field_name])) {
        $error[$field_name] = "Kolom $field_name hanya boleh berisi huruf.";
        return false;
    }
    return true;
}

function cektelp($field_list, $field_num, &$error) {
    if (!isset($field_list[$field_num]) || empty(trim($field_list[$field_num]))) {
        $error[$field_num] = "Kolom $field_num harus diisi.";
        return false;
    }

    if (!is_numeric($field_list[$field_num])) {
        $error[$field_num] = "Kolom $field_num harus berupa angka.";
        return false;
    }

    return true;
}

function cekalamat($field_list, $field_name, &$error) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $error[$field_name] = "Kolom $field_name harus diisi.";
        return false;
    }

    $format = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s.,-]+$/';
    if (!preg_match($format, $field_list[$field_name])) {
        $error[$field_name] = "Kolom $field_name harus berisi huruf dan angka (alfanumerik).";
        return false;
    }
    return true;
}

$conn = mysqli_connect("localhost", "root", "", "store");

$nama = $telp = $alamat = "";
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? "";
    $telp = $_POST['telp'] ?? "";
    $alamat = $_POST['alamat'] ?? "";

    ceknama($_POST, 'nama', $error);
    cektelp($_POST, 'telp', $error);
    cekalamat($_POST, 'alamat', $error);

    if (empty($error)) {
        $data = "INSERT INTO supplier(nama, telp, alamat) values ('$nama', '$telp', '$alamat')";
        if (mysqli_query($conn, $data)) {
            header("location: index.php");
        }
    } else {
        foreach ($error as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
    }
}
?>

<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 350px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        label {
            display: inline-block;
            width: 80px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"] {
            width: 220px;
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .btn-submit {
            background: linear-gradient(to bottom, #4CAF50, #2E7D32);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: linear-gradient(to bottom, #45a049, #1b5e20);
        }

        .btn-cancel {
            background: linear-gradient(to bottom, #ff4444, #cc0000);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            margin-left: 10px;
        }

        .btn-cancel:hover {
            background: linear-gradient(to bottom, #cc0000, #990000);
        }
    </style>
</head>
<body>
    <h3>Tambah Data Master Supplier Baru</h3>
    <form action="" method="POST">
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>"><br>

        <label for="telp">Telp</label>
        <input type="number" name="telp" value="<?= htmlspecialchars($telp) ?>"><br>

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>"><br>

        <input type="submit" value="Tambah" class="btn-submit">
        <button type="button" class="btn-cancel" onclick="window.location.href='index.php'">Batal</button>
    </form>
</body>
</html>
