<?php
include 'conn.php';
function validasi_nama($nama) {
    $nama = trim($nama);
    if ($nama === ''){return [false,"Nama Harus Di isi"];}
    if (!preg_match('/^[a-zA-Z\s]+$/', $nama)){
        return [false,"Hanya menggunakan huruf dan spasi"];}
    return [true," "];
}

function validasi_telp($telp) {
    $telp = trim($telp);
    if ($telp === ''){return [false,"No Telepon harus di isi"];}
    if (!preg_match('/^\d+$/', $telp)){
        return [false,"Gunakan Angka"];}
    return [true," "];
}

function validasi_alamat($alamat) {
    $alamat = trim($alamat);
    if ($alamat === ''){return [false,"Alamat Harus di isi"];}
    if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9\s.,-]+$/', $alamat)){
        return [false,"Setidaknya memiliki satu angka dan satu huruf"];}
    return [true," "];
}
function validasi_Null($isi){
    $isi=trim($isi);
    if ($isi===''){
        return [false,"Inputan Harus di Isi"];
    }

    return [true,' '];
}

function validasi_username($isi,$conn){
    $isi=trim($isi);
    if ($isi===''){
        return [false,"Username harus di Isi"];
    }
    $sql="SELECT 1 FROM user WHERE username = '$isi'";
    $result=mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) == 0) {
        return [false, "Username Tidak sesuai"];
    }
    return [true,' '];
}

function validasi_password($password, $username,$koneksi) {
    if ($password === '') {
        return [false, "Password harus di Isi"];
    }

    $password_md5 = md5($password);

    $query = "SELECT 1 FROM user WHERE username = '$username' AND password = '$password_md5'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 0) {
        return [false, "Password Username salah"];
    }

    return [true, ""];
}

function validasi_hp($hp){
    $hp=trim($hp);
    if ($hp===''){
        return [false,"Silahkan Masukan Nomor Telepon User"];
    }
    if (!preg_match('/^[0-9]+$/', $hp)){
        return [false,"Harus berisi angka"];
    }
    return [true," "];
}

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

function validasi_supp($bar,$koneksi){
    if ($bar===''){
        return [false,"Silahkan Pilih Nama Supplier Terlebih dahulu"];
    }

    $temp="SELECT 1 FROM supplier WHERE id=$bar";
    $cek = mysqli_query($koneksi,$temp);
    if (mysqli_num_rows($cek)) {
        return [true," "];
        
    }
    return [false,'Supplier ini belum terdaftar'];
    
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