<?php
    session_start();
    if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
    require "../conn.php";
    $id = $_GET['id'];
    $data = mysqli_query($conn, "SELECT * FROM user WHERE id_user = '$id'");
    $row = mysqli_fetch_assoc($data);
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $level = $_POST['level'];
        if(!empty($_POST['password'])){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = "UPDATE user SET nama='$nama', username='$username', password='$password', level='$level' WHERE id_user='$id'";
        } else {
        $query = "UPDATE user SET nama='$nama', username='$username', level='$level' WHERE id_user='$id'";
    }
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('User diupdate!');window.location='datamaster.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit User</title>
        <style>
            body {
                font-family:sans-serif;
                background:#f4f4f4;
                padding:20px;
            }
            .container {
                background:white;
                max-width:500px;
                margin:auto;
                padding:20px;
                border-radius:5px;
                box-shadow:0 0 10px rgba(0,0,0,0.1);
            }
            input, select  {
                width:100%;
                padding:10px;
                margin:10px 0;
                border:1px solid #ddd;
                border-radius:4px;
                box-sizing:border-box;
            }
            button  {
                width:100%;
                padding:10px;
                background:#f39c12;
                color:white;
                border:none;
                border-radius:4px;
                cursor:pointer;
            }
            .back-btn  {
                background:#555;
                margin-top:10px;
                display:block;
                text-align:center;
                text-decoration:none;
                padding:10px;
                border-radius:4px;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Edit User</h2>
            <form method="POST">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= $row['nama'] ?>" required>
                <label>Username</label>
                <input type="text" name="username" value="<?= $row['username'] ?>" required>
                <label>Password (Kosongkan jika tidak diganti)</label>
                <input type="password" name="password">
                <label>Level</label>
                <select name="level">
                    <option value="1" <?= ($row['level']=='Admin')?'selected':'' ?>>Admin</option>
                    <option value="2" <?= ($row['level']=='Kasir')?'selected':'' ?>>Kasir</option>
                </select>
                <button type="submit" name="update">Update</button>
                <a href="datamaster.php" class="back-btn">Kembali</a>
            </form>
        </div>
    </body>
</html>