<style> 
/* */ 
div { margin-bottom: 10px; } 
label { display: block; font-weight: bold; } 
</style> 
<form action="index_ubah2.php" method="POST"> 
<div> 
<label for="given_name">Nama Depan:</label> 
<input type="text" id="given_name" name="given_name" 
value="<?php if (isset($_POST['given_name'])) echo $_POST['given_name']; ?>"> 
<?php showError($errors, 'given_name'); ?> 
</div> 
<div> 
<label for="surname">Nama Belakang:</label> 
<input type="text" id="surname" name="surname" 
value="<?php if (isset($_POST['surname'])) echo $_POST['surname']; ?>"> 
<?php showError($errors, 'surname'); ?> 
</div> 
<input type="submit" value="Submit"> 
</form> 