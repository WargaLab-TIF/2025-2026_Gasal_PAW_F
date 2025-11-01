<?php
    require 'validate.inc';


    $error = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        validateName($_POST, 'username', $error);
        cekemail($_POST, 'email', $error);
        cekumur($_POST, 'umur', $error);
        cekurl($_POST, 'website', $error);
        cektanggal($_POST,'tanggal', $error);
        ceknegara($_POST, 'negara', $error);
        cekfloat($_POST, 'float', $error);
        cekip($_POST, 'ip', $error);
        

        if (empty($error)) {
            echo "<p style='color:green;'>Form submitted successfully with no errors.</p>";
        } 
        else {
            
            foreach ($error as $err) {
                echo "<p style='color:red;'>$err</p>";
            }
            include "form.inc";
        }
    } 
    else {
        include "form.inc";
        }

?>

<!DOCTYPE html>
<html>
    <body>
        
    </body>
</html>
