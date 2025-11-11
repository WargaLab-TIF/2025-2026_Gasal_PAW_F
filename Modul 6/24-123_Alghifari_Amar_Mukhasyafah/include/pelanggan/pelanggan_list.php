<table class="table table-striped" style="color: #888888;">
  <thead>
    <tr>
      <th scope="col">Nama</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">telp</th>
      <th scope="col">alamat</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pelanggan as $pel): ?>
      <tr>
        <td scope="row"><?= $pel["nama"] ?></td>
        <td scope="row"><?= $pel["jenis_kelamin"] ?></td>
        <td scope="row"><?= $pel["telp"] ?></td>
        <th scope="row"><?= substr($pel["alamat"], 0, 20); ?></th>
        <td style="color: white;">
            <a type="button" class="btn btn-primary" href="/MasterDetail/pelanggan_detail.php?id=<?= $pel['id']; ?>">Detail</a>
            <a type="button" class="btn btn-danger" href="/MasterDetail/proses/pelanggan/pelanggan.php?delete=true&id=<?= $pel['id']; ?>">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>