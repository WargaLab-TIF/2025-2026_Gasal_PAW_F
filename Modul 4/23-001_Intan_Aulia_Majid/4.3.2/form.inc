<form action="form.php" method="POST">
    <label for="surname">Nama: </label>
    <input name="surname" id="surname" value="<?php if(isset($value)) {echo $value;} ?>">
    <label for="email">Email: </label>
    <input name="email" id="email" value="<?= htmlspecialchars($valueEmail) ?>">
    <button type="submit">Submit</button>
</form>