<?php
$conn = new mysqli("localhost", "root", "", "store");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$err = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $waktu = $_POST['waktu_transaksi'];
  $ket = trim($_POST['keterangan']);
  $pelanggan = intval($_POST['pelanggan_id']);

  if ($ket == "" || strlen($ket) < 3) {
    $err = "Keterangan minimal 3 karakter.";
  } elseif ($pelanggan <= 0) {
    $err = "Pilih pelanggan.";
  } else {
    $tgl_min = strtotime("2025-11-01 00:00:00");
    $waktu_clean = str_replace("T", " ", $waktu);
    $tgl_input = strtotime($waktu_clean);
    if ($tgl_input < $tgl_min) {
      $err = "Waktu transaksi tidak boleh sebelum 1 November 2025.";
    } else {
      $waktu_db = date("Y-m-d H:i:s", $tgl_input);
      $s = $conn->prepare("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)");
      $s->bind_param("ssi", $waktu_db, $ket, $pelanggan);
      if ($s->execute()) {
        header("Location: index.php");
        exit;
      } else {
        $err = "Gagal menambah transaksi.";
      }
    }
  }
}

$pelanggan = $conn->query("SELECT * FROM pelanggan ORDER BY nama");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h3>Tambah Transaksi</h3>
  <?php if($err!=""): ?>
    <div class="alert alert-danger"><?= $err ?></div>
  <?php endif; ?>

  <form method="post" class="card card-body bg-white">
    <div class="mb-3">
      <label>Waktu Transaksi</label>
      <input type="datetime-local" name="waktu_transaksi" class="form-control"
        value="<?= isset($_POST['waktu_transaksi']) ? htmlspecialchars($_POST['waktu_transaksi']) : '2025-11-01T00:00' ?>" required>
      <div class="form-text">Minimal tanggal 1 November 2025</div>
    </div>

    <div class="mb-3">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control" rows="3" required><?= htmlspecialchars($_POST['keterangan'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label>Pelanggan</label>
      <select name="pelanggan_id" class="form-select" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php while($p = $pelanggan->fetch_assoc()): ?>
          <option value="<?= $p['id'] ?>" <?= (isset($_POST['pelanggan_id']) && $_POST['pelanggan_id']==$p['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p['nama']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Total</label>
      <input type="text" value="0" class="form-control" readonly>
      <div class="form-text">Total akan diperbarui otomatis setelah tambah detail.</div>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>