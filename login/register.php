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

        mail.addEventListener('keyup', checkMail);
        pwd.addEventListener('keyup', checkPassword);

        function checkMail(e) {
            var valid = mailRegex.test(mail.value);
            if(valid){
                mail.classList.remove("is-danger");
                mail.classList.add("is-success");
            }else{
                mail.classList.add("is-danger");
                mail.classList.remove("is-success");
            }
            switchValidityIcon(mailValidityIcon, valid);
        }
        
        function checkPassword(e) {
            var valid = pwdRegex.test(pwd.value);
            console.log("Value: "+pwd.value+" Valid: "+valid);
            if(valid){
                pwd.classList.remove("is-danger");
                pwd.classList.add("is-success");
            }else{
                pwd.classList.add("is-danger");
                pwd.classList.remove("is-success")
            }
            switchValidityIcon(pwdValidityIcon, valid);
        }

        function switchValidityIcon(element, isValid){
            if(isValid){
                element.classList.remove('fa-times');
                element.classList.add('fa-check');
            }else{
                element.classList.add('fa-times');
                element.classList.remove('fa-check');
            }
        }
    </script>
</body>
</html>