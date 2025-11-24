<?php
    session_start();
    require_once('../include/conn.php');
    require_once('../include/validate.php');

    if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
    }

    $user= $_SESSION['username'];
    $sql="SELECT * FROM user WHERE username='$user'";
    $tem=mysqli_query($koneksi, $sql);
    $lev=mysqli_fetch_array($tem);
    $wewenang=$lev['level'];

    if($wewenang > 1){
    header("Location: ../login.php");
    exit;
    }

    $err=[];

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $alamat=$_POST['alamat'];
        $hp=$_POST['hp'];
        $level=$_POST['level'];

        [$ok,$e] = validasi_Null($username);if(!$ok){ $err['username']= $e;}
        [$ok,$e] = validasi_Null($password);if(!$ok){ $err['password']= $e;}
        [$ok,$e] = validasi_Null($nama);if(!$ok){ $err['nama']= $e;}
        [$ok,$e] = validasi_Null($alamat);if(!$ok){ $err['alamat']= $e;}
        [$ok,$e] = validasi_hp($hp);if(!$ok){ $err['hp']= $e;}
        [$ok,$e] = validasi_Null($level);if(!$ok){ $err['level']= $e;}

        if(!$err){
            $password_m = md5($password);
            $sql = "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES('$username','$password_m','$nama','$alamat','$hp','$level')";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: index.php');
                    exit;
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
?> 
<!doctype html>
<html>
<head>
    <title>Tambah User</title>
    
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main class="layout">
    <h2>Tambah User Baru</h2>

    <table> 
        <form method="post" action="">
            <tr>
                <td>Username</td>
                <td>
                    <label>
                        <input type="text" name="username">
                        <?php if(!empty($err['username'])){echo "<br><small style=color:red>".$err['username']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <label>
                        <input type="text" name="password">
                        <?php if(!empty($err['password'])){ echo "<br><small style=color:red>".$err['password']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Nama User</td>
                <td>
                    <label>
                        <input type="text" name="nama">
                        <?php if(!empty($err['nama'])){ echo "<br><small style=color:red>".$err['nama']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <label>
                        <textarea type="text" name="alamat"></textarea>
                        <?php if(!empty($err['alamat'])){ echo "<br><small style=color:red>".$err['alamat']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Nomor HP</td>
                <td>
                    <label>
                        <input type="text" name="hp">
                        <?php if(!empty($err['hp'])){ echo "<br><small style=color:red>".$err['hp']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td>
                    <select name="level">
                        <option value="">-- Pilih Level --</option>
                        <?php
                        ?>
                            <option value="1">1</option>
                            <option value="2">2</option>
                    </select>
                    <?php if(!empty($err['level'])){ echo "<br><small style=color:red>".$err['level']."</small>";}?>
                </td>
            </tr>
            <tr>
                <td></td><td></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="adding">Tambahkan</button>
                    <a href="user.php"><button type="button" class="del">Batal</button></a>
                </td>
            </tr>
        </form>
    </table>
    </main>
</body>
</html>