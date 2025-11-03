<form action="form.php" method="post">
    <label>Surname:</label>
    <input type="text" name="surname"
           value="<?php if (isset($_POST['surname'])) echo htmlspecialchars($_POST['surname']); ?>">
    <br><br>

    <label>Email:</label>
    <input type="text" name="email"
           value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">
    <br><br>

    <label>Age:</label>
    <input type="text" name="age"
           value="<?php if (isset($_POST['age'])) echo htmlspecialchars($_POST['age']); ?>">
    <br><br>

    <label>Tanggal Lahir:</label>
    <input type="text" name="day" size="2" placeholder="DD"
           value="<?php if (isset($_POST['day'])) echo htmlspecialchars($_POST['day']); ?>">
    <input type="text" name="month" size="2" placeholder="MM"
           value="<?php if (isset($_POST['month'])) echo htmlspecialchars($_POST['month']); ?>">
    <input type="text" name="year" size="4" placeholder="YYYY"
           value="<?php if (isset($_POST['year'])) echo htmlspecialchars($_POST['year']); ?>">
    <br><br>

    <input type="submit" name="submit" value="Kirim">
</form>
