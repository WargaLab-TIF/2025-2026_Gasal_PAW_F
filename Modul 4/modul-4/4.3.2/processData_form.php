<?php
    require 'validate.inc';


    $error = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (validateName($_POST, 'username', $error)){
            echo "Form submitted successfully with no errors.";
        }

        else {
             echo $error['username'];
             include "form.inc";
        }
    }
    else{
        include 'form.inc';
    }
?>

<!DOCTYPE html>
<html>
    <body><br> <br>
        
    </body>
</html>
