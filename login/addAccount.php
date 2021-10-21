<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/db.php');
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
    header('Location: /index.php');
    exit();
}

if(!isset($_POST['mail']) || empty($_POST['mail']) || !isset($_POST['password']) || empty($_POST['password'])){
    header('Location: register.php?error=emptyArgs');
    exit();
}
$mail = $_POST['mail'];
$pwd = $_POST['password'];

$mailRegex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
$pwdRegex = '^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#\$%\^&\*\"\'\(\)§\{\}°µ£´`,?;\.:\/=+~])(?=.{8,})^';
$error = "bad";

if(!preg_match($mailRegex, $mail)){$error = $error . "Mail";}
if(!preg_match($pwdRegex, $pwd)){$error= $error . "Pwd";}
if(strlen($error)> 3){
    header("Location: register.php?error={$error}");
    exit();
}else{
    $username= substr(empty($_POST['username']) ? explode("@", $mail)[0] : $_POST['username'], 0, 32);
    $finalPwd = $hashPwd($pwd, $mail);
    //Vérifier si l'adresse mail est déjà présente
    $results = mysqli_query($db, "SELECT use_username FROM users WHERE use_email='$mail'");
    if($results && $results->num_rows === 0){
        if(mysqli_query($db, "INSERT INTO users (use_email, use_username, use_password, use_avatar) VALUES ('$mail', '$username', '$finalPwd', '/resources/users/default.png')")){
            $_SESSION['id'] = mysqli_insert_id($db);
            $_SESSION['mail'] = $mail;
            $_SESSION['username'] = $username;
            $_SESSION['avatar'] = '/resources/users/default.png';
            mysqli_free_result($results);
            header('Location: success.php?type=inscription');
            exit();
            
        }

    }else{
        header('Location: register.php?error=usedMail');
        exit();
    }
}
?>