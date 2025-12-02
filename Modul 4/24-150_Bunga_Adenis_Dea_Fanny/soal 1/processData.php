<?php
require 'validate.inc';

$errors = array();  

if (validateName($_POST, 'surname', $errors)) {
    echo 'Data OK!';
} else {
    if (!empty($errors)) {
        foreach ($errors as $field => $msg) {
            echo "Error pada $field: $msg<br>";
        }
    } 
    }

$surname = $_POST['surname'];
$email    = $_POST['email'];
$password = $_POST['password'];
$street   = $_POST['street'];
$state    = $_POST['state'];
$country  = $_POST['country'];
$gender   = $_POST['gender'];
$hobi     = $_POST['hobi']; 

echo "<h1>Hasil Pengisian Form</h1>";
echo "<p><b>surname:</b> $surname</p>";
echo "<p><b>Email:</b> $email</p>";
echo "<p><b>Password:</b> $password</p>";
echo "<p><b>Street Address:</b> $street</p>";
echo "<p><b>State/Provinsi:</b> $state</p>";
echo "<p><b>Country:</b> $country</p>";
echo "<p><b>Gender:</b> $gender</p>";
echo "<p><b>Hobi:</b> " . (is_array($_POST['hobi']) ? implode(', ', $_POST['hobi']) : $_POST['hobi']) . "</p>"; 
echo '<p><a href="processData_form.html">Isi lagi</a></p>';





?>