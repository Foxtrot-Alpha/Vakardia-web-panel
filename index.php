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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
<nav class="navbar" role="navigation">
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
            <a class="navbar-item" href="index.php">Accueil</a>
            <a class="navbar-item" href="/console/index.php">Console</a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="/stats/index.php">Statistiques</a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/stats/server.php">Serveur</a>
                    <a class="navbar-item" href="/stats/players.php">Joueurs</a>
                    <a class="navbar-item" href="/stats/site.php">Site web</a>
                </div>
            </div>
            <a class="navbar-item" href="/players/staff.php">Staff</a>
            <a class="navbar-item" href="/players/index.php">Joueurs</a>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-info">Se déconnecter</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

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
    });
</script>
</body>
</html>