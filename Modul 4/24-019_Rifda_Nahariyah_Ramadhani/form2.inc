<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

    <label for="surname">Surname</label><br>
    <input type="text" name="surname" id="surname"
           value="<?php echo htmlspecialchars($surname); ?>"><br>
    <?php if (isset($errors["surname"])) echo "<div style='color:red'>" . $errors["surname"] . "</div>"; ?>

    <label for="email">Email</label><br>
    <input type="text" name="email" id="email"
           value="<?php echo htmlspecialchars($email); ?>"><br>
    <?php if (isset($errors["email"])) echo "<div style='color:red'>" . $errors["email"] . "</div>"; ?>

    <label for="password">Password</label><br>
    <input type="password" name="password" id="password"
           value="<?php echo htmlspecialchars($password); ?>"><br>
    <?php if (isset($errors["password"])) echo "<div style='color:red'>" . $errors["password"] . "</div>"; ?>

    <br>
    <button type="submit" style="background-color: blue; color: white; font-weight: bold; width: 70px; height: 25px; border-radius: 5px;">
        Kirim
    </button>
</form>
