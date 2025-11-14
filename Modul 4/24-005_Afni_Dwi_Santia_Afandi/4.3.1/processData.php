<?php  
require 'validate.inc'; 

if (validateName($_POST, 'surname')) 
    echo 'Data OK!'; 
else 
    echo 'Data invalid!'; 
?> 