<?php
// kembalikan array [bool $valid, string $error]
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
?>