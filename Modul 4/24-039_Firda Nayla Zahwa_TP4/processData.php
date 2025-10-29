<?php
require 'validate.inc';

$errors = array();

if (validateName($_POST, 'surname', $errors))
    echo 'Data OK!';
else {
    echo 'Data invalid!<br>';
    foreach ($errors as $err)
        echo $err . "<br>";
}
?>
