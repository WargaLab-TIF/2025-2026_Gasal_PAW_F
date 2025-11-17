<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Master-Detail Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .container {
      max-width: 1000px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
      margin: auto;
      padding: 20px;
      border-radius: 8px;
      background-color: #e9ecef;
    }

    table {
      margin-bottom: 20px;
    }

    th, td {
      text-align: center;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #e6f7ff;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-3">Pengelolaan Master Detail</h2>
    <h4 class="mb-4">Data Barang</h4>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Nama Supplier</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'koneksi.php';
        $query = "SELECT barang.id, kode_barang, nama_barang, harga, stok, supplier.nama AS nama_supplier 
                  FROM barang 
                  JOIN supplier ON barang.supplier_id = supplier.id 
                  ORDER BY barang.id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['kode_barang']}</td>
                  <td>{$row['nama_barang']}</td>
                  <td>{$row['harga']}</td>
                  <td>{$row['stok']}</td>
                  <td>{$row['nama_supplier']}</td>
                  <td><a href='delete.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="container mt-5">
    <h4 class="mb-4">Data Transaksi</h4>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Waktu Transaksi</th>
          <th>Keterangan</th>
          <th>Total</th>
          <th>Nama Pelanggan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT transaksi.id, waktu_transaksi, keterangan, total, pelanggan.nama AS nama_pelanggan 
                  FROM transaksi 
                  JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id 
                  ORDER BY transaksi.id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['waktu_transaksi']}</td>
                  <td>{$row['keterangan']}</td>
                  <td>{$row['total']}</td>
                  <td>{$row['nama_pelanggan']}</td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="container mt-5 mb-5">
    <h4 class="mb-4">Data Detail Transaksi</h4>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Qty</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT transaksi_detail.transaksi_id, barang.nama_barang, transaksi_detail.harga, transaksi_detail.qty 
                  FROM transaksi_detail 
                  JOIN barang ON transaksi_detail.barang_id = barang.id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$row['transaksi_id']}</td>
                  <td>{$row['nama_barang']}</td>
                  <td>{$row['harga']}</td>
                  <td>{$row['qty']}</td>
                </tr>";
        }
        ?>
      </tbody>
    </table>

    <div class="mt-4 mb-2">
      <a href="tambah_transaksi.php" class="btn btn-primary me-3">Tambah Transaksi</a>
      <a href="tambah_transaksi_detail.php" class="btn btn-primary">Tambah Detail Transaksi</a>
    </div>
  </div>
</body>
</html>
