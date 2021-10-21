<?php
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
    header('Location: /index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à Vakardia</title>
    <link rel="stylesheet" href="https://unpkg.com/bulmaswatch/darkly/bulmaswatch.min.css">
    <script src="https://kit.fontawesome.com/d7b93d1ae6.js" crossorigin="anonymous"></script>
    <style>
        .box{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <?php if(isset($_GET['error'])&& !empty($_GET['error'])){
        if($_GET['error'] == "emptyArgs"){
            echo "<div class=\"notification is-danger\">\n\t\t<button class=\"delete\"></button>\n\t\tMerci de remplir les champs requis!\n\t</div>";
        }else if($_GET['error'] == "badPwd"){
            echo "<div class=\"notification is-danger\">\n\t\t<button class=\"delete\"></button>\n\t\tAdresse mail/Mot de passe incorrect!\n\t</div>";
        }
    }
    ?>
    
    <div class="columns is-mobile is-centered">
        <form class="box" action="connect.php" method="post">
            <h1 class="title has-text-centered">Se connecter</h1>
            <div class="field">
                <label class="label">Adresse Mail</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-danger" id="mailInput" name="mail" placeholder="Ton adresse mail" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-at"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
            <div class="field">
                <label class="label">Mot de passe</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-danger" id="pwdInput" type="password" name="password" placeholder="Ton mot de passe" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
            <div class="field is-grouped-centered is-grouped">
                <div class="control">
                    <label class="checkbox">
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                </div>
            </div>
            <div class="field is-grouped is-grouped-centered">
                <div class="control">
                    <input type="submit" class="button is-success" value="Se connecter"></input>
                </div>
                <div class="control">
                    <button type="button" class="button is-primary" onclick="gotoRegister();">Créer un compte</button>
                </div>
                <div class="control">
                    <button type="button" class="button is-outlined is-danger" onclick="gotoHome();">Annuler</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        const mailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const mail = document.querySelector('#mailInput');
        const mailValidityIcon = mail.parentNode.querySelector(".fa-times");

        const pwdRegex = new RegExp("^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#\$%\^&\*\"\'\(\)§\{\}°µ£´`,?;\.:\/=+~])(?=.{8,})");
        const pwd = document.querySelector('#pwdInput');
        const pwdValidityIcon = pwd.parentNode.querySelector('.fa-times');

        mail.addEventListener('keyup', checkMail);
        pwd.addEventListener('keyup', checkPassword);

        function checkMail(e) {
            switchValidityUI(mail, mailValidityIcon, mailRegex.test(mail.value));
        }

        function checkPassword(e) {
            switchValidityUI(pwd, pwdValidityIcon, pwdRegex.test(pwd.value));
        }

        function switchValidityUI(inputElement, iconElement, isValid){
            if(isValid){
                iconElement.classList.remove('fa-times');
                iconElement.classList.add('fa-check');
                inputElement.classList.remove("is-danger");
                inputElement.classList.add("is-success");
            }else{
                iconElement.classList.add('fa-times');
                iconElement.classList.remove('fa-check');
                inputElement.classList.add("is-danger");
                inputElement.classList.remove("is-success");
            }
        }

        function gotoHome(){
            window.location.replace("../index.php");
        }

        function gotoRegister(){
            window.location.replace("/register.php");
        }

        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;

                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
</body>
</html>