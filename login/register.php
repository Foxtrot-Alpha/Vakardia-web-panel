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
    <title>Inscription à Vakardia</title>
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
    <div class="columns is-mobile is-centered">
        <form class="box">
            <div class="field">
                <label class="label">Pseudo</label>
                <div class="control has-icons-left">
                    <input class="input" type="text" placeholder="Le pseudo qui sera utilisé sur ce site.">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                    <p class="help is-info">Si laissé vide, le nom de ton adresse mail sera utilisé</p>
                </div>
            </div>
            <div class="field">
                <label class="label">Adresse Mail</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-danger" id="mailInput" placeholder="Ton adresse mail" pattern='[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}'>
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
                    <input class="input is-danger" id="pwdInput" type="input" placeholder="Le mot de passe de ton choix">
                    <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-times"></i>
                    </span>
                    <p class="help is-warning">Ton mot de passe doit contenir au moins 8 caractères composés de lettres, numéros, et symboles</p>
                </div>
            </div>
            <div class="field">
                <label class="label">Confirmation du mot de passe</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-danger" id="confirmPwd" type="password" placeholder="Réécrit ton mot de passe">
                    <span class="icon is-small is-left">
                        <i class="fas fa-key"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-link">Valider</button>
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

        const confirmPwd = document.querySelector('#confirmPwd');
        const confirmValidityIcon = confirmPwd.parentNode.querySelector('.fa-times');

        mail.addEventListener('keyup', checkMail);
        pwd.addEventListener('keyup', checkPassword);
        confirmPwd.addEventListener('keyup', validPassword)

        function checkMail(e) {
            switchValidityUI(mail, mailValidityIcon, mailRegex.test(mail.value));
        }
        
        function checkPassword(e) {
            validPassword();
            switchValidityUI(pwd, pwdValidityIcon, pwdRegex.test(pwd.value));
        }

        function validPassword(e){
            switchValidityUI(confirmPwd, confirmValidityIcon, pwd.value == confirmPwd.value);
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
    </script>
</body>
</html>