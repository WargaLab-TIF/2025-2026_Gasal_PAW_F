<?php
include "koneksi.php";

$data_tampil = false;

if (isset($_POST['tampilkan'])) {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $data_tampil = true;

    $sql_grafik = "SELECT DATE(t.waktu_transaksi) AS tanggal,
               SUM(td.qty * td.harga) AS total_pendapatan
               FROM transaksi t
               INNER JOIN transaksi_detail td ON td.transaksi_id = t.id
               WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
               GROUP BY DATE(t.waktu_transaksi)
               ORDER BY tanggal ASC";
    $grafik = mysqli_query($conn, $sql_grafik);

    $tanggal = [];
    $total_pendapatan = [];

    while ($g = mysqli_fetch_assoc($grafik)) {
        $tanggal[] = $g['tanggal'];
        $total_pendapatan[] = $g['total_pendapatan'];
    }

    $sql_rekap = "SELECT 
                    t.waktu_transaksi,
                    SUM(td.qty * td.harga) AS total_penerimaan
                  FROM transaksi t
                  INNER JOIN transaksi_detail td ON td.transaksi_id = t.id
                  WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                  GROUP BY t.waktu_transaksi
                  ORDER BY t.waktu_transaksi ASC";

    $rekap = mysqli_query($conn, $sql_rekap);

    $sql_total = "SELECT 
                    COUNT(DISTINCT t.id) AS total_pelanggan,
                    SUM(td.qty * td.harga) AS total_pendapatan
                  FROM transaksi t
                  INNER JOIN transaksi_detail td ON td.transaksi_id = t.id
                  WHERE t.waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

    $total = mysqli_fetch_assoc(mysqli_query($conn, $sql_total));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan_Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: aqua;
            margin: 3%;
        }

        .layout {
            padding: 3%;
            background-color: white;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            width: 90%;
        }

        table td,
        table th {
            border: 1px solid black;
            padding: 8px;
        }

        .tombol {
            color: blue;
            cursor: pointer;
        }

        .back {
            color: blue;
        }
    </style>

</head>

<body>

    <div class="layout">

        <?php if ($data_tampil == false) { ?>
            <h2 style="text-align:center;">Rekap Laporan Penjualan</h2>

            <form action="index.php">
                <button class="back">Kembali</button>
            </form>

            <form method="POST">
                <table>
                    <tr>
                        <td>Tanggal Awal</td>
                        <td><input type="date" name="tanggal_awal" required></td>
                    </tr>
                    <tr>
                        <td>Tanggal Akhir</td>
                        <td><input type="date" name="tanggal_akhir" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="submit" name="tampilkan" class="tombol">Tampilkan</button>
                        </td>
                    </tr>
                </table>
            </form>

        <?php } else { ?>

            <h2 style="text-align:center;">Rekap Laporan Penjualan dari <?php echo $tanggal_awal . " sampai " . $tanggal_akhir ?></h2>

            <form action="">
                <button class="back">Kembali</button>
            </form>

            <button onclick="window.print()" class="tombol">Print PDF</button>

            <form action="export_excel.php" method="GET" style="display:inline;">
                <input type="hidden" name="tgl1" value="<?= $tanggal_awal ?>">
                <input type="hidden" name="tgl2" value="<?= $tanggal_akhir ?>">

                <button type="submit" class="tombol">
                    Export Excel
                </button>
            </form>



            <br>
            <canvas id="myChart" width="400" height="200"></canvas>

            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($tanggal); ?>,
                        datasets: [{
                            label: 'Total Pendapatan (Rp)',
                            data: <?php echo json_encode($total_pendapatan); ?>,
                            backgroundColor: "lightblue",
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

            <br><br>

            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>

                <?php
                $no = 1;
                while ($r = mysqli_fetch_assoc($rekap)) {
                    echo "<tr>
                <td>" . $no . "</td>
                <td>" . number_format($r['total_penerimaan'], 0, ',', '.') . "</td>
                <td>" . $r['waktu_transaksi'] . "</td>
              </tr>";
                    $no++;
                }
                ?>
            </table>

            <br><br>

            <table>
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Jumlah Pendapatan</th>
                </tr>
                <tr>
                    <td><?= $total['total_pelanggan'] ?></td>
                    <td>Rp <?= number_format($total['total_pendapatan'], 0, ',', '.') ?></td>
                </tr>
            </table>

        <?php } ?>

    </div>

</body>

</html>