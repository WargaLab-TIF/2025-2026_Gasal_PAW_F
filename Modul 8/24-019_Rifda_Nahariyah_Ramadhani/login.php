<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
</head>
<body style="font-family: Arial, sans-serif;  display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div style="width: 300px; padding: 20px; border: 1px solid black; 
                margin: 50px auto; background-color: white; border-radius: 5px; text-align: center;">
        <h2 style="text-align: center; color: blue; margin-top: 0;">Login</h2>
        <?php 
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "gagal") {
                echo "<p style='color:red; text-align:center; margin-bottom:15px;'>Username atau Password Salah!</p>";
            } else if ($_GET['pesan'] == "logout") {
                echo "<p style='color:green; text-align:center; margin-bottom:15px;'>Anda berhasil Logout.</p>";
            } else if ($_GET['pesan'] == 'belum_login') {
                echo "<p style='color:red; text-align:center; margin-bottom:15px;'>Anda harus Login terlebih dahulu.</p>";
            }
        }
        ?>
        <form action="cek_login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required
                style="width:100%; padding:10px; margin:10px 0; border:1px solid black; border-radius:4px; box-sizing:border-box;">

            <input type="password" name="password" placeholder="Password" required
                style="width:100%; padding:10px; margin:10px 0; border:1px solid black; border-radius:4px; box-sizing:border-box;">

            <button type="submit"
                style="width:100%; background-color:blue; color:white; padding:10px; border:none; border-radius:4px; cursor:pointer; font-size:16px;">
                <b>LOGIN</b></button>
        </form>
    </div>
</body>
</html>