<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription confirmée!</title>
    <link rel="stylesheet" href="https://unpkg.com/bulmaswatch/darkly/bulmaswatch.min.css">
</head>
<body>
    <div class="box pt-5">
        <article class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                    <img src="<?php echo $_SESSION['avatar']; ?>">
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong><?php echo $_SESSION['username']; ?></strong>
                        <br>
                        Bravo pour ton inscription! Il te suffit d'attendre qu'un administrateur du projet te donne accès au site pour commencer à t'en servir!
                    </p>
                </div>
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <a class="button is-info" href="/index.php">Retourner à l'accueil</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</body>
</html>