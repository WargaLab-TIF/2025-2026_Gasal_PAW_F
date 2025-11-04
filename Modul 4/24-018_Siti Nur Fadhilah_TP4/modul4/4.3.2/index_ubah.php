<?php
/* == No 11 ==*/
// $errors = array();
// require 'validate1.inc'; 

// if (isset($_POST['surname'])) {
// // --- JIKA FORM DISUBMIT ---
// validateName($errors, $_POST, 'surname'); 
// if ($errors) 
// {
// // JIKA ADA ERROR

// foreach ($errors as $field => $error)
// echo "$field $error</br>";

// include 'form.inc'; 
// }
// else
// {
// // JIKA TIDAK ADA ERROR
// echo 'Form submitted successfully with no errors';
// }
// }
// else{
//     include 'form.inc';
// }


/* == No 14 ==*/
$errors = array();
require 'validate1.inc'; 

if (isset($_POST['surname'])) {
// --- JIKA FORM DISUBMIT ---
validateName($errors, $_POST, 'surname'); 
if ($errors) 
{
// JIKA ADA ERROR

foreach ($errors as $field => $error)
echo "$field $error</br>";

include 'form1.inc'; 
}
else
{
// JIKA TIDAK ADA ERROR
echo 'Form submitted successfully with no errors';
}
}
else{
    include 'form1.inc';
}
?>