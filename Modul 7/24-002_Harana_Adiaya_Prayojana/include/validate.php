<?php
require_once('conn.php');
function validasi_tgl($tgl) {
    global $koneksi;
    if ($tgl === '') {
        return [false, "Tanggal harus diisi."];
    }

    $dt = DateTime::createFromFormat('Y-m-d', $tgl);
    if (!$dt || $dt->format('Y-m-d') !== $tgl) {
        return [false, "Format tanggal salah. Gunakan YYYY-MM-DD."];
    }
    $sql_cek = "SELECT 1 FROM transaksi WHERE waktu_transaksi = '$tgl' LIMIT 1";
    $cek = mysqli_query($koneksi, $sql_cek);
    if (mysqli_num_rows($cek) == 0) {
        return [false, "Tidak ada data Transaksi pada Tanggal $tgl"];
    }

    return [true, ""];
}
function validasi_keterangan($keterangan) {
    $keterangan = trim($keterangan);
    if ($keterangan === ''){return [false,"Keterangan Harus di isi"];}
    if (strlen($keterangan)<=3){
        return [false,"Setidaknya memiliki Panjang minimal 3 karakter"];}
    return [true," "];
}

function validasi_total($total){
    $total=trim($total);
    if (!preg_match('/^[0-9]+$/', $total)){
        return [false,"Harus berisi angka"];
    }
    return [true," "];
}

function validasi_pelanggan($pelanggan){
    if ($pelanggan===''){
        return [false,"Silahkan Pilih Nama Pelanggan Terlebih dahulu"];
    }
    return [true," "];
}

function validasi_Barang($bar,$idTrans,$koneksi){
    if ($bar===''){
        return [false,"Silahkan Pilih Nama Barang Terlebih dahulu"];
    }

    $temp="SELECT 1 FROM transaksi_detail WHERE transaksi_id=$idTrans AND barang_id=$bar";
    $cek = mysqli_query($koneksi,$temp);
    if (mysqli_num_rows($cek)) {
        return [false,'Barang ini sudah ada di detail transaksi'];
    }

    return [true," "];
}

function validasi_idTrans($idTrans){
    if ($idTrans===''){
        return [false,"Silahkan Pilih ID Transaksi Terlebih dahulu"];
    }
    return [true," "];
}

function validasi_QTY($qty){
    $qty=trim($qty);
    if ($qty===''){
        return [false,"Silahkan Masukan Banyak Barang Yang Dibeli"];
    }
    if (!preg_match('/^[0-9]+$/', $qty)){
        return [false,"Harus berisi angka"];
    } 
    return [true," "];
}
?>