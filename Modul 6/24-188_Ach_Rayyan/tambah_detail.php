<?php
$conn = mysqli_connect("localhost","root","","master-detail");
if (!$conn) die("Koneksi gagal: ".mysqli_connect_error());

$transaksi_id = intval($_GET['transaksi_id'] ?? ($_POST['transaksi_id'] ?? 0));
$errors = [];

$trs = mysqli_query($conn, "SELECT id,waktu_transaksi FROM transaksi ORDER BY id DESC");

$barang_q = [];
if ($transaksi_id > 0) {
    $res = mysqli_query($conn, "SELECT id,nama,harga FROM barang WHERE id NOT IN (
        SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $transaksi_id
    ) ORDER BY nama");
    while($r = mysqli_fetch_assoc($res)) $barang_q[] = $r;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksi_id = intval($_POST['transaksi_id'] ?? 0);
    $barang_id = intval($_POST['barang_id'] ?? 0);
    $qty = intval($_POST['qty'] ?? 0);

    if ($transaksi_id<=0) $errors[] = "Pilih transaksi.";
    if ($barang_id<=0) $errors[] = "Pilih barang.";
    if ($qty<=0) $errors[] = "Qty harus > 0.";

    if (empty($errors)) {
        $c = mysqli_fetch_assoc(mysqli_query($conn,
            "SELECT COUNT(*) AS c FROM transaksi_detail WHERE transaksi_id=$transaksi_id AND barang_id=$barang_id"
        ))['c'] ?? 0;
        if ($c>0) $errors[] = "Barang sudah ada di transaksi ini.";
    }

    if (empty($errors)) {
        $h = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id=$barang_id"))['harga'] ?? 0;
        $subtotal = floatval($h) * $qty;
        mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id,barang_id,qty,subtotal) VALUES ($transaksi_id,$barang_id,$qty,$subtotal)");

        $tot = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(subtotal),0) AS total FROM transaksi_detail WHERE transaksi_id=$transaksi_id"))['total'];
        mysqli_query($conn, "UPDATE transaksi SET total=$tot WHERE id=$transaksi_id");
        header("Location: tambah_detail.php?transaksi_id=$transaksi_id");
        exit;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Detail</title>
<style>body{font-family:Arial;background:#f5f5f5;padding:30px}.box{width:360px;margin:0 auto;background:#fff;padding:12px;border-radius:6px;border:1px solid #ddd}label{display:block;margin-top:8px;font-size:13px}select,input,button{width:100%;padding:8px;margin-top:6px;box-sizing:border-box}button{background:#0288d1;color:#fff;border:none;border-radius:4px;padding:8px}.err{color:#b00020}.small{font-size:12px;color:#666;margin-top:8px}</style>
<script>
function pickTrans(el){ var id=el.value; location.href='tambah_detail.php' + (id?('?transaksi_id='+id):''); }
</script>
</head><body>
<div class="box">
  <h3 style="text-align:center;margin:0">Tambah Detail Transaksi</h3>

  <?php if($errors) foreach($errors as $e) echo "<div class='err'>$e</div>"; ?>

  <form method="post">
    <label>ID Transaksi</label>
    <select name="transaksi_id" onchange="pickTrans(this)" required>
      <option value="">Pilih ID Transaksi</option>
      <?php mysqli_data_seek($trs,0); while($t=mysqli_fetch_assoc($trs)): ?>
        <option value="<?= $t['id'] ?>" <?= $t['id']==$transaksi_id? 'selected':''; ?>>
          <?= $t['id'] ?> - <?= $t['waktu_transaksi'] ?>
        </option>
      <?php endwhile; ?>
    </select>

    <label>Pilih Barang</label>
    <select name="barang_id" required>
      <option value=""><?= $transaksi_id? 'Pilih Barang' : 'Pilih transaksi dulu' ?></option>
      <?php if($transaksi_id && empty($barang_q)) echo "<option value=''>(tidak ada barang tersisa)</option>";
            foreach($barang_q as $b): ?>
        <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['nama']) ?> (<?= number_format($b['harga'],0,',','.') ?>)</option>
      <?php endforeach; ?>
    </select>

    <label>Quantity</label>
    <input type="number" name="qty" min="1" value="1" required>

    <button type="submit">Tambah Detail Transaksi</button>
  </form>

  <div class="small">Setelah tambah, subtotal dihitung dan total transaksi diupdate.</div>
</div>
</body></html>
