<?php
$errors = [];
$is_success = false;

$nama = '';
$email = '';
$umur = '';
$kode_produk = '';
$tgl = '';
$bln = '';
$thn = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nama = trim(htmlspecialchars($_POST['nama'] ?? ''));
    $email = trim(htmlspecialchars($_POST['email'] ?? ''));
    $umur = trim(htmlspecialchars($_POST['umur'] ?? ''));
    $kode_produk = trim(htmlspecialchars($_POST['kode_produk'] ?? ''));
    $tgl = trim(htmlspecialchars($_POST['tgl'] ?? ''));
    $bln = trim(htmlspecialchars($_POST['bln'] ?? ''));
    $thn = trim(htmlspecialchars($_POST['thn'] ?? ''));

    if (empty($nama)) {
        $errors[] = 'Nama tidak boleh kosong.';
    }

    $email_clean = strtolower($email);
    if (empty($email_clean)) {
        $errors[] = 'Email tidak boleh kosong.';
    } elseif (!filter_var($email_clean, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    }

    if (empty($umur)) {
        $errors[] = 'Umur tidak boleh kosong.';
    } elseif (!is_numeric($umur)) {
        $errors[] = 'Umur harus berupa angka.';
    }

    $pattern = "/^[A-Z]{3}-[0-9]{3}$/";
    if (empty($kode_produk)) {
        $errors[] = 'Kode Produk tidak boleh kosong.';
    } elseif (!preg_match($pattern, $kode_produk)) {
        $errors[] = 'Format Kode Produk salah. (Contoh: ABC-123)';
    }

    if (empty($tgl) || empty($bln) || empty($thn)) {
        $errors[] = 'Tanggal Lahir harus diisi lengkap (Tgl, Bln, Thn).';
    } elseif (!ctype_digit($tgl) || !ctype_digit($bln) || !ctype_digit($thn)) {
        $errors[] = 'Tanggal Lahir harus berupa angka.';
    } elseif (!checkdate((int)$bln, (int)$tgl, (int)$thn)) {
        $errors[] = 'Tanggal Lahir tidak valid (contoh: 31 Feb 2020).';
    }

    if (empty($errors)) {
        $is_success = true;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Validasi PHP</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 300px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
        .pesan { padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .sukses { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <?php
    if ($is_success) {
        echo "<div class='pesan sukses'>Form berhasil disubmit! Semua data valid.</div>";
    }

    if (!empty($errors)) {
        echo "<div class='pesan error'>";
        echo "<strong>Terdapat error:</strong><ul>";
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo "</ul></div>";
    }
    ?>

    <?php 
    if (!$is_success) : 
    ?>
    <form action="" method="post" novalidate>
        
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="test@example.com">
        </div>
        
        <div>
            <label for="umur">Umur</label>
            <input type="text" id="umur" name="umur" value="<?php echo $umur; ?>" placeholder="25">
        </div>
        
        <div>
            <label for="kode_produk">Kode Produk</label>
            <input type="text" id="kode_produk" name="kode_produk" value="<?php echo $kode_produk; ?>" placeholder="ABC-123">
        </div>

        <div>
            <label>Tanggal Lahir</label>
            <input type="text" name="tgl" placeholder="Tgl" style="width: 50px;" value="<?php echo $tgl; ?>">
            <input type="text" name="bln" placeholder="Bln" style="width: 50px;" value="<?php echo $bln; ?>">
            <input type="text" name="thn" placeholder="Thn" style="width: 70px;" value="<?php echo $thn; ?>">
        </div>

        <div>
            <button type="submit">Validasi Sekarang</button>
        </div>

    </form>
    <?php endif; ?>

</body>
</html>
