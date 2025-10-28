<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
            require 'form.inc.php';
            $error = [];
            $surname = '';
            $email = '';

            if ($_SERVER["REQUEST_METHOD"] === "POST"){
                $surname = htmlspecialchars($_POST['surname']);
                $email = htmlspecialchars($_POST['email']);

                $error = array_merge(
                    validateName($_POST,'surname'),
                    validateEmail($_POST,'email'),
                );
                
                if (empty($error)) {
                    echo "<p style='color:green;'>Form submitteed succesfully with no errors.</p>";
                } else {
                    foreach($error as $err) {
                        echo "<p style='color:red;'>$err</p>";
                    }
                };
            };
        ?>
        <form action="index.php" method="POST">
            <label for="surname">Name</label><br>
            <input type="text" name="surname" id="surname" value="<?php echo $surname;?>"><br><br>

            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" value="<?php echo $email;?>"><br><br>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>