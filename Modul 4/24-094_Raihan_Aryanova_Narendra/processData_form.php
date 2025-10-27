<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (!empty($_POST)) {
//         $errors = [];
//         // username
//         $username = trim($_POST['username'] ?? '');
//         if ($username === '') {
//             $errors['username'] = "Username tidak boleh kosong.";
//         } elseif (!preg_match("/^[a-zA-Z'-]+$/", $username)) {
//             $errors['username'] = "Username hanya boleh berisi huruf, tanda hubung (-), atau tanda kutip tunggal (').";
//         }

//         //error
//         if (empty($errors)) {
//             echo "<p style='color:green;'>Form submitted successfully with no errors.</p>";
//         } else {
//             foreach ($errors as $field => $message) {
//                 echo "$field: $message";
//             }
//         }

//       }
//     }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form</title>
</head>
<body>

  <?php require 'form.inc'; ?>

</body>
</html>
