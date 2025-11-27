<?php
// report_transaksi.php
$conn = new mysqli("localhost", "root", "", "store");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

// Ambil parameter tanggal dari GET (format YYYY-MM-DD)
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to   = isset($_GET['to']) ? $_GET['to'] : '';

// default: rentang 7 hari terakhir jika belum dipilih
if (!$from || !$to) {
    $to_dt = new DateTime(); // hari ini
    $from_dt = (clone $to_dt)->modify('-6 days'); // 7 hari
    $from = $from_dt->format('Y-m-d');
    $to = $to_dt->format('Y-m-d');
}

// validasi sederhana
$from_dt = DateTime::createFromFormat('Y-m-d', $from);
$to_dt   = DateTime::createFromFormat('Y-m-d', $to);
if (!$from_dt || !$to_dt) {
    die("Format tanggal salah. Gunakan YYYY-MM-DD.");
}
if ($from_dt > $to_dt) {
    // tukar agar from <= to
    $tmp = $from_dt;
    $from_dt = $to_dt;
    $to_dt = $tmp;
    $from = $from_dt->format('Y-m-d');
    $to = $to_dt->format('Y-m-d');
}

// ambil data transaksi per hari dalam rentang
$stmt = $conn->prepare("
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_per_hari
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
    GROUP BY DATE(waktu_transaksi)
    ORDER BY DATE(waktu_transaksi)
");
$stmt->bind_param("ss", $from, $to);
$stmt->execute();
$res = $stmt->get_result();

$data_by_date = [];
while ($r = $res->fetch_assoc()) {
    $data_by_date[$r['tgl']] = (float)$r['total_per_hari'];
}
$stmt->close();

// ambil jumlah pelanggan unik dan jumlah pendapatan total
$stmt2 = $conn->prepare("
    SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan, COALESCE(SUM(total),0) AS jumlah_pendapatan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
");
$stmt2->bind_param("ss", $from, $to);
$stmt2->execute();
$summary = $stmt2->get_result()->fetch_assoc();
$stmt2->close();

// Buat array tanggal lengkap dari from -> to (termasuk tanggal tanpa transaksi)
$period = new DatePeriod(
    new DateTime($from),
    new DateInterval('P1D'),
    (new DateTime($to))->modify('+1 day')
);

$labels = [];
$values = [];
$table_rows = [];
$no = 1;
foreach ($period as $dt) {
    $d = $dt->format('Y-m-d');
    $labels[] = $d;
    $val = isset($data_by_date[$d]) ? $data_by_date[$d] : 0;
    $values[] = $val;

    // untuk tabel
    $table_rows[] = [
        'no' => $no++,
        'total' => $val,
        'tanggal' => $dt->format('d M Y')
    ];
}


function rupiah($n) {
    return 'Rp' . number_format($n,0,',','.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Rekap Laporan Penjualan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .back-btn { position: absolute; left: 20px; top: 20px; }
    .header-area { padding: 10px 20px; background:#0d6efd; color: #fff; border-radius:4px; margin-bottom:15px; }
  </style>
</head>
<body class="bg-light">
<div class="container py-4">

  
  <div class="header-area">
      <h5 class="mb-0">Rekap Laporan Penjualan  </h5>
    </div>
    
  <div class="card mb-3">
    <div class="card-body">
        <div class="mb-2">
        <a href="index.php" class="btn btn-primary">← Kembali</a>
    </div>
    
    <!-- Tombol Export -->
    <div class="mb-3">
        <a href="export_pdf.php?from=<?= $from ?>&to=<?= $to ?>" 
        class="btn btn-danger" target="_blank"> cetak</a>
        
        <a href="export_excel.php?from=<?= $from ?>&to=<?= $to ?>" 
        class="btn btn-success">Excel</a>
    </div>
    
      <form class="row g-2 align-items-end" method="get" action="report_transaksi.php">
        <div class="col-auto">
          <input type="date" name="from" class="form-control" value="<?= htmlspecialchars($from) ?>">
        </div>
        <div class="col-auto">
          <input type="date" name="to" class="form-control" value="<?= htmlspecialchars($to) ?>">
        </div>
        <div class="col-auto">
          <button class="btn btn-primary">Filter</button>
        </div>
      </form>
    </div>
  </div>


  <!-- Grafik -->
  <div class="card mb-3">
    <div class="card-body">
      <canvas id="chartBar" height="100"></canvas>
    </div>
  </div>

  <!-- Tabel rekap -->
  <div class="card mb-3">
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr><th style="width:60px">No</th><th>Total</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
          <?php foreach($table_rows as $row): ?>
            <tr>
              <td><?= $row['no'] ?></td>
              <td><?= rupiah($row['total']) ?></td>
              <td><?= $row['tanggal'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Ringkasan totals -->
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-info text-white">Jumlah Pelanggan</div>
        <div class="card-body">
          <h5 class="card-title"><?= intval($summary['jumlah_pelanggan']) ?> Orang</h5>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-info text-white">Jumlah Pendapatan</div>
        <div class="card-body">
          <h5 class="card-title"><?= rupiah($summary['jumlah_pendapatan']) ?></h5>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
const labels = <?= json_encode($labels) ?>;
const dataVals = <?= json_encode($values) ?>;

const ctx = document.getElementById('chartBar').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels.map(l => {
            // ubah label ke format singkat (dd-mm) agar muat
            const d = new Date(l + 'T00:00:00');
            return ('0'+d.getDate()).slice(-2) + '-' + ('0'+(d.getMonth()+1)).slice(-2);
        }),
        datasets: [{
            label: 'Total',
            data: dataVals,
            borderWidth: 1,
            backgroundColor: 'rgba(13,110,253,0.6)'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    // format angka jadi RP di chart (angka saja di tick)
                    callback: function(value) {
                        // tampilkan dalam ribuan jika besar
                        return value >= 1000 ? value.toLocaleString('id-ID') : value;
                    }
                }
            }
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const v = context.raw || 0;
                        return 'Rp' + Number(v).toLocaleString('id-ID');
                    }
                }
            }
        },
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
</body>
</html>
