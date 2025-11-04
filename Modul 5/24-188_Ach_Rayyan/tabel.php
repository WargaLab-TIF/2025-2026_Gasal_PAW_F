<?php
    require 'koneksi.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM supplier WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            header("location: tabel.php");
        }
    }

    $sql = "SELECT * FROM supplier";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
  <div class="container">
    <h2>Data Master Supplier</h2>

    <a href="create.php" class="btn btn-green top-btn">Tambah Data</a>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Telepon</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($result)): ?>
          <?php foreach ($result as $index => $row): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($row['nama']) ?></td>
              <td><?= htmlspecialchars($row['telp']) ?></td>
              <td><?= htmlspecialchars($row['alamat']) ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-orange">Edit</a>
                <a href="tabel.php?id=<?= $row['id'] ?>" class="btn btn-red"
                   onclick="return confirm('Yakin ingin menghapus supplier ini?');">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="5" style="text-align:center;">Belum ada data supplier</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>