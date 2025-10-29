<?php
/*
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="surname">Surname:</label><br>
    <input type="text" name="surname" id="surname" value="<?php echo htmlspecialchars($surname); ?>">
    <br><br>
    <button type="submit" value="Submit" 
            style="background-color: blue; color: white; font-weight: bold; width: 70px; height: 25px; border-radius: 5px;">
        Kirim
    </button>
</form>
*/
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="surname">Surname:</label><br>
    <input type="text" id="surname" name="surname" value="<?php echo isset($surname) ? htmlspecialchars($surname) : ''; ?>">
    <br><br>
    <button type="submit" value="submit" style="background-color: blue; color: white; font-weight: bold; width: 70px; height: 25px; border-radius: 5px;">
        Kirim
    </button>
</form>