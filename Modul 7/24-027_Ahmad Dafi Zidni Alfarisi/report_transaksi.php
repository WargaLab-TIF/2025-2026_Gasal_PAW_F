<?php
include "conn.php";

$mulai  = isset($_GET["mulai"]) ? $_GET["mulai"] : "";
$sampai = isset($_GET["sampai"]) ? $_GET["sampai"] : "";

$data_tanggal = [];
$data_total   = [];
$data_rekap   = [];
$total_pelanggan = 0;
$total_pendapatan = 0;

if ($mulai && $sampai) {

    $sql = "SELECT tanggal,
                   SUM(total) AS total_harian,
                   COUNT(*) AS jml_transaksi,
                   COUNT(DISTINCT pelanggan_id) AS jml_pelanggan
            FROM transaksi
            WHERE tanggal BETWEEN '$mulai' AND '$sampai'
            GROUP BY tanggal
            ORDER BY tanggal ASC";

    $q = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($q)) {
        $data_tanggal[] = $row["tanggal"];
        $data_total[]   = $row["total_harian"];
        $data_rekap[]   = $row;

        $total_pelanggan  += $row["jml_pelanggan"];
        $total_pendapatan += $row["total_harian"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<style>
body{
    font-family: Arial;
    background:#f0f0f0;
    margin:0;
    padding:0;
}
.header{
    background:#007bff;
    color:white;
    padding:15px;
    font-size:18px;
}
.container{
    width:95%;
    margin:auto;
    margin-top:20px;
}
.btn{
    background:#007bff;
    color:white;
    padding:8px 14px;
    border-radius:5px;
    text-decoration:none;
    border:none;
    cursor:pointer;
}
.card{
    background:white;
    padding:15px;
    margin-top:20px;
    border-radius:5px;
    border:1px solid #ddd;
}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#b5d8ff;
    padding:8px;
    text-align:left;
}
td{
    border:1px solid #ddd;
    padding:8px;
}
.summary{
    background:#b5d8ff;
    padding:10px;
    margin-top:15px;
    border-radius:5px;
    width:250px;
    display:inline-block;
}
</style>

</head>
<body>

<?php if ($mulai && $sampai) { ?>
<div class="header">
    Rekap Laporan Penjualan <?= $mulai ?> sampai <?= $sampai ?>
</div>
<?php } ?>

<div style="margin-top:15px; margin-bottom:15px;">
    <button type="button" onclick="printPDF()" 
            class="btn"
            style="background:green;">Print PDF</button>

    <a href="print_exsel.php?mulai=<?= $mulai ?>&sampai=<?= $sampai ?>" 
       class="btn"
       style="background:orange; margin-left:10px;">Export Excel</a>
</div>

<div class="container">

    <a href="tabel.php" class="btn"> Kembali</a>

    <form method="GET" style="margin-top:15px;">
        <label>Dari</label>
        <input type="date" name="mulai" value="<?= $mulai ?>">

        <label style="margin-left:10px;">Sampai</label>
        <input type="date" name="sampai" value="<?= $sampai ?>">

        <button class="btn">Filter</button>
    </form>

<?php if ($mulai && $sampai) { ?>

    <div class="card">
        <canvas id="grafik"></canvas>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>No</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>

            <?php $no=1; foreach ($data_rekap as $r) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>Rp<?= number_format($r["total_harian"],0,',','.') ?></td>
                <td><?= date("d M Y", strtotime($r["tanggal"])) ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <div class="card">
        <div class="summary">
            <b>Jumlah Pelanggan</b><br>
            <?= $total_pelanggan ?> Orang
        </div>

        <div class="summary" style="margin-left:10px;">
            <b>Jumlah Pendapatan</b><br>
            Rp<?= number_format($total_pendapatan,0,',','.') ?>
        </div>
    </div>

<?php } ?>

</div>

<script>
const tgl = <?= json_encode($data_tanggal) ?>;
const ttl = <?= json_encode($data_total) ?>;

if (tgl.length > 0) {
    const ctx = document.getElementById("grafik");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: tgl,
            datasets: [{
                label: "Total",
                data: ttl,
                backgroundColor: "rgba(180,180,180,0.7)",
                borderColor: "gray",
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: { 
                y: { 
                    beginAtZero: true
                } 
            }
        }
    });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
async function printPDF() {
    const { jsPDF } = window.jspdf;

    const canvas = await html2canvas(document.body, { scale: 2 });
    const imgData = canvas.toDataURL("image/png");

    const pdf = new jsPDF("p", "mm", "a4");

    const pageWidth = 210;
    const pageHeight = 297;
    const imgWidth = pageWidth;
    const imgHeight = canvas.height * pageWidth / canvas.width;

    let heightLeft = imgHeight;
    let position = 0;

    pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
    heightLeft -= pageHeight;

    while (heightLeft > 0) {
        position = position - pageHeight;
        pdf.addPage();
        pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;
    }

    pdf.save("laporan_penjualan.pdf");
}
</script>

</body>
</html>
