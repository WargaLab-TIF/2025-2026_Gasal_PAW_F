<form action="form.php" method="POST">
    <label for="surname">Surname:</label>
    <input type="text" name="surname" id="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>" required>
    <br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
    <br><br>
    <label for="url">URL:</label>
    <input type="url" name="url" id="url" value="<?php echo isset($_POST['url']) ? htmlspecialchars($_POST['url']) : ''; ?>" required>
    <br><br>
    <label for="number">Number (Float):</label>
    <input type="text" name="number" id="number" value="<?php echo isset($_POST['number']) ? htmlspecialchars($_POST['number']) : ''; ?>" required>
    <br><br>
    <label for="date">Date (YYYY-MM-DD):</label>
    <input type="text" name="date" id="date" value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?>" required>
    <br><br>
    <button type="submit">Kirim</button>
</form>