<table style="color: #888888;" class="table table-striped">
    <thead>
        <tr>
        <th scope="col">id</th>
        <th scope="col">Waktu</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaksi as $trans): ?>
            <tr>
                <th scope="row"><?= $trans["id"] ?></th>
                <td><?= $trans["waktu_transaksi"] ?></td>
                <td><?= substr($trans["keterangan"], 0, 20) . "..." ?></td>
                <td><?= $trans["total"] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>