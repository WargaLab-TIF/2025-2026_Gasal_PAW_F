<?php
$conn = mysqli_connect("localhost", "root", "", "master-detail");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

$res = mysqli_query($conn, "SELECT id, nama, harga FROM barang ORDER BY id ASC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Daftar Barang</title>
  <style>
    body {
      font-family: Arial;
      padding: 20px;
      background: #f5f5f5;
    }
    table {
      width: 90%;
      margin: 10px auto;
      border-collapse: collapse;
      background: #fff;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }
    th {
      background: #f0f0f0;
    }
    a.del {
      background: #d9534f;
      color: #fff;
      padding: 4px 8px;
      border-radius: 4px;
      text-decoration: none;
    }
    a.add {
      background: #5cb85c;
      color: #fff;
      padding: 6px 10px;
      border-radius: 4px;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center">Daftar Barang</h2>

  <div style="width:90%;margin:0 auto 10px;text-align:right">
  </div>

  <table>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Action</th>
    </tr>

    <?php 
    $no = 1;
    while ($r = mysqli_fetch_assoc($res)): 
    ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($r['nama']) ?></td>
        <td><?= number_format($r['harga'], 0, ',', '.') ?></td>
        <td>
          <a class="del" 
             href="hapus_barang.php?id=<?= $r['id'] ?>" 
             onclick="return confirm('Yakin ingin hapus barang ini?')">
             Delete
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
