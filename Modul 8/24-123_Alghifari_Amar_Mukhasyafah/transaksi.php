<?php
include "conn.php";
include "cek_session.php";

$link_back = ($_SESSION['level'] == 1) ? "admin.php" : "user.php";

// --- LOGIC HAPUS TRANSAKSI (Rollback Stok) ---
if (isset($_GET['hapus'])) {
    if ($_SESSION['level'] != 1) { 
        echo "<script>alert('Hanya Admin yang boleh menghapus transaksi!'); window.location='transaksi.php';</script>"; exit();
    }
    
    $id_transaksi = $_GET['hapus'];

    // 1. Ambil detail barang apa saja yang dibeli di transaksi ini
    $q_detail = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id = '$id_transaksi'");
    
    // 2. Kembalikan stok barang
    while($d = mysqli_fetch_assoc($q_detail)){
        $qty = $d['qty'];
        $id_brg = $d['barang_id'];
        mysqli_query($conn, "UPDATE barang SET stok = stok + $qty WHERE id = '$id_brg'");
    }

    // 3. Hapus data di database (Detail dulu baru Headernya karena Relasi)
    mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id = '$id_transaksi'");
    mysqli_query($conn, "DELETE FROM transaksi WHERE id = '$id_transaksi'"); // Hapus header transaksi

    // Hapus juga pembayaran jika ada relasi (opsional sesuai DB)
    mysqli_query($conn, "DELETE FROM pembayaran WHERE transaksi_id = '$id_transaksi'");

    echo "<script>alert('Transaksi Dibatalkan & Stok Dikembalikan!'); window.location='transaksi.php';</script>";
}


// --- LOGIC KERANJANG BELANJA (Create) ---
if (!isset($_SESSION['keranjang'])) { $_SESSION['keranjang'] = []; }

if (isset($_POST['tambah'])) {
    $id = $_POST['barang_id'];
    $qty = $_POST['qty'];
    
    // Cek Stok Database
    $cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT stok FROM barang WHERE id='$id'"));
    if($cek['stok'] >= $qty){
        if (isset($_SESSION['keranjang'][$id])) { $_SESSION['keranjang'][$id] += $qty; } 
        else { $_SESSION['keranjang'][$id] = $qty; }
    } else {
        echo "<script>alert('Stok Kurang!');</script>";
    }
}

if (isset($_GET['reset'])) { $_SESSION['keranjang'] = []; header("Location: transaksi.php"); }

if (isset($_POST['checkout'])) {
    $pelanggan = $_POST['pelanggan_id'];
    $ket = $_POST['keterangan'];
    $tgl = date('Y-m-d');
    
    // Cari ID User yang sedang login
    $u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_user FROM user WHERE username='$_SESSION[username]'"));
    $user_id = $u['id_user'];

    // 1. Buat Transaksi Header (Total 0 dulu)
    mysqli_query($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES ('$tgl', '$ket', 0, '$pelanggan', '$user_id')");
    $transaksi_id = mysqli_insert_id($conn);

    $total_akhir = 0;
    
    // 2. Loop Keranjang
    foreach ($_SESSION['keranjang'] as $id_brg => $qty) {
        $b = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id='$id_brg'"));
        $harga = $b['harga'];
        $subtotal = $harga * $qty;
        $total_akhir += $subtotal;

        // Insert Detail
        mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$id_brg', '$harga', '$qty')");
        
        // Kurangi Stok
        mysqli_query($conn, "UPDATE barang SET stok = stok - $qty WHERE id='$id_brg'");
    }

    // 3. Update Total
    mysqli_query($conn, "UPDATE transaksi SET total='$total_akhir' WHERE id='$transaksi_id'");
    
    $_SESSION['keranjang'] = [];
    echo "<script>alert('Transaksi Sukses!'); window.location='transaksi.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>
    <style>
        body{font-family:sans-serif;padding:20px} .box{border:1px solid #ccc;padding:15px;margin-bottom:20px;background:#f9f9f9}
        table{width:100%;border-collapse:collapse;margin-top:10px} th,td{border:1px solid #ddd;padding:8px} th{background:#333;color:white}
    </style>
</head>
<body>
    <a href="<?php echo $link_back; ?>">&larr; Dashboard</a>
    <h2>Transaksi Penjualan</h2>

    <div class="box">
        <h3>Input Transaksi Baru</h3>
        <form method="post">
            Barang: 
            <select name="barang_id" required>
                <?php
                $brg = mysqli_query($conn, "SELECT * FROM barang WHERE stok > 0");
                while($b = mysqli_fetch_assoc($brg)){
                    echo "<option value='$b[id]'>$b[nama_barang] (Rp $b[harga] | Stok: $b[stok])</option>";
                }
                ?>
            </select>
            Qty: <input type="number" name="qty" value="1" min="1" style="width:50px">
            <button type="submit" name="tambah">Masuk Keranjang</button>
        </form>

        <table style="background:white;">
            <tr><th>Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
            <?php
            $tot = 0;
            if(!empty($_SESSION['keranjang'])){
                foreach($_SESSION['keranjang'] as $id=>$qty){
                    $d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id='$id'"));
                    $sub = $d['harga']*$qty;
                    $tot += $sub;
                    echo "<tr><td>$d[nama_barang]</td><td>$d[harga]</td><td>$qty</td><td>$sub</td></tr>";
                }
            } else { echo "<tr><td colspan='4'>Keranjang Kosong</td></tr>"; }
            ?>
            <tr><th colspan="3">Total</th><th><?= number_format($tot) ?></th></tr>
        </table>
        
        <?php if(!empty($_SESSION['keranjang'])): ?>
        <form method="post" style="margin-top:10px;">
            Pelanggan: 
            <select name="pelanggan_id">
                <?php
                $p = mysqli_query($conn, "SELECT * FROM pelanggan");
                while($pl = mysqli_fetch_assoc($p)){ echo "<option value='$pl[id]'>$pl[nama]</option>"; }
                ?>
            </select>
            Ket: <input type="text" name="keterangan" placeholder="Keterangan">
            <button type="submit" name="checkout" style="background:green;color:white;padding:5px 10px;">BAYAR SEKARANG</button>
            <a href="transaksi.php?reset=true" style="color:red;margin-left:10px;">Batal</a>
        </form>
        <?php endif; ?>
    </div>

    <h3>Riwayat Transaksi Terakhir</h3>
    <table>
        <tr><th>ID</th><th>Tgl</th><th>Pelanggan</th><th>Total</th><th>Kasir</th><th>Aksi</th></tr>
        <?php
        $hist = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama as n_pel, user.nama as n_kasir FROM transaksi JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id JOIN user ON transaksi.user_id = user.id_user ORDER BY id DESC LIMIT 10");
        while($h = mysqli_fetch_assoc($hist)){
            echo "<tr>
                <td>$h[id]</td>
                <td>$h[waktu_transaksi]</td>
                <td>$h[n_pel]</td>
                <td>Rp ".number_format($h['total'])."</td>
                <td>$h[n_kasir]</td>
                <td>";
            
            // Tombol Hapus hanya untuk Admin
            if($_SESSION['level'] == 1){
                echo "<a href='transaksi.php?hapus=$h[id]' style='color:red' onclick=\"return confirm('Batalkan transaksi ini? Stok barang akan dikembalikan.')\">Batalkan/Hapus</a>";
            } else {
                echo "-";
            }
            echo "</td></tr>";
        }
        ?>
    </table>
</body>
</html>