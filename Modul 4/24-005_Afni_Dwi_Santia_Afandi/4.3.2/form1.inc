<form action="index_ubah.php" method="POST">
    <label for="surname">Surname:</label>

    <input type="text" id="surname" name="surname"
    value="<?php if (isset($_POST['surname'])) echo $_POST['surname']; ?>">

    <input type="submit" value="Submit">
</form>