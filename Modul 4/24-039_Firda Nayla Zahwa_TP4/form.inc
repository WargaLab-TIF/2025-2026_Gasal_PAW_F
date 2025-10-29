<form method="post" action="form.php">
    <label>Nama Depan:</label><br>
    <input type="text" name="nama_depan"
           value="<?php echo isset($_POST['nama_depan']) ? htmlspecialchars($_POST['nama_depan']) : ''; ?>">
    <?php if (isset($errors['nama_depan'])) echo $errors['nama_depan'] . "<br>"; ?>
    <br>

    <label>Nama Belakang:</label><br>
    <input type="text" name="nama_belakang"
           value="<?php echo isset($_POST['nama_belakang']) ? htmlspecialchars($_POST['nama_belakang']) : ''; ?>">
    <?php if (isset($errors['nama_belakang'])) echo $errors['nama_belakang'] . "<br>"; ?>
    <br>

    <input type="submit" value="Submit">
</form>
