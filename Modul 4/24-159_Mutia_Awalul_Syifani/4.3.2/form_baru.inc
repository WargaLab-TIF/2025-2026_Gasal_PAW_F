<form action="form_baru.php" method="POST">
    <label for="surname">Surname:</label>
    <input type="text" name="surname" id="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>" required>
    <br><br>
    <button type="submit">Kirim</button>
</form>
