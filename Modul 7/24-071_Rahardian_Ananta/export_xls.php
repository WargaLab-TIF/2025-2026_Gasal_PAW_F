<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($host, $user, $password, $dbname);

$awal = $_GET["awal"];
$akhir = $_GET["akhir"];

$namaFile = "laporan_penjualan.xls";

header("Content-Type: text/xls");
header("Content-Disposition: attachment; filename=\"" . $namaFile . "\"");

$statQuery = "
    SELECT 
        COUNT(DISTINCT transaksi.pelanggan_id) AS jumlah_pelanggan,
        COALESCE(SUM(transaksi_detail.harga), 0) AS total_pendapatan
    FROM transaksi
    LEFT JOIN transaksi_detail 
        ON transaksi.id = transaksi_detail.transaksi_id
    WHERE transaksi.waktu_transaksi BETWEEN '$awal' AND '$akhir';
";

// Jalankan query-nya
$hasil_stat = mysqli_query($conn, $statQuery);
// Ambil datanya
$stat = mysqli_fetch_assoc($hasil_stat);

$filterQuery = "
    SELECT
        transaksi.waktu_transaksi,
        COALESCE(SUM(transaksi_detail.harga), 0) AS total_dihitung
    FROM 
        transaksi
    LEFT JOIN 
        transaksi_detail 
        ON transaksi.id = transaksi_detail.transaksi_id
    WHERE 
        transaksi.waktu_transaksi BETWEEN '$awal' AND '$akhir'
    GROUP BY transaksi.id, transaksi.waktu_transaksi;
";

// Jalankan query-nya
$hasil_filter = mysqli_query($conn, $filterQuery);

// ===============================================
// 6. CETAK SEMUA DATA SEBAGAI TEKS CSV
// ===============================================
// Kita pakai 'echo' untuk 'mencetak' teks ke file download
// \n artinya "pindah baris baru"

// --- CETAK TABEL STATISTIK ---
echo "Rekap Laporan Penjualan $awal Sampai $akhir \n";


// Kasih jarak satu baris kosong
echo "\n";

echo "No,Total,Tanggal\n"; 
// Ulangi (looping) semua data dari hasil query kedua
$no = 1;
while ($row = mysqli_fetch_assoc($hasil_filter)) {
    // Ambil datanya
    $total = $row["total_dihitung"];
    $tanggal = date('d M Y', strtotime($row["waktu_transaksi"]));
    
    // Cetak satu baris, dipisah koma
    echo $no . "," . $total . "," . $tanggal . "\n";
    
    // Tambah nomor urut
    $no = $no + 1;
}

echo "\n";

echo "Jumlah Pelanggan,Total Pendapatan\n";
echo $stat["jumlah_pelanggan"] . "," . $stat["total_pendapatan"] . "\n";


// Selesai! Hentikan skrip.
exit;

?>