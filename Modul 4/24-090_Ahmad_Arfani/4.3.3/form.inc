<form method="post" action="form.php">
    <label for="surname">Surname:</label><br>
    <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($_POST['surname'] ?? ''); ?>"><br>
    <?php if (!empty($errors['surname'])) echo "<small style='color:red;'>{$errors['surname']}</small>"; ?>
    <br><br>

    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"><br>
    <?php if (!empty($errors['email'])) echo "<small style='color:red;'>{$errors['email']}</small>"; ?>
    <br><br>

    <label for="age">Umur:</label><br>
    <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>"><br>
    <?php if (!empty($errors['age'])) echo "<small style='color:red;'>{$errors['age']}</small>"; ?>
    <br><br>

    <label for="birthdate">Tanggal Lahir (YYYY-MM-DD):</label><br>
    <input type="text" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($_POST['birthdate'] ?? ''); ?>"><br>
    <?php if (!empty($errors['birthdate'])) echo "<small style='color:red;'>{$errors['birthdate']}</small>"; ?>
    <br><br>

    <input type="submit" value="Submit">
</form>
