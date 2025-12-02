<?php
    require "validate.php";
    $koneksi = mysqli_connect("localhost","root","","penjualan");

    $err=[];

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $barang = $_POST['barang'];
        $idTrans = $_POST['id'];
        $qty = $_POST['qty'];

        [$ok,$e] = validasi_Barang($barang,$idTrans,$koneksi);if(!$ok){ $err['barang']   = $e;}
        [$ok,$e] = validasi_idTrans($idTrans);if(!$ok){ $err['id'] = $e;}
        [$ok,$e] = validasi_QTY($qty); if(!$ok){$err['qty'] = $e;}

        if(!$err){
            $harB=mysqli_query($koneksi,"SELECT harga FROM barang WHERE id=$barang");
            $harSat=(int)mysqli_fetch_assoc($harB)['harga'];
            $hasil=$harSat*$qty;

            $sql = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES('$idTrans','$barang','$hasil','$qty')";
    
            $simpan = mysqli_query($koneksi, $sql);
            if($simpan){
                header('location: index.php');
                mysqli_query($koneksi,"UPDATE transaksi SET total = (SELECT SUM(harga * qty) FROM transaksi_detail WHERE transaksi_detail.transaksi_id = transaksi.id) WHERE id = $idTrans");
                exit;
                }
            }
            } else {
                $pesan = "Tidak dapat menyimpan, data belum lengkap!";
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
    <h2>Tambah Data Transaksi Details</h2>

    <table> 
        <form method="post" action="">
            <tr>
                <td>Barang</td>
                <td>
                    <select name="barang">
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $bar = mysqli_query($koneksi, "SELECT id, nama_barang FROM barang ORDER BY nama_barang");
                        while ($selb = mysqli_fetch_assoc($bar)):
                        ?>
                            <option value="<?= ($selb['id']) ?>">
                                <?=($selb['nama_barang']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <?php if(!empty($err['barang'])){ echo "<br><small style=color:red>".$err['barang']."</small>";}?>
                </td>
            </tr>
            <tr>
                <td>ID Transaksi</td>
                <td>
                    <select name="id">
                        <option value="">-- Pilih ID Transaksi --</option>
                        <?php
                        $tran = mysqli_query($koneksi, "SELECT id FROM transaksi ORDER BY id");
                        while ($selT = mysqli_fetch_assoc($tran)):
                        ?>
                            <option value="<?= $selT['id'] ?>">
                                <?= $selT['id'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <?php if(!empty($err['id'])){ echo "<br><small style=color:red>".$err['id']."</small>";}?>
                </td>
            </tr>
            <tr>
                <td>QTY</td>
                <td>
                    <label>
                        <input type="text" name="qty" placeholder="0">
                        <?php if(!empty($err['qty'])){ echo "<br><small style=color:red>".$err['qty']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="adding">Tambahkan</button>
                    <a href="index.php"><button type="button" class="del">Batal</button></a>
                </td>
            </tr>
        </form>
    </table>
    </main>
</body>
</html>