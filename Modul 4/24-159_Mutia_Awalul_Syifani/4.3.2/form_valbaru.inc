<form action="form.php" method="POST">
    <label for="surname">Surname:</label>
    <input type="text" name="surname" id="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>" required>
    <br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
    <br><br>
    <button type="submit">Kirim</button>
</form>
