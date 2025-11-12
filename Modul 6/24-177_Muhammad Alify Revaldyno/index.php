<?php
$conn = new mysqli("localhost", "root", "", "store");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$pesan = "";

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);

    $cek = $conn->query("SELECT COUNT(*) AS jml FROM transaksi_detail WHERE barang_id=$id");
    $data = $cek->fetch_assoc();
    if ($data['jml'] > 0) {
        echo "<script>alert('Barang tidak bisa dihapus karena sudah digunakan di transaksi.'); window.location='index.php';</script>";
        exit;
    } else {
        if ($conn->query("DELETE FROM barang WHERE id=$id")) {
            echo "<script>alert('Barang berhasil dihapus.'); window.location='index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal menghapus barang.'); window.location='index.php';</script>";
            exit;
        }
    }
}

$barang = $conn->query("SELECT b.*, s.nama AS supplier FROM barang b LEFT JOIN supplier s ON b.supplier_id=s.id ORDER BY b.id");
$transaksi = $conn->query("SELECT t.*, p.nama AS pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id=p.id ORDER BY t.id DESC");
$detail = $conn->query("SELECT td.*, br.nama_barang FROM transaksi_detail td LEFT JOIN barang br ON td.barang_id=br.id ORDER BY td.transaksi_id, td.barang_id");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pengelolaan Master Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function hapusBarang(id, nama) {
      if (confirm("Yakin ingin menghapus barang: " + nama + "?")) {
        window.location.href = "?hapus=" + id;
      }
    }
  </script>
</head>
<body class="bg-light">
<div class="container py-4">
  <h2 class="mb-3">Pengelolaan Master Detail Data</h2>

  <div class="mb-3">
    <a href="tambah_transaksi.php" class="btn btn-primary">Tambah Transaksi</a>
    <a href="tambah_detail.php" class="btn btn-success">Tambah Detail Transaksi</a>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h5>Data Barang</h5>
      <table class="table table-bordered table-sm bg-white">
        <thead>
          <tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Supplier</th><th>Aksi</th></tr>
        </thead>
        <tbody>
          <?php while($b = $barang->fetch_assoc()): ?>
            <tr>
              <td><?= $b['id'] ?></td>
              <td><?= htmlspecialchars($b['nama_barang']) ?></td>
              <td><?= number_format($b['harga'],0,',','.') ?></td>
              <td><?= $b['stok'] ?></td>
              <td><?= htmlspecialchars($b['supplier']) ?></td>
              <td>
                <button onclick="hapusBarang(<?= $b['id'] ?>, '<?= addslashes($b['nama_barang']) ?>')" class="btn btn-sm btn-danger">Hapus</button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <div class="col-md-6">
      <h5>Data Transaksi</h5>
      <table class="table table-bordered table-sm bg-white">
        <thead>
          <tr><th>ID</th><th>Waktu</th><th>Keterangan</th><th>Total</th><th>Pelanggan</th></tr>
        </thead>
        <tbody>
          <?php while($t = $transaksi->fetch_assoc()): ?>
            <tr>
              <td><?= $t['id'] ?></td>
              <td><?= $t['waktu_transaksi'] ?></td>
              <td><?= htmlspecialchars($t['keterangan']) ?></td>
              <td><?= number_format($t['total'],0,',','.') ?></td>
              <td><?= htmlspecialchars($t['pelanggan']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <h5 class="mt-4">Detail Transaksi</h5>
  <table class="table table-bordered table-sm bg-white">
    <thead>
      <tr><th>ID Transaksi</th><th>Barang</th><th>Qty</th><th>Harga</th></tr>
    </thead>
    <tbody>
      <?php while($d = $detail->fetch_assoc()): ?>
        <tr>
          <td><?= $d['transaksi_id'] ?></td>
          <td><?= htmlspecialchars($d['nama_barang']) ?></td>
          <td><?= $d['qty'] ?></td>
          <td><?= number_format($d['harga'],0,',','.') ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>