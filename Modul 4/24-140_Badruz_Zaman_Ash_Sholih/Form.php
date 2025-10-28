<?php
require 'validate.inc';
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_POST['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $_POST['url']   = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
    $_POST['ip']    = filter_input(INPUT_POST, 'ip', FILTER_SANITIZE_SPECIAL_CHARS);

    $validName   = validateName($_POST, 'surname', $error);
    $validAge    = validateAge($_POST, 'age', $error);
    $validEmail  = validateEmail($_POST, 'email', $error);
    $validPhone  = validatePhone($_POST, 'phone', $error);
    $validURL    = validateURL($_POST, 'url', $error);
    $validIP     = validateIP($_POST, 'ip', $error);
    $validFloat  = validateFloat($_POST, 'nilai', $error);
    $validDate   = validateDate($_POST, 'tanggal', $error);

    if ($validName && $validAge && $validEmail && $validPhone && $validURL && $validIP && $validFloat && $validDate) {
        echo "<p>Form submitted successfully with no errors.</p>";
    } else {
        echo "<p>Form submitted not successfully, there are errors:</p>";
        foreach ($error as $err) {
            echo "<p>$err</p>";
        }
        include 'form.inc';
    }

} else {
    include 'form.inc';
}
?>
