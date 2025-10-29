<?php
require __DIR__ . '/validate.inc';

$errors   = [];
$submitted = ($_SERVER['REQUEST_METHOD'] === 'POST');

$surname  = $_POST['surname']  ?? '';
$email    = $_POST['email']    ?? '';
$password = $_POST['password'] ?? '';
$street   = $_POST['street']   ?? '';
$state    = $_POST['state']    ?? '';
$country  = $_POST['country']  ?? 'Indonesia';
$gender   = $_POST['gender']   ?? '';
$hobi     = $_POST['hobi']     ?? [];

if ($submitted) {
    validateName($_POST, 'surname', $errors);
    validateEmail($_POST, 'email', $errors);
    validatePassword($_POST, 'password', $errors);
    validateStreet($_POST, 'street', $errors);
    validateState($_POST, 'state', $errors);
    validateGender($_POST, 'gender', $errors);
    validateHobi($_POST, 'hobi', $errors);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Data Pribadi</title>
</head>
<body>

<?php if ($submitted && empty($errors)): ?>
  <h3>Form submitted successfully with no errors</h3>
  <p><b>Surname:</b> <?= $surname ?></p>
  <p><b>Email:</b> <?= $email ?></p>
  <p><b>Password:</b> <?= $password ?></p>
  <p><b>Street Address:</b> <?= nl2br($street) ?></p>
  <p><b>State:</b> <?= $state ?></p>
  <p><b>Country:</b> <?= $country ?></p>
  <p><b>Gender:</b> <?= $gender ?></p>
  <p><b>Hobi:</b> <?= is_array($hobi) ? implode(', ', $hobi) : $hobi ?></p>
  <p><a href="processData_form.php">Kembali ke form kosong</a></p>

<?php else: ?>
  <?php if ($submitted && !empty($errors)): ?>
    <h3 style="color:red;">Terdapat beberapa kesalahan:</h3>
    <ul style="color:red;">
      <?php foreach ($errors as $field => $msg): ?>
        <li><?= $msg ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <?php include __DIR__ . '/form.inc'; ?>
<?php endif; ?>

</body>
</html>
