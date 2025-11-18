<?php
include "koneksi.php";

// Ambil tanggal dari URL, kalau kosong pakai 7 hari terakhir
$tgl_mulai = isset($_GET['from']) && $_GET['from'] != '' ? $_GET['from'] : date('Y-m-d', strtotime('-7 days'));
$tgl_selesai = isset($_GET['to']) && $_GET['to'] != ''   ? $_GET['to']   : date('Y-m-d');

// Fungsi ambil data laporan
function ambil_laporan($db, $mulai, $selesai) {
    // 1) Total per tanggal
    $sql = "SELECT t.waktu_transaksi AS tanggal, SUM(t.total) AS total_per_tanggal
            FROM transaksi t
            WHERE t.waktu_transaksi BETWEEN ? AND ?
            GROUP BY t.waktu_transaksi
            ORDER BY t.waktu_transaksi ASC";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $mulai, $selesai);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $list = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $list[] = $row;
    }

    // 2) Total kumulatif dalam rentang
    $sql2 = "SELECT IFNULL(SUM(total),0) AS total_all FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt2 = mysqli_prepare($db, $sql2);
    mysqli_stmt_bind_param($stmt2, "ss", $mulai, $selesai);
    mysqli_stmt_execute($stmt2);
    $res2 = mysqli_stmt_get_result($stmt2);
    $row2 = mysqli_fetch_assoc($res2);
    $total_kumulatif = $row2 ? $row2['total_all'] : 0;

    // 3) Jumlah pelanggan unik dalam rentang
    $sql3 = "SELECT COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt3 = mysqli_prepare($db, $sql3);
    mysqli_stmt_bind_param($stmt3, "ss", $mulai, $selesai);
    mysqli_stmt_execute($stmt3);
    $res3 = mysqli_stmt_get_result($stmt3);
    $row3 = mysqli_fetch_assoc($res3);
    $jumlah_pelanggan = $row3 ? $row3['jumlah_pelanggan'] : 0;

    return [$list, $total_kumulatif, $jumlah_pelanggan];
}

list($data_per_tanggal, $total_keseluruhan, $jumlah_pelanggan) = ambil_laporan($koneksi, $tgl_mulai, $tgl_selesai);

// Siapkan array untuk chart (labels + values)
$chart_labels = [];
$chart_values = [];
foreach ($data_per_tanggal as $r) {
    $chart_labels[] = $r['tanggal'];
    $chart_values[] = (int)$r['total_per_tanggal'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Laporan Penjualan</title>
    <style>
        /* gaya sederhana, mirip aslinya */
        body{font-family: Arial, sans-serif;background:#f6f7fb;margin:0;padding:0}
        .container{max-width:1100px;margin:20px auto}
        .header-blue{
            background:#1e88e5;color:#fff;padding:14px 18px;border-top-left-radius:6px;border-top-right-radius:6px;
            box-shadow:0 1px 3px rgba(0,0,0,0.08);
        }
        .card{background:#fff;padding:18px;border-bottom-left-radius:6px;border-bottom-right-radius:6px;box-shadow:0 1px 6px rgba(0,0,0,0.06)}
        .controls{margin:12px 0;display:flex;gap:8px;align-items:center;flex-wrap:wrap}
        .btn{padding:8px 12px;border-radius:4px;text-decoration:none;display:inline-block;border:0;cursor:pointer}
        .btn-back{background:#2d9cdb;color:#fff}
        .btn-print{background:#ffc107;color:#000}
        .btn-excel{background:#28a745;color:#fff}
        .filter input[type=date]{padding:6px;border:1px solid #d0d7e5;border-radius:4px}
        .filter button{background:#2e7d32;color:#fff;border:0;padding:8px 12px;border-radius:4px}
        .chart-wrap{background:#fff;padding:12px;border-radius:6px;margin-bottom:18px}
        table{border-collapse:collapse;width:100%}
        th,td{border:1px solid #e6eef7;padding:10px;text-align:left}
        thead th{background:#cfe6ff}
        .summary-table{width:50%;margin-top:14px;border-collapse:collapse}
        .summary-table th, .summary-table td{border:1px solid #e6eef7;padding:8px;background:#eaf6ff}
        @media print{ .controls{display:none} }
    </style>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- html2canvas + jsPDF untuk export PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
<div class="container">
    <div class="header-blue">
        <strong>Rekap Laporan Penjualan <?php echo date('d M Y', strtotime($tgl_mulai)); ?> sampai <?php echo date('d M Y', strtotime($tgl_selesai)); ?></strong>
    </div>

    <div class="card" id="report-card">
        <div class="controls">
            <a href="transaksi.php" class="btn btn-back">← Kembali</a>

            <form method="get" class="filter" style="display:inline-flex;gap:8px;align-items:center">
                <label>Mulai: <input type="date" name="from" value="<?php echo htmlspecialchars($tgl_mulai); ?>"></label>
                <label>Sampai: <input type="date" name="to" value="<?php echo htmlspecialchars($tgl_selesai); ?>"></label>
                <button type="submit">Tampilkan</button>
            </form>

            <div style="margin-left:auto;display:flex;gap:8px">
                <button id="btnPdf" class="btn btn-print">Cetak</button>
                <a class="btn btn-excel" href="export_excel.php?from=<?php echo urlencode($tgl_mulai); ?>&to=<?php echo urlencode($tgl_selesai); ?>">Excel</a>
            </div>
        </div>

        <div id="report-content">
            <div class="chart-wrap">
                <canvas id="barChart" width="1000" height="320"></canvas>
            </div>

            <h3>Rekap</h3>
            <table id="rekap-table">
                <thead>
                    <tr>
                        <th style="width:6%">No</th>
                        <th style="width:30%">Total</th>
                        <th style="width:64%">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($data_per_tanggal as $row) {
                    echo "<tr>";
                    echo "<td>".$i++."</td>";
                    echo "<td>Rp ".number_format($row['total_per_tanggal'],0,',','.')."</td>";
                    $tgl_formatted = date('d M Y', strtotime($row['tanggal']));
                    echo "<td>".$tgl_formatted."</td>";
                    echo "</tr>";
                }
                if (count($data_per_tanggal) === 0) {
                    echo "<tr><td colspan='3'>Tidak ada data pada rentang tanggal ini.</td></tr>";
                }
                ?>
                </tbody>
            </table>

            <table class="summary-table">
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Jumlah Pendapatan</th>
                </tr>
                <tr>
                    <td style="text-align:center"><?php echo (int)$jumlah_pelanggan; ?> Orang</td>
                    <td style="text-align:center">Rp <?php echo number_format($total_keseluruhan,0,',','.'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
// Data chart dari PHP
const labels = <?php echo json_encode($chart_labels); ?>;
const values = <?php echo json_encode($chart_values); ?>;

// buat bar chart sederhana
const ctx = document.getElementById('barChart').getContext('2d');
const myBar = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total',
            data: values,
            borderWidth: 1,
            backgroundColor: 'rgba(30,136,229,0.25)',
            borderColor: 'rgba(30,136,229,0.9)'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        // format ribuan dengan titik
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                }
            }
        },
        plugins: { legend: { display: false } },
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

<script>
// Cetak ke PDF menggunakan html2canvas + jsPDF
document.getElementById('btnPdf').addEventListener('click', async function(){
    const { jsPDF } = window.jspdf;
    const element = document.getElementById('report-content');

    // capture seluruh area report-content
    const canvas = await html2canvas(element, {scale: 2, useCORS: true});
    const imgData = canvas.toDataURL('image/png');

    const pdf = new jsPDF('p','pt','a4');
    const pageWidth = pdf.internal.pageSize.getWidth();
    const pageHeight = pdf.internal.pageSize.getHeight();
    const margin = 20;

    // ukur lebar gambar agar pas di halaman (tinggi disesuaikan)
    const imgProps = pdf.getImageProperties(imgData);
    const imgWidth = pageWidth - margin * 2;
    const imgHeight = (imgProps.height * imgWidth) / imgProps.width;

    // jika gambar muat 1 halaman
    if (imgHeight <= (pageHeight - margin*2)) {
        pdf.addImage(imgData, 'PNG', margin, margin, imgWidth, imgHeight);
    } else {
        // gambar lebih tinggi -> potong dan buat beberapa halaman
        const pxPerPt = canvas.width / imgWidth;
        const pageHeightPx = (pageHeight - margin*2) * pxPerPt;

        let y = 0;
        while (y < canvas.height) {
            // buat canvas sementara untuk tiap potongan
            const canvasPart = document.createElement('canvas');
            canvasPart.width = canvas.width;
            canvasPart.height = Math.min(pageHeightPx, canvas.height - y);
            const ctxPart = canvasPart.getContext('2d');
            ctxPart.drawImage(canvas, 0, y, canvasPart.width, canvasPart.height, 0, 0, canvasPart.width, canvasPart.height);
            const imgPart = canvasPart.toDataURL('image/png');
            const partHeightPt = canvasPart.height / pxPerPt;
            pdf.addImage(imgPart, 'PNG', margin, margin, imgWidth, partHeightPt);
            y += canvasPart.height;
            if (y < canvas.height) pdf.addPage();
        }
    }

    pdf.save('laporan_penjualan.pdf');
});
</script>

</body>
</html>
