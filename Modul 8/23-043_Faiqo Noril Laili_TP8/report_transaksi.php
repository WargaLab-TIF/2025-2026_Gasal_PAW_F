<?php
include 'koneksi.php';

$tanggal_awal = date('Y-m-d', strtotime('2025-10-01'));
$tanggal_akhir = date('Y-m-d', strtotime('2025-10-10'));

if (isset($_POST['submit'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Batang dengan Chart.js</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <h1>data dan grafik transaksi</h1>

        <div class="header">
            <form method="POST" action="">
                <input type="date" id="tanggal_awal" name="tanggal_awal" value="<?= $tanggal_awal ?>">
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">

            </form>
                <a href="menu_cetak.php?start_date=<?= $tanggal_awal ?>&end_date=<?= $tanggal_akhir ?>" target="_blank">
                <button>Tampilkan</button>
                </a>

        </div>

        <canvas id="myChart" width="5px" height="5px"></canvas>

        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        <?php
                        $result = mysqli_query($koneksi, "SELECT DISTINCT waktu_transaksi FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "'" . $row['waktu_transaksi'] . "', ";
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Total',
                        data: [
                            <?php
                            $result = mysqli_query($koneksi, "SELECT SUM(total) as total FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY waktu_transaksi");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo $row['total'] . ", ";
                            }
                            ?>
                        ],
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        borderColor: 'rgba(255, 0, 0, 0.2)',
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

        <table border="1">
            <tr>
                <th>NO</th>
                <th>Total</th>
                <th>Waktu Transaksi</th>
            </tr>

            <?php
            $sql = "SELECT id, waktu_transaksi, total FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>Rp." . number_format($row["total"], 0, ',', '.') . "</td>
                            <td>" . $row["waktu_transaksi"] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }
            ?>
        </table>
        <br>

        <table border="1">
            <tr>
                <th>Jumlah Pelanggan</th>
                <th>Jumlah Pendapatan</th>
            </tr>

            <?php
            $sqlPendapatan = "SELECT SUM(total) as jumlah_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $resultPendapatan = $koneksi->query($sqlPendapatan);

            $sqlPelanggan = "SELECT COUNT(DISTINCT id) as jumlah_pelanggan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $resultPelanggan = $koneksi->query($sqlPelanggan);

            if ($resultPelanggan->num_rows > 0) {
                $rowPelanggan = $resultPelanggan->fetch_assoc();
                $jumlahPelanggan = $rowPelanggan["jumlah_pelanggan"];
            }

            if ($resultPendapatan->num_rows > 0) {
                $rowPendapatan = $resultPendapatan->fetch_assoc();
                echo "<tr>
                    <td>" . $jumlahPelanggan . "</td>
                    <td>Rp." . number_format($rowPendapatan["jumlah_pendapatan"], 0, ',', '.') . "</td>
                </tr>";
            } else {
                echo "<tr><td colspan='2'>0 results</td></tr>";
            }
            ?>
        </table>

    </div>
</body>
</html>
