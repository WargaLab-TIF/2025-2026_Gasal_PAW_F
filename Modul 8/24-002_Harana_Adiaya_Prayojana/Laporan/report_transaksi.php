<?php
    session_start();
    require '../include/conn.php';
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

    $err=[];
    $show=false;

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $tgl_a = $_POST['tgl_a'];
        $tgl_b = $_POST['tgl_b'];

        [$ok,$e] = validasi_tgl($tgl_a);if(!$ok){ $err['tgl_a'] = $e;}
        [$ok,$e] = validasi_tgl($tgl_b);if(!$ok){ $err['tgl_b'] = $e;}

        if(!$err){
            $show=true;
            $rekap = [];
            $total_pendapatan = 0;
            $pelanggan_unik = [];

            $sql = "SELECT t.waktu_transaksi,
                        SUM(t.total) AS total_harian,
                        COUNT(*) AS jumlah_transaksi,
                        COUNT(DISTINCT t.pelanggan_id) AS jumlah_pelanggan,
                        u.nama AS kasir  
                    FROM transaksi t
                    LEFT JOIN user u ON u.id_user = t.user_id
                    WHERE t.waktu_transaksi BETWEEN '$tgl_a' AND '$tgl_b'
                    GROUP BY t.waktu_transaksi
                    ORDER BY t.waktu_transaksi";

            $hasil = mysqli_query($koneksi, $sql);
            while ($row = mysqli_fetch_assoc($hasil)) {
                $rekap[$row['waktu_transaksi']] = $row;
                $total_pendapatan += $row['total_harian'];
                $pelanggan_unik = array_merge($pelanggan_unik, [$row['waktu_transaksi'] => true]);
            }
            $total_pelanggan = count($pelanggan_unik);

            $labels = json_encode(array_keys($rekap));         
            $dataG = json_encode(array_column($rekap, 'total_harian'));
        }
    };
?>
<!doctype html>
<html>
<head>
    <title>laporan_penjualan</title>
    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body>

<div style=" align-items:center; margin-bottom:10px;" class="no-print">
    <h2>SISTEM PENJUALAN</h2>
    <h3>Selamat Datang: <?=$lev['nama']?></h3>
</div>
<main class="layout">
    <?php if ($show):?>
        <?php 
            $no=1;
            if (!$err && $_SERVER['REQUEST_METHOD']=='POST'): 
        ?>
    
    <h3>Rekap Laporan Penjualan Tanggal <?= $tgl_a ?> sampai <?= $tgl_b ?></h3>

    <div class="no-print" style="margin-top:15px">
    <nav class="menu">
    <ul>
        <li><a href="../index.php">Home</a></li>
        <?php if ($wewenang == 1): ?>
        <li><a href="../masters/barang.php">Barang</a></li>
        <li><a href="../masters/supplier.php">Supplier</a></li>
        <li><a href="../masters/pelanggan.php">Pelanggan</a></li>
        <li><a href="../masters/user.php">User</a></li>
        <?php endif; ?>
        <li><a href="../laporan/report_transaksi.php">Laporan</a></li>
        <li><a href="../Transaksi/transaksi.php">Transaksi</a></li>
        <li><a href="../include/logOut.php">LogOut</a></li>
    </ul>
    </nav>
    <br>
        <button onclick="window.print()" class="adding">Cetak PDF</button>
        <button onclick="location.href='report_excel.php?tgl_a=<?=$tgl_a?>&tgl_b=<?=$tgl_b?>'" class='adding'>Download Excel</button>
        <button onclick="location.href='../Transaksi/transaksi.php'" class="adding">Kembali</button>
    </div>

    <canvas id="grafik" height="200"></canvas>

    <div class="result">
        <table border="1" cellpadding="8">
            <tr>
                <th>No</th><th>Tanggal</th><th>Total</th>
            </tr>
            <?php foreach($rekap as $tgl => $r): ?>
            <tr>
                <td><?=$no++;?></td>
                <td><?= $tgl ?></td>
                <td>Rp <?= $r['total_harian'] ?>.00</td>
            </tr>
            <?php endforeach; ?>
        </table>
        <table border="1" cellpadding="8">
            <tr>
                <th>Jumlah Pelanggan</th><th>Jumlah Pendapatan</th>
            </tr>
            <tr>
                <td><?= $total_pelanggan ?> Orang</td>
                <td>Rp <?= number_format($total_pendapatan,0) ?>.00</td>
            </tr>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('grafik');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= $labels ?>,
                datasets: [{
                    label: 'Penjualan Harian',
                    data: <?= $dataG ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } }
            }
        });
        <?php endif;?>
    </script>

    <?php else:?>
    <nav class="menu">
    <ul>
        <li><a href="../index.php">Home</a></li>
        <?php if ($wewenang == 1): ?>
        <li><a href="../masters/barang.php">Barang</a></li>
        <li><a href="../masters/supplier.php">Supplier</a></li>
        <li><a href="../masters/pelanggan.php">Pelanggan</a></li>
        <li><a href="../masters/user.php">User</a></li>
        <?php endif; ?>
        <li><a href="../laporan/report_transaksi.php">Laporan</a></li>
        <li><a href="../Transaksi/transaksi.php">Transaksi</a></li>
        <li><a href="?logout=1">LogOut</a></li>
    </ul>
    </nav>
    <br>
    <h3>Masukan Batas Minimal Dan Maksimal Tanggal Untuk Meng-recap Laporan</h3>
    <table cellpadding="8">
        <form method="post" action="">
        <tr>
            <td>Batas Minimal : </td>
            <td>
                <label>
                    <input type="date" name="tgl_a" class='tgl'>
                    <?php if(!empty($err['tgl_a'])){echo "<br><small style=color:red>".$err['tgl_a']."</small>";}?>
                </label>
            </td></tr>
        <tr>
            <td>Batas Maksimal : </td>
            <td>
                <label>
                    <input type="date" name="tgl_b">
                    <?php if(!empty($err['tgl_b'])){echo "<br><small style=color:red>".$err['tgl_b']."</small>";}?>
                </label>
            </td></tr>
        <tr><td></td>
            <td>
                <div style="display:flex; align-items:center; margin-bottom:10px; justify-content: space-between;">
                    <button class="detail">Tampilkan</button>
                </div>
            </td>
        </tr>
        </form>
    </table>
    <?php
        
    ?>
    <?php endif; ?>
</main>
</body>
</html>