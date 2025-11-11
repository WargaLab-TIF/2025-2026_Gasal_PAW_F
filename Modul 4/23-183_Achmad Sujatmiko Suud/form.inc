<form method="post" action="form.php">
    <label for="surname">Surname:</label><br>
    <input type="text" id="surname" name="surname"
           value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>"><br>

    <?php
    if (!empty($errors['surname'])) {
        echo "<span style='color:red;'>{$errors['surname']}</span><br>";
    }
    ?>

    <br>
    <input type="submit" value="Submit">
</form>
