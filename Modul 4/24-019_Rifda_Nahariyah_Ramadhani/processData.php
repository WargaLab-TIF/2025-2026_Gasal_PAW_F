<?php
// require 'validate.inc';

// if (validateName($_POST, 'surname')) {
//     echo "Data OK!";
// } else {
//     echo "Data invalid!";
// }
?>

<?php
require 'validate.inc';
$errors = validateName($_POST, 'surname');

if (empty($errors)) {
    echo "Data OK!";
} else {
    echo "Data invalid!";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}
?>