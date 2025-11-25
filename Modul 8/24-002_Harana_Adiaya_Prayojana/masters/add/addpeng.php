<?php
    session_start();
    require_once('../../include/conn.php');
    require_once('../../include/validate.php');

    function generateRandomString($length = 20) {
    // Generate cryptographically secure random bytes
    $bytes = random_bytes(ceil($length / 2)); 
    
    // Convert the random bytes to a hexadecimal string
    $hexString = bin2hex($bytes);
    
    // Return the desired length of the string
    return substr($hexString, 0, $length);
    }
    if(!isset($_SESSION['username'])){
    header("Location: ../../login.php");
    exit;
    }

    $user= $_SESSION['username'];
    $sql="SELECT * FROM user WHERE username='$user'";
    $tem=mysqli_query($koneksi, $sql);
    $lev=mysqli_fetch_array($tem);
    $wewenang=$lev['level'];

    if($wewenang > 1){
        $_SESSION['pesan']="Anda Bukan owner";
    header("Location: ../../login.php");
    exit;
    }

    $err=[];

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $id=generateRandomString(20);
        $nama = $_POST['nama'];
        $jk= $_POST['jk'];
        $telp = $_POST['telp'];
        $alamat=$_POST['alamat'];

        [$ok,$e] = validasi_Null($nama);if(!$ok){ $err['nama']= $e;}
        [$ok,$e] = validasi_Null($jk);if(!$ok){ $err['jk']= $e;}
        [$ok,$e] = validasi_hp($telp);if(!$ok){ $err['telp']= $e;}
        [$ok,$e] = validasi_Null($alamat);if(!$ok){ $err['alamat']= $e;}

        if(!$err){
            $sql = "INSERT INTO pelanggan (id,nama, jenis_kelamin, telp, alamat) VALUES('$id','$nama','$jk','$telp','$alamat')";
            $simpan = mysqli_query($koneksi, $sql);
            header('location: ../pelanggan.php');
            exit;
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
?> 
<!doctype html>
<html>
<head>
    <title>Tambah User</title>
    
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <main class="layout">
    <h2>Tambah User Baru</h2>

    <table> 
        <form method="post" action="">
            <tr>
                <td>Nama : </td>
                <td>
                    <label>
                        <input type="text" name="nama">
                        <?php if(!empty($err['nama'])){echo "<br><small style=color:red>".$err['nama']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <label>
                        Laki-laki<input type="radio" name="jk" value="L" checked>Perempuan<input type="radio" name="jk" value="P">
                    </label>
                </td>
            </tr>
            <tr>
                <td>telp : </td>
                <td>
                    <label>
                        <input type="text" name="telp">
                        <?php if(!empty($err['telp'])){ echo "<br><small style=color:red>".$err['telp']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Alamat : </td>
                <td>
                    <label>
                        <textarea type="text" name="alamat"></textarea>
                        <?php if(!empty($err['alamat'])){ echo "<br><small style=color:red>".$err['alamat']."</small>";}?>
                    </label>
                </td>
            </tr>
                <td></td><td></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="adding">Tambahkan</button>
                    <a href="../pelanggan.php"><button type="button" class="del">Batal</button></a>
                </td>
            </tr>
        </form>
    </table>
    </main>
</body>
</html>