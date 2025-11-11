<?php
    require "validate.php";   // fungsi validasi
    $koneksi = mysqli_connect("localhost","root","","store");

    $err=[];
	
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        [$ok,$e] = validasi_nama($nama);if(!$ok){ $err['nama']   = $e;}
        [$ok,$e] = validasi_telp($telp);if(!$ok){ $err['telp']   = $e;}
        [$ok,$e] = validasi_alamat($alamat);if(!$ok){ $err['alamat'] = $e;}
        
        if(!$err){
            $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES('$nama','$telp','$alamat')";
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
    <title>Tambah Supplier</title>
    <style>
        label{display:block;margin:8px 0}
        h2{font-family:arial; color:blue;}
		th{background-color:#27D3F5;}
		.adding{background-color:green; color:white; border-radius: 4px; padding:10px;}
		.del{background-color:red; color:white; border-radius: 4px; padding:10px;}
        .layout{max-width: 275px;margin: 0 auto;padding: 1rem;background-color: #fff;border-radius: 8px;box-shadow: 0 0 20px rgba(0,0,0,0.1);}
    </style>
</head>
<body>
    <main class="layout">
    <h2>Tambah Data Supplier</h2>

    <table> 
        <form method="post" action="">
            <tr>
                <td>Nama:</td>
                <td>
                    <label>
                        <input type="text" name="nama" placeholder="Nama">
                        <?php if(!empty($err['nama'])){echo "<br><small style=color:red>".$err['nama']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>No Telepon:</td>
                <td>
                    <label>
                        <input type="text" name="telp" placeholder="telp">
                        <?php if(!empty($err['telp'])){ echo "<br><small style=color:red>".$err['telp']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Alamat:</td>
                <td>
                    <label>
                        <input type="text" name="alamat" placeholder="alamat">
                        <?php if(!empty($err['alamat'])){ echo "<br><small style=color:red>".$err['alamat']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="adding">Tambahkan</button>
                <a href="index.php"><button type="button" class="del">Batal</button></a></td>
            </tr>
        </form>
    </table>
    </main>
</body>
</html>