<?php
$errors   = [];
$username = '';
$email    = '';
$password = '';
$alamat   = '';
$semester = '';
$country  = 'Indonesia';
$kelamin  = '';
$hobi     = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"] ?? "";
    $email    = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $alamat   = $_POST["alamat"] ?? "";
    $semester   = $_POST["semester"] ?? "";
    $kelamin   = $_POST["kelamin"] ?? "";
    $hobi     = $_POST["hobi"] ?? [];

    if (trim($username) === '') {
        $errors[] = "Field username tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z'-]+$/", $username)) {
        $errors[] = "Field username hanya boleh huruf (A–Z).";
    }

    if (empty($email)) {
        $errors['email'] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid.";
    }

    if (empty($password)) {
        $errors['password'] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password minimal 8 karakter.";
    }

    if (empty($alamat)) {
        $errors['alamat'] = "Alamat harus diisi.";
    }

    if (empty($semester)) {
        $errors['semester'] = "Semester harus dipilih.";
    }

    if (empty($kelamin)) {
        $errors['kelamin'] = "Pilih salah satu gender.";
    }

    if (empty($hobi)) {
        $errors['hobi'] = "Pilih setidaknya satu hobi.";
    }
    
    if (empty($errors)) {
        echo "<h2 style='color:green;'>Form submitted successfully!</h2>";
        echo "<p><b>Username:</b> " . htmlspecialchars($username) . "</p>";
        echo "<p><b>Email:</b> " . htmlspecialchars($email) . "</p>";
        echo "<p><b>Password:</b> (disembunyikan demi keamanan)</p>";
        echo "<p><b>Alamat:</b> " . htmlspecialchars($alamat) . "</p>";
        echo "<p><b>Semester:</b> " . htmlspecialchars($semester) . "</p>";
        echo "<p><b>Gender:</b> " . htmlspecialchars($kelamin) . "</p>";
        echo "<p><b>Hobi:</b> " . htmlspecialchars(implode(', ', (array)$hobi)) . "</p>";
        exit; 
    }

    // $username = '';
    // $email = '';
    // $password = '';
    // $alamat = '';
    // $semester = '';
    // $country = 'Indonesia';
    // $kelamin = '';
    // $hobi = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Validasi</title>
</head>
<body>
  <h1>Form Validasi</h1>

  <?php if (!empty($errors)): ?>
    <div style="color:red;">
      <strong>Data invalid!</strong><br>
      <?php foreach ($errors as $e) { echo htmlspecialchars($e) . "<br>"; } ?>
    </div>
  <?php endif; ?>

  <?php include __DIR__ . '/form.inc'; ?>
</body>
</html>
