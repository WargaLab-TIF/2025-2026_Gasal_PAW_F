<?php
// transaksi.php
// Menampilkan daftar transaksi + tombol Lihat Detail & Hapus (sederhana)
include "koneksi.php";

// Jika ada request untuk menghapus (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $hapus_id = (int) $_POST['delete_id'];

    // Hapus detail transaksi (jika ada)
    $sql1 = "DELETE FROM transaksi_detail WHERE transaksi_id = ?";
    $st1 = mysqli_prepare($koneksi, $sql1);
    mysqli_stmt_bind_param($st1, "i", $hapus_id);
    mysqli_stmt_execute($st1);
    mysqli_stmt_close($st1);

    // Hapus record pembayaran (jika ada)
    $sql2 = "DELETE FROM pembayaran WHERE transaksi_id = ?";
    $st2 = mysqli_prepare($koneksi, $sql2);
    mysqli_stmt_bind_param($st2, "i", $hapus_id);
    mysqli_stmt_execute($st2);
    mysqli_stmt_close($st2);

    // Hapus transaksi utama
    $sql3 = "DELETE FROM transaksi WHERE id = ?";
    $st3 = mysqli_prepare($koneksi, $sql3);
    mysqli_stmt_bind_param($st3, "i", $hapus_id);
    mysqli_stmt_execute($st3);
    $affected = mysqli_stmt_affected_rows($st3);
    mysqli_stmt_close($st3);

    if ($affected > 0) {
        $pesan = "Transaksi ID {$hapus_id} berhasil dihapus.";
    } else {
        $pesan = "Gagal menghapus Transaksi ID {$hapus_id} atau data tidak ditemukan.";
    }
}

// Ambil daftar transaksi (contoh: 50 terbaru)
$sql = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        ORDER BY t.waktu_transaksi DESC
        LIMIT 50";
$res = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Master Transaksi</title>
    <style>
        body{font-family: Arial, sans-serif;margin:20px;background:#f6f7fb}
        .container{max-width:1100px;margin:0 auto}
        .card{background:#fff;padding:16px;border-radius:6px;box-shadow:0 1px 4px rgba(0,0,0,0.08)}
        .btn {display:inline-block;padding:6px 10px;border-radius:4px;text-decoration:none;color:#fff;font-size:14px}
        .btn-blue{background:#17a2b8}  /* lihat detail */
        .btn-red{background:#dc3545}   /* hapus */
        .btn-green{background:#28a745} /* tambah (opsional) */
        .btn-report{background:#007bff} /* lihat laporan */
        table{border-collapse:collapse;width:100%;margin-top:12px}
        th,td{border:1px solid #e3e7ef;padding:8px;text-align:left}
        th{background:#eaf3ff}
        .action-group{display:flex;gap:8px;align-items:center}
        form.inline{display:inline}
    </style>
    <script>
    // Konfirmasi sebelum menghapus
    function confirmDelete() {
        return confirm('Yakin ingin menghapus transaksi ini? Tindakan ini tidak bisa dibatalkan.');
    }
    </script>
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Data Master Transaksi</h2>

        <a class="btn btn-report" href="report_transaksi.php">Lihat Laporan Penjualan</a>
        <a class="btn btn-green" href="tambah_transaksi.php" style="margin-left:8px">Tambah Transaksi</a>

        <?php if (!empty($pesan)): ?>
            <p style="margin-top:12px;padding:10px;background:#e8f5e9;border:1px solid #c8e6c9;border-radius:4px;color:#256029">
                <?php echo htmlspecialchars($pesan); ?>
            </p>
        <?php endif; ?>

        <h3 style="margin-top:20px">Daftar Transaksi (sample)</h3>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Waktu Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($res)) {
                $id = (int) $row['id'];
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>{$id}</td>";
                echo "<td>" . htmlspecialchars($row['waktu_transaksi']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                echo "<td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>";

                // kolom tindakan: Lihat Detail (link) + Hapus (form POST)
                echo "<td>";
                echo "<div class='action-group'>";
                echo "<a class='btn btn-blue' href='transaksi_detail.php?id={$id}'>Lihat Detail</a>";

                echo "<form method='post' class='inline' onsubmit='return confirmDelete();'>";
                echo "<input type='hidden' name='delete_id' value='{$id}'>";
                echo "<button type='submit' class='btn btn-red' style='border:none;cursor:pointer'>Hapus</button>";
                echo "</form>";

                echo "</div>";
                echo "</td>";

                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
