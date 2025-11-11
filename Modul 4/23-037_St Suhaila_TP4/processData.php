<?php
include 'validate.inc'; // file untuk fungsi validasi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = trim($_POST['surname']);

    // Panggil fungsi validasi dari validate.inc
    if (validateSurname($surname)) {
        echo "<h4 '>DATA OK</h4>";
    } else {
        echo "<h4 '>Data invalid</h4>";
    }
}
?>
