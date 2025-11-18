<?php
require 'vallidate.inc';

$errors = [];
$data_ok = false;
$has_input = false;
$expected_fields = ['username', 'email', 'password', 'birth_day', 'birth_month', 'birth_year'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($expected_fields as $f) {
        if (!isset($_POST[$f])) continue;
        if (trim((string)$_POST[$f]) !== '') {
            $has_input = true;
            break;
        }
    }

    if ($has_input) {
        $v1 = validateName($_POST, 'username', $errors);
        $v2 = validateEmail($_POST['email'] ?? '', $errors);
        $v3 = validatePassword($_POST['password'] ?? '', $errors);

        $v4 = validateDate(
            $_POST['birth_day'] ?? '',
            $_POST['birth_month'] ?? '',
            $_POST['birth_year'] ?? '',
            $errors
        );

        if ($v1 && $v2 && $v3 && $v4) {
            $data_ok = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login (Self-Submission)</title>
</head>
<body>
  <?php
  if ($_SERVER['REQUEST_METHOD'] != 'POST' || !$has_input) {
      include 'form.inc';
  } elseif ($data_ok) {
      echo "<p style='color:green;'>Form submitted successfully with no errors</p>";
  } else {
      echo "<p style='color:red;'>Terjadi error. Silakan periksa kembali input Anda.</p>";
      echo "<ul style='color:red;'>";
      foreach ($errors as $v) {
          echo "<li>" . htmlspecialchars($v) . "</li>";
      }
      echo "</ul>";
      include 'form.inc';
  }
  ?>
</body>
</html>
