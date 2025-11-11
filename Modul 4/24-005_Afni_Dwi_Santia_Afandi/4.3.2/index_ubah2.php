<?php
//
$errors = array();
require 'validate2.inc'; //
//
if (isset($_POST['surname'])) //
{
validateName($errors, $_POST, 'given_name'); //
validateName($errors, $_POST, 'surname'); //
if ($errors) //
{
// JIKA ADA ERROR
include 'form2.inc'; //
}
else
{
// JIKA TIDAK ADA ERROR
echo 'Form submitted successfully with no errors';
}
}
else{
    include 'form2.inc';
}
?>
