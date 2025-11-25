<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah/Edit Data User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #343a40;
        }

        input[type="text"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
        }

        input::placeholder,
        textarea::placeholder {
            color: #6c757d;
            opacity: 10; /* Mengatur opasitas placeholder */
        }

        button,
        .btn-secondary {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #7db441;
        }

        .btn-primary:hover {
            background-color: #5aa12a; /* Warna hover yang sesuai */
        }

        .btn-secondary {
            background-color: #dc3545;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px; /* Memberi jarak antara tombol */
        }

        .btn-secondary:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <?php
            require "koneksi.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
                $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
                $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
                $hp = mysqli_real_escape_string($koneksi, $_POST["hp"]);
                $alamat = mysqli_real_escape_string($koneksi, $_POST["alamat"]);
                $level = mysqli_real_escape_string($koneksi, $_POST["level"]);

                if (isset($_GET['id-user']) && is_numeric($_GET['id-user'])) {
                    $user_id = $_GET['id-user'];
                    $query = "UPDATE user SET username='$username', password='$password', nama='$nama', hp='$hp', alamat='$alamat', level='$level' WHERE id_user=$user_id";
                    $message = "Perubahan berhasil disimpan.";
                } else {
                    $query = "INSERT INTO user (username, password, nama, hp, alamat, level) VALUES ('$username', '$password', '$nama', '$hp', '$alamat', '$level')";
                    $message = "Data berhasil ditambahkan.";
                }

                if (mysqli_query($koneksi, $query)) {
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<p style='color:red;'>Error: " . htmlspecialchars($query) . "<br>" . htmlspecialchars(mysqli_error($koneksi)) . "</p>";
                }
            } else {
                if (isset($_GET['id-user']) && is_numeric($_GET['id-user'])) {
                    $user_id = $_GET['id-user'];
                    $query = "SELECT * FROM user WHERE id_user = $user_id";
                    $result = mysqli_query($koneksi, $query);
                    $data = mysqli_fetch_assoc($result);

                    if ($data) {
                        echo "<h1>Edit Data User</h1>";
                    } else {
                        echo "<p style='color:red;'>Data pengguna tidak ditemukan.</p>";
                    }
                } else {
                    echo "<h1>Tambah Data Master User</h1>";
                }
            }
            ?>
        </div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . (isset($data) ? '?id-user=' . urlencode($user_id) : ''); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username" value="<?php echo isset($data) ? htmlspecialchars($data['username']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password" value="<?php echo isset($data) ? htmlspecialchars($data['password']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama User:</label>
                <input type="text" name="nama" id="nama" placeholder="Nama User" value="<?php echo isset($data) ? htmlspecialchars($data['nama']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" rows="4"><?php echo isset($data) ? htmlspecialchars($data['alamat']) : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="hp">Nomor HP:</label>
                <input type="text" name="hp" id="hp" placeholder="Nomor HP" value="<?php echo isset($data) ? htmlspecialchars($data['hp']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="level">Level:</label>
                <select name="level" id="level" required>
                    <option value="" disabled <?php echo (!isset($data)) ? 'selected' : ''; ?>>-- Pilih Jenis User --</option>
                    <option value="1" <?php echo (isset($data) && $data['level'] == 1) ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?php echo (isset($data) && $data['level'] == 2) ? 'selected' : ''; ?>>User Biasa</option>
                    <option value="3" <?php echo (isset($data) && $data['level'] == 3) ? 'selected' : ''; ?>>User Khusus</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">
                <?php echo isset($data) ? 'Simpan Perubahan' : 'Simpan'; ?>
            </button>
            <a href="index.php" class="btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>
