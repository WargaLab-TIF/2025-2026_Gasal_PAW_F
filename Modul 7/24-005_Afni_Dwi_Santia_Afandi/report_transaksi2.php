<?php
$conn = mysqli_connect("localhost", "root", "", "store");
if (!$conn) {
    echo ("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil tanggal filter
$start = isset($_GET['start']) ? $_GET['start'] : "";
$end   = isset($_GET['end']) ? $_GET['end'] : "";

$where = "";
if ($start != "" && $end != "") {
    $where = "WHERE t.waktu_transaksi BETWEEN '$start' AND '$end'";
}

// Query: Total per hari
$sql = "SELECT t.waktu_transaksi AS tanggal, SUM(t.total) AS total
        FROM transaksi t
        $where
        GROUP BY t.waktu_transaksi
        ORDER BY t.waktu_transaksi ASC";

$rekap = mysqli_query($conn, $sql);

// Untuk grafik
$label = [];
$data = [];
$rows = [];

while ($r = mysqli_fetch_assoc($rekap)) {
    $label[] = $r['tanggal'];
    $data[]  = $r['total'];
    $rows[]  = $r;
}

// Total pendapatan
$totalPendapatan = array_sum($data);

// Total pelanggan (jumlah transaksi)
$sqlJumlahTransaksi = "SELECT COUNT(*) AS total_transaksi FROM transaksi t $where";
$hasilJumlah = mysqli_fetch_assoc(mysqli_query($conn, $sqlJumlahTransaksi));
$jumlahTransaksi = $hasilJumlah['total_transaksi'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rekap Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="font-family: Arial; background: #f3f3f3; margin: 0; padding: 0;">

<div style="width: 90%; margin: 30px auto;">

    <div style="background: white; border: 1px solid #ccc; border-radius: 5px;">

        <div style="background: #174372ff; padding: 15px; color: white; font-weight: bold;">
            Rekap Laporan Penjualan
            <?php if ($start && $end) echo " $start sampai $end"; ?>
        </div>

        <div style="padding: 20px;">

            <a href="transaksi.php"
               style="background: #007bff; color: white; padding: 8px 15px;
                      border-radius: 5px; text-decoration: none;">
               Kembali
            </a>

            <!-- Form Filter -->
            <form method="GET" style="margin-top: 20px;">

                <input type="date" name="start" value="<?= $start ?>"
                       style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

                <input type="date" name="end" value="<?= $end ?>"
                       style="padding: 8px; border: 1px solid #ccc; border-radius: 5px; margin-left: 10px;">

                <button type="submit"
                        style="background: green; color: white; padding: 9px 18px;
                               border-radius: 5px; border: none; margin-left: 10px;">
                    Tampilkan
                </button>

            </form>

            <!-- GRAFIK -->
            <div style="margin-top: 30px;">
                <canvas id="grafik" style="width: 100%; height: 350px;"></canvas>
            </div>

            <script>
                const ctx = document.getElementById('grafik').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode($label) ?>,
                        datasets: [{
                            label: 'Total',
                            data: <?= json_encode($data) ?>,
                            backgroundColor: 'rgba(23,67,114,0.4)',
                            borderColor: '#174372ff',
                            borderWidth: 1
                        }]
                    },
                    options: { 
                        scales: { 
                            y: { 
                                beginAtZero: true 
                            } 
                        } 
                    }
                });
            </script>

            <!-- TABEL REKAP -->
            <table border="1" cellpadding="8" cellspacing="0"
                   style="width: 100%; margin-top: 30px; border-collapse: collapse; text-align: center;">

                <tr style="background: #e0e0e0;">
                    <th>No</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>

                <?php if (count($rows) > 0) { $no = 1; ?>
                    <?php foreach ($rows as $r) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>Rp<?= number_format($r['total'], 0, ',', '.') ?></td>
                            <td><?= date("d M Y", strtotime($r['tanggal'])) ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" style="padding: 10px; color: gray;">
                            Tidak ada data untuk rentang tanggal ini.
                        </td>
                    </tr>
                <?php } ?>

            </table>

            <!-- TOTAL BAWAH -->
            <table border="1" cellpadding="10" cellspacing="0"
                   style="width:100%; border-collapse: collapse; text-align: center; margin-top: 20px;">

                <tr style="background: #e0e0e0; font-weight: bold;">
                    <td>Jumlah Pelanggan</td>
                    <td>Jumlah Pendapatan</td>
                </tr>

                <tr>
                    <td><?= $jumlahTransaksi ?> Orang</td>
                    <td>Rp<?= number_format($totalPendapatan, 0, ',', '.') ?></td>
                </tr>

            </table>

        </div>

    </div>

</div>

</body>
</html>
