<form action="form.php" method="post">
    <label>Surname:</label>
    <input type="text" name="surname" value="<?php echo $_POST['surname'] ?? ''; ?>"><br>

    <label>NIM:</label>
    <input type="text" name="nim" value="<?php echo $_POST['nim'] ?? ''; ?>"><br>

    <input type="submit" value="Submit">
</form>
