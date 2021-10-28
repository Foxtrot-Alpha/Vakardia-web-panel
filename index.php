<?php
$main_url = "#";
session_start();
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
    header('Status: 401	Unauthorized', false, 401);
    header('Location: login/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur Vakardia</title>
    <link rel="stylesheet" href="https://unpkg.com/bulmaswatch/darkly/bulmaswatch.min.css">
    <link rel="stylesheet" href="global.css">
    <style>
        #outer{
            width: 100%;
            height: 100%;
            margin-top: 40vh;
        }
        #inner{
            width: 100%;
            text-align: center;
        }
        @media only screen and (max-width: 800px) {
            #outer{
                text-align: center;
                position: fixed;
                bottom: 25vh;
                margin-top: 0;
                height: auto;
            }
        }
    </style>
</head>
<body class="has-navbar-fixed-top">
<nav class="navbar is-success is-fixed-top has-shadow" role="navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?php echo $main_url ?>">
            <img src="resources/logo.webp">
        </a>
        <a role="button" class="navbar-burger" data-target="navbarMain">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="navbarMain" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item is-selected" href="index.php">Accueil</a>
            <a class="navbar-item" href="/console/index.html">Console</a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" onclick="toggleDropdown();">Statistiques</a>
                <div class="navbar-dropdown is-hidden-mobile">
                    <a class="navbar-item" href="/stats/server.php">Serveur</a>
                    <a class="navbar-item" href="/stats/players.php">Joueurs</a>
                    <a class="navbar-item" href="/stats/site.php">Site web</a>
                    <a class="navbar-item" href="/stats/index.php">Résumé</a>
                </div>
            </div>
            <a class="navbar-item" href="/players/staff.php">Staff</a>
            <a class="navbar-item" href="/players/index.php">Joueurs</a>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-danger is-outlined">Se déconnecter</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="hero is-primary">
    <div class="hero-body">
        <p class="title">Bienvenue sur le panel de Vakardia <?php echo $_SESSION['username']; ?>!</p>
        <p class="subtitle">Tu y trouveras toutes les statistiques et de quoi gérer le serveur depuis n'importe où.</p>
    </div>
</section>
<div id="outer">
    <p class="title has-text-primary" id="inner">Tu peux utiliser le menu en haut de la page pour te balader sur le site :)</p>
</div>

</div>
<script>
    function toggleDropdown(){
        document.querySelector('.navbar-dropdown').classList.toggle('is-hidden-mobile');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        const $dropdowns = Array.prototype.slice.call(document.querySelectorAll('.navbar-dropdown:not(.is-hoverable)'), 0);
        if ($navbarBurgers.length > 0) {
            $navbarBurgers.forEach( el => {
                el.addEventListener('click', () => {
                const target = el.dataset.target;
                const $target = document.getElementById(target);

                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
                });
            });
        }
        if ($dropdowns.length > 0) {
            $dropdowns.forEach(function ($el) {
                $el.addEventListener('click', function (event) {
                    event.stopPropagation();
                    $el.classList.toggle('is-active');
                });
            });

            document.addEventListener('click', function (event) {
                closeDropdowns();
            });
        }

        function closeDropdowns() {
            $dropdowns.forEach(function ($el) {
                $el.classList.remove('is-active');
            });
        }

        // Close dropdowns if ESC pressed
        document.addEventListener('keydown', function (event) {
            var e = event || window.event;
            if (e.keyCode === 27) {
                closeDropdowns();
            }
        });
    });

</script>
</body>
</html>