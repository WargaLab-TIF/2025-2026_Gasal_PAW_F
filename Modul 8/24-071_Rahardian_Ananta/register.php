<?php
    require "conn.php";
    $username = "";
    $password = "";
    $nama_user = "";
    $alamat = "";
    $nomor_hp = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $nama_user = $_POST["nama_user"];
        $alamat = $_POST["alamat"];
        $nomor_hp = $_POST["nomor_hp"];
        $jenis_user = "2";
        $sql = "INSERT INTO tb_user(username, password, nama, alamat, hp, level)
        VALUES('$username', '$password', '$nama_user', '$alamat', '$nomor_hp', '$jenis_user')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Registrasi Berhasil! Silakan Login.');
                window.location = 'login.php';
            </script>";
            exit;
        } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrasi User</title>
        <style>
            *  {
                box-sizing: border-box;
            }
            body  {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f0f2f5;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
                padding: 20px;
            }
            .register-container  {
                background-color: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                width: 100%;
                max-width: 500px;
            }
            .register-container h2  {
                text-align: center;
                color: #333;
                margin-bottom: 20px;
                margin-top: 0;
            }
            label  {
                font-weight: 600;
                font-size: 14px;
                color: #555;
                display: block;
                margin-bottom: 5px;
            }
            input, textarea  {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
                font-family: inherit;
            }
            input:focus, textarea:focus  {
                border-color: #28a745;
                outline: none;
            }
            .btn-group  {
                display: flex;
                gap: 10px;
                margin-top: 10px;
            }
            button  {
                flex: 1;
                padding: 12px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                font-weight: bold;
                transition: opacity 0.3s;
            }
            .btn-simpan  {
                background-color: #28a745;
                color: white;
            }
            .btn-batal  {
                background-color: #dc3545;
                color: white;
                text-decoration: none;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            button:hover, .btn-batal:hover  {
                opacity: 0.9;
            }
        </style>
    </head>
    <body>
        <div class="register-container">
            <h2>Form Registrasi</h2>
            <form method="post">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username ?>" required placeholder="Buat username baru">
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $password ?>" required placeholder="Buat password">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_user" value="<?php echo $nama_user ?>" required placeholder="Nama lengkap Anda">
                <label>Alamat</label>
                <textarea name="alamat" rows="3" placeholder="Alamat lengkap..."><?php echo $alamat ?></textarea>
                <label>Nomor HP</label>
                <input type="text" name="nomor_hp" value="<?php echo $nomor_hp ?>" placeholder="Contoh: 0812...">
                <!-- INPUT PILIHAN LEVEL/JENIS USER SUDAH DIHAPUS -->
                <div class="btn-group">
                    <a href="login.php" class="btn-batal" style="width: 100%;">Batal</a>
                    <button type="submit" class="btn-simpan">Daftar</button>
                </div>
            </form>
        </div>
    </body>
</html>