<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/db.php');
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
    $id = $_SESSION['id'];
    //update sessions var
    $results = mysqli_query($db, "SELECT use_username, use_avatar FROM users WHERE use_id='$id'");
    if($results && $results->num_rows !== 0){
        $row = mysqli_fetch_assoc($results);
        $_SESSION['username'] = $row['use_username'];
        $_SESSION['avatar'] = $row['use_avatar'];
        echo 'Mise à jour effectuée! <button onclick="window.location.replace(\'index.php\')">Retourner à l\'accueil</button>';
    }else{
        echo 'Aucune entrée correspondante trouvée. <button onclick="window.location.replace(\'index.php\')">Retourner à l\'accueil</button>';
    }
}else{
    if(isset($_POST['mail']) && isset($_POST['password']) && !empty($_POST['mail'] && !empty($_POST['password']))){
        $mail = $_POST['mail'];
        $password = $hashPwd($_POST['password'], $mail);
        $results = mysqli_query($db, "SELECT use_username, use_avatar, use_id FROM users WHERE use_email='$mail' AND use_password='$password'");
        if($results && $results->num_rows !== 0){
            $row = mysqli_fetch_assoc($results);
            $_SESSION['username'] = $row['use_username'];
            $_SESSION['avatar'] = $row['use_avatar'];
            $_SESSION['id'] = $row['use_id'];
            mysqli_free_result($results);
            header('Location: success.php');
            exit();
        }else{
            header('Location: index.php?error=badPwd');
            exit();
        }
    }else{
        header('Location: index.php?error=emptyArgs');
        exit();
    }
}