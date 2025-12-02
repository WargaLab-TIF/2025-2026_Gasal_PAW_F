<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>24-108_MOHAMMAD ELGHIFARY</title>
</head>
<body>
    <?php
        require 'validate.inc';
        $username ='';
        $email ='';
        $password = '';
        $address = '';
        $state ='';
        $gender = '';
        $hobby = [];
        $errors = [];
        $data=['username','Email_address','Password','Street_Address','state','country','gender','hobby'];
        if(isset($_POST['submit'])){
            $username = $_POST['username'] ?? '';
            $email = $_POST['Email_address'] ?? '';
            $password = $_POST['Password'] ?? '';
            $address = $_POST['Street_Address'] ?? '';
            $state = $_POST['state'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $hobby = $_POST['hobby'] ?? [];
            $terisiPenuh = true;
            $sukses = true;
            foreach($data as $a){
                $result = validateRequired($_POST, $a, $a);
                if(!$result['kondisi']){
                    $errors[$a] = $result['eror'];
                    $terisiPenuh = false;
                    $sukses = false;
                }
            }
            if($terisiPenuh == false){
                require 'form.inc';
            } else {
                $validName = validateName($_POST, 'username');
                if(!$validName['kondisi']){
                    $errors['username'] = $validName['eror'];
                    $sukses = false;
                }
                $validEmail = validateEmail($_POST, 'Email_address');
                if(!$validEmail['kondisi']){
                    $errors['Email_address'] = $validEmail['eror'];
                    $sukses = false;
                }
                if($sukses){
                    echo '<h1>Form submitted successfully with no errors</h1>';
                } else {
                    require 'form.inc';
                }
            }
        } else {
            require 'form.inc';
        }
    ?>
</body>
</html>
