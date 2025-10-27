<?php
$errors = [];
$data = [];

function old($field, $default = '') {
    global $data;
    return isset($data[$field]) ? htmlspecialchars($data[$field]) : $default;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    if (!empty($_POST)) {
        //Validasi
        $username = trim(strtolower($_POST['username'] ?? ''));
        if ($username === '') {
            $errors['username'] = "Username tidak boleh kosong.";
        } elseif (!preg_match("/^[a-z'-]+$/", $username)) {
            $errors['username'] = "Username hanya boleh berisi huruf, tanda kutip tunggal ('), atau tanda hubung (-).";
        }

        $email = trim($_POST['email'] ?? '');
        if ($email === '') {
            $errors['email'] = "Email tidak boleh kosong.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format email tidak valid.";
        }

        $password = trim($_POST['password'] ?? '');
        if ($password === '') {
            $errors['password'] = "Password tidak boleh kosong.";
        } elseif (!is_string($password)) {
            $errors['password'] = "Password harus berupa teks.";
        } elseif (strlen($password) < 6) {
            $errors['password'] = "Password minimal 6 karakter.";
        }

        $alamat = trim($_POST['alamat'] ?? '');
        if ($alamat === '') {
            $errors['alamat'] = "Alamat tidak boleh kosong.";
        } elseif (strlen($alamat) < 10) {
            $errors['alamat'] = "Alamat minimal 10 karakter.";
        }

        $semester = $_POST['semester'] ?? '';
        if ($semester === '') {
            $errors['semester'] = "Semester harus dipilih.";
        } elseif (!is_numeric($semester) || $semester < 1 || $semester > 8) {
            $errors['semester'] = "Semester harus berupa angka antara 1–8.";
        }

        $country = $_POST['country'] ?? 'Indonesia';
        if (!preg_match("/^[A-Za-z ]+$/", $country)) {
            $errors['country'] = "Nama negara tidak valid.";
        }

        $kelamin = $_POST['kelamin'] ?? '';
        if ($kelamin === '') {
            $errors['kelamin'] = "Jenis kelamin harus dipilih.";
        }

        $hobi = $_POST['hobi'] ?? [];
        if (empty($hobi)) {
            $errors['hobi'] = "Pilih minimal satu hobi.";
        }

        //pesan sukses
        if (empty($errors)) {
            echo "<p style='color:green;'>Form submitted successfully with no errors.</p>";
        //pesan gagal
        }else {
            foreach ($errors as $field => $message) {
                echo "$field: $message<br>";
            }
        }
    }
}


?>

<form action="" method="post">
  <label for="username">Username</label><br>
  <input type="text" id="username" name="username" value="<?= old('username') ?>"><br><br>

  <label for="email">Email</label><br>
  <input type="email" id="email" name="email" value="<?= old('email') ?>"><br><br>

  <label for="password">Password</label><br>
  <input type="password" id="password" name="password" value="<?= old('password') ?>"><br><br>

  <label for="alamat">Alamat</label><br>
  <textarea name="alamat" id="alamat"><?= old('alamat') ?></textarea><br><br>

  <label for="semester">Semester</label><br>
  <select name="semester" id="semester" style="width: 165px;">
    <?php
    for ($i = 1; $i <= 8; $i++) {
        $selected = (old('semester') == $i) ? 'selected' : '';
        echo "<option value='$i' $selected>$i</option>";
    }
    ?>
  </select><br><br>

  <label for="country">Country</label><br>
  <input type="hidden" name="country" value="Indonesia">
  <p>Indonesia</p><br>

  <label for="kelamin">Kelamin</label><br>
  <input type="radio" id="laki" name="kelamin" value="laki-laki"
    <?= (old('kelamin') == 'laki-laki') ? 'checked' : '' ?>> Laki-laki
  <input type="radio" id="perempuan" name="kelamin" value="perempuan"
    <?= (old('kelamin') == 'perempuan') ? 'checked' : '' ?>> Perempuan
  <br><br>

  <label>Hobi</label><br>
  <input type="checkbox" id="mancing" name="hobi[]" value="mancing"
    <?= (in_array('mancing', $data['hobi'] ?? [])) ? 'checked' : '' ?>> Mancing <br>
  <input type="checkbox" id="berenang" name="hobi[]" value="berenang"
    <?= (in_array('berenang', $data['hobi'] ?? [])) ? 'checked' : '' ?>> Berenang <br><br>
  
  <input type="submit" name="submit" id="submit" value="Kirim">
</form>


