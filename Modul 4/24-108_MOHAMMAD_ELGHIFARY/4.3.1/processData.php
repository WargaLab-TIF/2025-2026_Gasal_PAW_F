<?php
require 'validate.inc';
if (validateName($_POST, 'username')['kondisi'])
    echo 'Data OK!';
else
    echo 'Data invalid!';
    echo validateName($_POST, 'username')['eror'];
?>