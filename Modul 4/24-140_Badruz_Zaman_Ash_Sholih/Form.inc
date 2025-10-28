<form method="post" action="Form.php">
        Surname: <input type="text" name="surname" value="<?= htmlspecialchars($_POST['surname'] ?? '') ?>">
        <br> <br>

        Umur : <input type="text" name="age" value="<?= htmlspecialchars($_POST['age'] ?? '') ?>">
        <br> <br>

        Email : <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        <br> <br>

        Nomor Telepon : <input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
        <br> <br>

        Website : <input type="text" name="url" value="<?= htmlspecialchars($_POST['url'] ?? '') ?>">
        <br> <br>

        Alamat IP : <input type="text" name="ip" value="<?= htmlspecialchars($_POST['ip'] ?? '') ?>">
        <br> <br>

        Nilai (Float) : <input type="text" name="nilai" value="<?= htmlspecialchars($_POST['nilai'] ?? '') ?>">
        <br> <br>

        Tanggal (DD-MM-YYYY) : <input type="text" name="tanggal" value="<?= htmlspecialchars($_POST['tanggal'] ?? '') ?>">
        <br> <br>
        
        <input type="submit" value="Submit">
</form>