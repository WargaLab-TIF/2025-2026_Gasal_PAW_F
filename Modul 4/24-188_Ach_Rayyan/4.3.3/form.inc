<?php
// form.inc.php
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  Username: <br>
  <input type="text" name="username"
         value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
  <br><br>

  Email: <br>
  <input type="email" name="email"
         value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
  <br><br>

  Password : <br>
  <input type="password" name="password">
  <br><br>

  Tanggal Lahir: <br>
  <input type="text" name="birth_day" placeholder="DD" style="width:50px;"
         value="<?php echo isset($_POST['birth_day']) ? htmlspecialchars($_POST['birth_day']) : ''; ?>"> /
  <input type="text" name="birth_month" placeholder="MM" style="width:50px;"
         value="<?php echo isset($_POST['birth_month']) ? htmlspecialchars($_POST['birth_month']) : ''; ?>"> /
  <input type="text" name="birth_year" placeholder="YYYY" style="width:70px;"
         value="<?php echo isset($_POST['birth_year']) ? htmlspecialchars($_POST['birth_year']) : ''; ?>">
  <br><br>

  <input type="submit" value="Submit"
         style="background-color: rgb(74, 48, 221); color: white; padding: 10px 20px; border: none; cursor: pointer;">
</form>
