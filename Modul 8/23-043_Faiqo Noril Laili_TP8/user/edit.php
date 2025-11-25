<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #343a40;
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
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
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background-color: #c82333;
        }

        .alert {
            color: #dc3545;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        require "koneksi.php";

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $user_id = $_GET['id'];
            $query = "SELECT * FROM user WHERE `id_user` = $user_id";
            $result = mysqli_query($koneksi, $query);
            $data = mysqli_fetch_assoc($result);

            if ($data) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $newUsername = $_POST['newUsername'];
                    $newNama = $_POST['newNama'];
                    $newLevel = $_POST['newLevel'];

                    $updateQuery = "UPDATE user SET username = '$newUsername', nama = '$newNama', level = '$newLevel' WHERE `id_user` = $user_id";
                    if (mysqli_query($koneksi, $updateQuery)) {
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<div class='alert'>Error updating data: " . mysqli_error($koneksi) . "</div>";
                    }
                }
        ?>
                <h1>Edit Data User</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="newUsername">Username:</label>
                        <input type="text" name="newUsername" class="form-control" placeholder="Masukkan username baru" value="<?php echo $data['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="newNama">Nama:</label>
                        <input type="text" name="newNama" class="form-control" placeholder="Masukkan nama lengkap" value="<?php echo $data['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="newLevel">Level:</label>
                        <select name="newLevel" class="form-control">
                            <option value="1" <?php echo ($data['level'] == 1) ? 'selected' : ''; ?>>Admin</option>
                            <option value="2" <?php echo ($data['level'] == 2) ? 'selected' : ''; ?>>User Biasa</option>
                            <option value="3" <?php echo ($data['level'] == 3) ? 'selected' : ''; ?>>User Khusus</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
        <?php
            } else {
                echo "<div class='alert'>User tidak ditemukan.</div>";
            }
        } else {
            echo "<div class='alert'>ID user tidak valid atau hilang.</div>";
        }
        ?>
    </div>
</body>

</html>
