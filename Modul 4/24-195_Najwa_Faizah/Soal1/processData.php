<?php
require 'validate.inc';
$errors = [];

if (validateName($_POST, 'surname', $errors)){
    echo 'Data OK!';
} else {
    echo 'Data invalid!';

    foreach($errors as $field){
        echo $field. '<br>';
    }
}
?>
