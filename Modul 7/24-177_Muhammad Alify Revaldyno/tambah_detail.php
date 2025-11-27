<?php
$conn = new mysqli("localhost", "root", "", "store");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$err = "";
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $transaksi = intval($_POST['transaksi_id']);
  $barang = intval($_POST['barang_id']);
  $qty = intval($_POST['qty']);

  if ($transaksi <= 0 || $barang <= 0) {
    $err = "Pilih transaksi dan barang terlebih dahulu.";
  } elseif ($qty <= 0) {
    $err = "Qty harus lebih dari 0.";
  } else {
    $cek = $conn->query("SELECT COUNT(*) AS jml FROM transaksi_detail WHERE transaksi_id=$transaksi AND barang_id=$barang");
    $d = $cek->fetch_assoc();
    if ($d['jml'] > 0) {
      $err = "Barang ini sudah ada di detail transaksi tersebut.";
    } else {
      $brg = $conn->query("SELECT harga FROM barang WHERE id=$barang")->fetch_assoc();
      $harga = $brg['harga'] * $qty;

      $conn->query("INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ($transaksi, $barang, $harga, $qty)");

      $conn->query("UPDATE transaksi SET total=(SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id=$transaksi) WHERE id=$transaksi");

      $pesan = "Detail transaksi berhasil ditambahkan.";
    }
  }
}

$transaksi = $conn->query("SELECT id, keterangan FROM transaksi ORDER BY id DESC");
$barang = $conn->query("SELECT id, nama_barang, harga FROM barang ORDER BY nama_barang");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Detail Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function loadBarangUsed() {
      let tid = document.getElementById("transaksi_id").value;
      if (!tid) return;
      fetch("tambah_detail.php?used=" + tid)
        .then(res => res.json())
        .then(data => {
          let options = document.querySelectorAll("#barang_id option");
          options.forEach(opt => {
            opt.disabled = data.includes(opt.value);
          });
        });
    }
  </script>
</head>
<body class="bg-light">
<div class="container py-4">
  <h3>Tambah Detail Transaksi</h3>

  <?php if($err!=""): ?>
    <div class="alert alert-danger"><?= $err ?></div>
  <?php elseif($pesan!=""): ?>
    <div class="alert alert-success"><?= $pesan ?></div>
  <?php endif; ?>

  <form method="post" class="card card-body bg-white">
    <div class="mb-3">
      <label>Transaksi</label>
      <select name="transaksi_id" id="transaksi_id" class="form-select" onchange="loadBarangUsed()" required>
        <option value="">-- Pilih Transaksi --</option>
        <?php while($t = $transaksi->fetch_assoc()): ?>
          <option value="<?= $t['id'] ?>" <?= (isset($_POST['transaksi_id']) && $_POST['transaksi_id']==$t['id']) ? 'selected' : '' ?>>
            <?= $t['id'] . " - " . htmlspecialchars($t['keterangan']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Barang</label>
      <select name="barang_id" id="barang_id" class="form-select" required>
        <option value="">-- Pilih Barang --</option>
        <?php while($b = $barang->fetch_assoc()): ?>
          <option value="<?= $b['id'] ?>">
            <?= htmlspecialchars($b['nama_barang']) ?> - Rp<?= number_format($b['harga'],0,',','.') ?>
          </option>
        <?php endwhile; ?>
      </select>
      <div class="form-text">Barang yang sudah digunakan di transaksi ini akan otomatis dinonaktifkan.</div>
    </div>

    <div class="mb-3">
      <label>Qty</label>
      <input type="number" name="qty" class="form-control" min="1" value="<?= isset($_POST['qty']) ? intval($_POST['qty']) : 1 ?>" required>
    </div>

    <button class="btn btn-success">Simpan Detail</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php
if (isset($_GET['used'])) {
  header("Content-Type: application/json");
  $tid = intval($_GET['used']);
  $data = [];
  $q = $conn->query("SELECT barang_id FROM transaksi_detail WHERE transaksi_id=$tid");
  while($r = $q->fetch_assoc()) {
    $data[] = strval($r['barang_id']);
  }
  echo json_encode($data);
  exit;
}
?>
</body>
</html>