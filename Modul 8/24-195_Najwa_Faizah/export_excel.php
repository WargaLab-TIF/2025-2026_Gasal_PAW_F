<?php
    include 'koneksi.php';

    // Mendapatkan nilai start_date dan end_date dari parameter POST
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];

    // Header untuk mengatur agar file terunduh dalam format Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table border='1'>";
    echo "<tr><th colspan='3'>Rekap Laporan Penjualan $startDate sampai $endDate</th></tr>";
    echo "<tr></tr>";

    echo "<tr>
            <th>No</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>";

    // Mengubah query untuk mengambil kolom `total` dan `waktu_transaksi`
    $sql = "SELECT
                transaksi.total AS total,
                transaksi.waktu_transaksi AS waktu_transaksi,
                pelanggan.nama_pelanggan 
            FROM transaksi 
            JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
            WHERE transaksi.waktu_transaksi BETWEEN '$startDate' AND '$endDate'";

    $result = $conn->query($sql);

    // Inisialisasi variabel total pendapatan dan jumlah pelanggan
    $total_pendapatan = 0;
    $jumlah_pelanggan = 0;
    $no = 1;

    // Mengecek apakah query berhasil dijalankan
    if ($result && $result->num_rows > 0) {
        // Menampilkan data hasil query
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>Rp" . number_format($row['total'], 0, ',', '.') . "</td>";
            echo "<td>" . date("d-M-y", strtotime($row['waktu_transaksi'])) . "</td>";
            echo "</tr>";
            $total_pendapatan += $row['total'];
            $jumlah_pelanggan++;
        }
    } else {
        // Jika tidak ada data yang ditemukan
        echo "<tr><td colspan='3'>Tidak ada data yang ditemukan.</td></tr>";
    }

    echo "<tr></tr>";

    // Menampilkan total pelanggan dan total pendapatan
    echo "<tr>
            <th>Jumlah Pelanggan</th>
            <th colspan='2'>Jumlah Pendapatan</th>
        </tr>";

    echo "<tr>
            <td>$jumlah_pelanggan Orang</td>
            <td colspan='2'>Rp" . number_format($total_pendapatan, 0, ',', '.') . "</td>
    </tr>";
    echo "</table>";

    // Menutup koneksi
    $conn->close();
?>
