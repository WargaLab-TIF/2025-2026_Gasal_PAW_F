<?php
if(!isset($_SESSION['login']) || $_SESSION['login'] !== true ){
    echo "Akses Ditolak"; exit();
}

$op = isset($_GET['op']) ? $_GET['op'] : '';
$selected_transaksi_id = isset($_GET['detail_id']) ? (int)$_GET['detail_id'] : null;

$waktu_transaksi = date('Y-m-d'); 
$pelanggan_id= "";
$keterangan= "";
$id_transaksi= ""; 
$error= "";
$sukses= "";

if(isset($_POST['simpan_header'])){
    $waktu_transaksi = $_POST['waktu_transaksi'];
    $pelanggan_id= $_POST['pelanggan_id'];
    $keterangan= $_POST['keterangan'];
    $id_post= $_POST['id']; 
    
    $user_id = 1; 
    if(isset($_SESSION['username'])){
        $u_user = $_SESSION['username'];
        $q_u = mysqli_query($conn, "SELECT id_user FROM user WHERE username='$u_user'");
        if($r_u = mysqli_fetch_assoc($q_u)) $user_id = $r_u['id_user'];
    }

    if($waktu_transaksi && $pelanggan_id){
        try {
            if($id_post){
                $sql = "UPDATE transaksi SET waktu_transaksi='$waktu_transaksi', pelanggan_id='$pelanggan_id', keterangan='$keterangan' WHERE id='$id_post'";
                mysqli_query($conn, $sql);
                $sukses = "Data transaksi berhasil diupdate";
                echo "<script>window.location='index.php?page=transaksi';</script>";
            } else {
                $sql = "INSERT INTO transaksi (waktu_transaksi, pelanggan_id, user_id, keterangan, total) VALUES ('$waktu_transaksi', '$pelanggan_id', '$user_id', '$keterangan', 0)";
                mysqli_query($conn, $sql);
                $new_id = mysqli_insert_id($conn);
                echo "<script>window.location='index.php?page=transaksi&detail_id=$new_id';</script>";
            }
        } catch (Exception $e) {
            $error = "Gagal menyimpan: " . $e->getMessage();
        }
    } else {
        $error = "Tanggal dan Pelanggan wajib diisi.";
    }
}

if($op == 'add' || $op == 'edit'){
    $q_pel = mysqli_query($conn, "SELECT id, nama FROM pelanggan ORDER BY nama ASC");
    $list_pelanggan = mysqli_fetch_all($q_pel, MYSQLI_ASSOC);

    if($op == 'edit' && isset($_GET['id'])){
        $id_edit = $_GET['id'];
        $q_edit= mysqli_query($conn, "SELECT * FROM transaksi WHERE id='$id_edit'");
        $r_edit = mysqli_fetch_assoc($q_edit);
        if($r_edit){
            $waktu_transaksi = $r_edit['waktu_transaksi'];
            $pelanggan_id= $r_edit['pelanggan_id'];
            $keterangan= $r_edit['keterangan'];
            $id_transaksi= $r_edit['id'];
        }
    }
}

$sql_list = "SELECT tr.id, tr.waktu_transaksi AS wt, p.nama, tr.keterangan, tr.total 
                FROM transaksi AS tr 
                INNER JOIN pelanggan AS p ON tr.pelanggan_id = p.id 
                ORDER BY tr.id DESC"; 
$result_list = mysqli_query($conn, $sql_list);
$penjualan = mysqli_fetch_all($result_list, MYSQLI_ASSOC);

$detail_data = [];
$list_barang = [];
if ($selected_transaksi_id) {
    $sql_detail = "SELECT td.transaksi_id, td.barang_id, b.nama_barang, td.harga, td.qty, (td.harga * td.qty) as subtotal
                    FROM transaksi_detail td
                    JOIN barang b ON td.barang_id = b.id
                    WHERE td.transaksi_id = $selected_transaksi_id";
    $q_detail = mysqli_query($conn, $sql_detail);
    if ($q_detail) $detail_data = mysqli_fetch_all($q_detail, MYSQLI_ASSOC);

    $q_barang = mysqli_query($conn, "SELECT id, nama_barang, harga, stok FROM barang ORDER BY nama_barang ASC");
    if($q_barang) $list_barang = mysqli_fetch_all($q_barang, MYSQLI_ASSOC);
}
?>

<div class="container">
    <h2 class="judul">Daftar Transaksi</h2>

    <?php if($error){ ?><div style="background:#f8d7da;color:#721c24;padding:10px;margin-bottom:10px;border-radius:4px;"><?= $error ?></div><?php } ?>
    
    <?php if($op == 'add' || $op == 'edit'): ?>
        <div class="form-container" style="margin-bottom: 20px; border: 1px solid #ddd; padding: 20px; background: #fff;">
            <h3><?= ($op == 'edit') ? "Edit Header Transaksi (ID: $id_transaksi)" : "Transaksi Baru"; ?></h3>
            <form action="index.php?page=transaksi&op=<?= $op ?>" method="post">
                <input type="hidden" name="id" value="<?= $id_transaksi ?>">
                
                <div style="margin-bottom: 15px;">
                    <label>Waktu Transaksi</label><br>
                    <input type="date" name="waktu_transaksi" value="<?= $waktu_transaksi ?>" required style="padding: 5px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label>Pelanggan</label><br>
                    <select name="pelanggan_id" required style="padding: 5px; width: 300px;">
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php foreach($list_pelanggan as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= ($pelanggan_id == $p['id'])?'selected':'' ?>><?= $p['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label>Keterangan (Opsional)</label><br>
                    <textarea name="keterangan" rows="2" style="width: 300px;"><?= $keterangan ?></textarea>
                </div>

                <button type="submit" name="simpan_header" class="btn-simpan" style="padding: 8px 15px;">Simpan & Lanjut</button>
                <a href="index.php?page=transaksi" class="btn-batal" style="text-decoration:none; padding: 8px 15px; background: #ddd; color: #333; border-radius: 3px;">Batal</a>
            </form>
        </div>
    
    <?php else: ?>
        
        <div class="head" style="margin-bottom: 20px;">
            <a href="index.php?page=transaksi&op=add" style="text-decoration: none;">
                <button class="tambah" type="button">+ Tambah Transaksi</button>
            </a>
        </div>

        <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Waktu</th>
                <th>Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>
            <?php $no=1; foreach ($penjualan as $row): ?>
            <tr style="<?= ($row['id'] == $selected_transaksi_id) ? 'background-color: #e3f2fd;' : '' ?>">
                <td><?= $no++ ?></td>
                <td><?= $row['id'] ?></td>
                <td><?= date('d/m/Y', strtotime($row['wt'])) ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td><?= "Rp " . number_format($row['total'], 0, ',', '.') ?></td>
                <td class="form_action">
                    <a href="index.php?page=transaksi&detail_id=<?= $row['id'] ?>#detail-area">
                        <button class="btn-detail" style="background:#2196F3;color:white;border:none;padding:5px 10px;border-radius:3px;cursor:pointer;">Detail</button>
                    </a>
                    <a href="index.php?page=transaksi&op=edit&id=<?= $row['id'] ?>">
                        <button class="edit" style="cursor:pointer;padding:5px 10px;">Edit</button>
                    </a>
                    <a href="index.php?page=transaksi&op=delete_head&id=<?= $row['id'] ?>" onclick="return confirm('Hapus transaksi ID <?= $row['id'] ?> beserta seluruh detailnya?')">
                        <button class="hapus" style="cursor:pointer;padding:5px 10px;">Hapus</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <?php
        if(isset($_GET['op']) && $_GET['op'] == 'delete_head'){
            $id_del_head = $_GET['id'];
            mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id='$id_del_head'");
            mysqli_query($conn, "DELETE FROM pembayaran WHERE transaksi_id='$id_del_head'");
            if(mysqli_query($conn, "DELETE FROM transaksi WHERE id='$id_del_head'")){
                echo "<script>alert('Transaksi dihapus'); window.location='index.php?page=transaksi';</script>";
            }
        }
        ?>

        <?php if ($selected_transaksi_id): ?>
            <div id="detail-area" style="margin-top: 30px; padding: 20px; background: #f9f9f9; border: 1px solid #ddd; border-radius: 5px;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <h3>Kelola Barang - Transaksi ID: <?= $selected_transaksi_id ?></h3>
                    <a href="index.php?page=transaksi" style="text-decoration:none; color:white;" class="hapus">[x] Tutup Detail</a>
                </div>

                <form action="index.php?page=transaksi_detail_proses" method="post" style="margin-bottom: 20px; background: #fff; padding: 15px; border: 1px solid #eee;">
                    <input type="hidden" name="aksi" value="tambah">
                    <input type="hidden" name="transaksi_id" value="<?= $selected_transaksi_id ?>">
                    
                    <label><b>Tambah Barang:</b></label>
                    <select name="barang_id" required style="padding: 7px; margin-right: 5px;">
                        <option value="">-- Pilih Barang --</option>
                        <?php foreach ($list_barang as $brg): ?>
                            <option value="<?= $brg['id'] ?>">
                                <?= $brg['nama_barang'] ?> (Stok: <?= $brg['stok'] ?>) - Rp <?= number_format($brg['harga'],0,',','.') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="qty" placeholder="Qty" value="1" min="1" required style="width: 60px; padding: 6px; margin-right: 5px;">
                    <button type="submit" style="background-color: #4CAF50; color: white; border: none; padding: 7px 15px; border-radius: 3px; cursor: pointer;">+ Tambah</button>
                </form>

                <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; background-color: #fff;">
                    <tr style="background-color: #f2f2f2;">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th style="width: 120px;">Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                    <?php 
                        $no_d = 1; 
                        $grand_total = 0; 
                    ?>
                    <?php if(!empty($detail_data)): foreach ($detail_data as $dd): ?>
                    <tr>
                        <td><?= $no_d++ ?></td>
                        <td><?= $dd['nama_barang'] ?></td>
                        <td>Rp <?= number_format($dd['harga'], 0, ',', '.') ?></td>
                        <td>
                            <form action="index.php?page=transaksi_detail_proses" method="post" style="display:flex;">
                                <input type="hidden" name="aksi" value="update">
                                <input type="hidden" name="transaksi_id" value="<?= $selected_transaksi_id ?>">
                                <input type="hidden" name="barang_id" value="<?= $dd['barang_id'] ?>">
                                <input type="number" name="qty" value="<?= $dd['qty'] ?>" min="1" style="width: 50px; margin-right:5px;">
                                <button type="submit" style="border:none; background:#2196F3; color:#fff; cursor:pointer;">update</button>
                            </form>
                        </td>
                        <td>Rp <?= number_format($dd['subtotal'], 0, ',', '.') ?></td>
                        <td style="text-align:center;">
                            <a href="index.php?page=transaksi_detail_proses&aksi=hapus&transaksi_id=<?= $selected_transaksi_id ?>&barang_id=<?= $dd['barang_id'] ?>" onclick="return confirm('Hapus item ini?')" style="text-decoration:none;" class="hapus">Hapus</a>
                        </td>
                    </tr>
                    <?php $grand_total += $dd['subtotal']; endforeach; else: ?>
                        <tr><td colspan="6" style="text-align:center; color:#777;">Belum ada barang dipilih.</td></tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold;">TOTAL TAGIHAN</td>
                        <td colspan="2" style="font-weight: bold; background-color: #e8f5e9;">Rp <?= number_format($grand_total, 0, ',', '.') ?></td>
                    </tr>
                </table>
                <script>document.getElementById('detail-area').scrollIntoView({behavior: "smooth"});</script>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>