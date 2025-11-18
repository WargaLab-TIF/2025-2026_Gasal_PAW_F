<?php
require 'vallidate.inc';

$errors = [];
$data_ok = false;
$has_input = false;
$expected_fields = ['username', 'email', 'password'];

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

        if ($v1 && $v2 && $v3) {
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
  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      include 'form.inc';
  } elseif (!$has_input) {
      include 'form.inc';
  } elseif ($data_ok) {
    echo "<p style='color:green;'>Form submitted successfully with no errors.</p>";
  } else {
      echo "<p style='color:red;'>Terjadi error. Silakan periksa kembali input Anda.</p>";
      echo "<ul style='color:red;'>";
      foreach ($errors as $k => $v) {
          echo "<li>" . htmlspecialchars($v) . "</li>";
      }
      echo "</ul>";
      include 'form.inc';
  }
  ?>
</body>
</html>
