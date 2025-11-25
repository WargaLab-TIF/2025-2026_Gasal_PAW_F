<?php
    session_start();
    require "../include/validate.php";
    require_once('../include/conn.php');

    if(!isset($_SESSION['username'])){
        header("Location: ../login.php");
        exit;
    }

    $err=[];

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $tgl = $_POST['tgl'];
        $keterangan = $_POST['keterangan'];
        $total = $_POST['total'];if($total===""){$total=0;};
        $pelanggan=$_POST["pelanggan"] ?? "";

        [$ok,$e] = validasi_tgl($tgl);if(!$ok){ $err['tgl']   = $e;}
        [$ok,$e] = validasi_keterangan($keterangan);if(!$ok){ $err['keterangan'] = $e;}
        [$ok,$e] = validasi_total($total); if(!$ok){$err['total'] = $e;}
        [$ok,$e]= validasi_pelanggan($pelanggan);if(!$ok){$err['pelanggan']=$e;}

        if(!$err){
            $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id,user_id) VALUES('$tgl','$keterangan','$total','$pelanggan',2)";
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: transaksi.php');
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
    <title>Tambah Data Transaksi</title>
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
    <h2>Tambah Data Transaksi</h2>
    <table> 
        <form method="post" action="">
            <tr>
                <td>Waktu Transaksi</td>
                <td>
                    <label>
                        <input type="date" name="tgl" placeholder="tgl">
                        <?php if(!empty($err['tgl'])){echo "<br><small style=color:red>".$err['tgl']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>
                    <label>
                        <textarea type="text" name="keterangan" placeholder="keterangan"></textarea>
                        <?php if(!empty($err['keterangan'])){ echo "<br><small style=color:red>".$err['keterangan']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Total</td>
                <td>
                    <label>
                        <input type="text" name="total" placeholder="0">
                        <?php if(!empty($err['total'])){ echo "<br><small style=color:red>".$err['total']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td>
                    <select name="pelanggan">
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php
                        $res = mysqli_query($koneksi, "SELECT id, nama FROM pelanggan ORDER BY nama");
                        while ($row = mysqli_fetch_assoc($res)):
                        ?>
                            <option value="<?=($row['id']) ?>">
                                <?=($row['nama']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <?php if(!empty($err['pelanggan'])){ echo "<br><small style=color:red>".$err['pelanggan']."</small>";}?>
                </td>
            </tr>
            <tr>
                <td></td><td></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="adding">Tambahkan</button>
                    <a href="transaksi.php"><button type="button" class="del">Batal</button></a>
                </td>
            </tr>
        </form>
    </table>
    </main>
</body>
</html>