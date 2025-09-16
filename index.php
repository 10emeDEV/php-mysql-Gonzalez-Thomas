<?php
// ---------------------------
// index.php (complet)
// ---------------------------

// Démarrer la session AVANT tout HTML (compatible PHP 5/7)
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(0, '/');
    session_start();
}

// Dépendances
include_once(__DIR__ . '/variables.php');
include_once(__DIR__ . '/functions.php');

// État de connexion courant
$loggedUser   = isset($_SESSION['LOGGED_USER']) ? $_SESSION['LOGGED_USER'] : null;
$errorMessage = null;

// Traitement du formulaire de connexion
if (isset($_POST['email']) && isset($_POST['password'])) {
    foreach ($users as $user) {
        if (
            isset($user['email'], $user['password']) &&
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            // Connexion OK → on persiste en session
            $_SESSION['LOGGED_USER'] = ['email' => $user['email']];
            $loggedUser = $_SESSION['LOGGED_USER'];

            // PRG : évite le renvoi du formulaire au rafraîchissement
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }

    // Aucun utilisateur correspondant
    $errorMessage = sprintf(
        'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
        htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8')
    );
}

// Limite d’affichage pour les recettes (utilisé plus bas)
$limit = 20;
?>
<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php include_once('header.php'); ?>

        <?php if(!$loggedUser): ?>
            <!-- FORMULAIRE DE CONNEXION -->
            <h1 class="my-4">Connexion</h1>

            <?php if (!empty($errorMessage)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errorMessage; ?>
                </div>
            <?php endif; ?>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="post" class="mb-5">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        aria-describedby="email-help"
                        placeholder="you@exemple.com"
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '' ?>"
                        required
                    >
                    <div id="email-help" class="form-text">
                        L'email utilisé lors de la création de compte.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        <?php else: ?>
            <!-- MESSAGE DE BIENVENUE -->
            <div class="alert alert-success my-4" role="alert">
                Bonjour <?= htmlspecialchars($loggedUser['email'], ENT_QUOTES, 'UTF-8'); ?> et bienvenue sur le site !
                <a class="ms-2" href="logout.php">Déconnexion</a>
            </div>

            <!-- LISTE DES RECETTES -->
            <h1 class="mb-4">Nos recettes</h1>

            <?php foreach(get_recipes($recipes, $limit) as $recipe) : ?>
                <article class="mb-4">
                    <h3><?php echo htmlspecialchars($recipe['title']); ?></h3>
                    <div><?php echo htmlspecialchars($recipe['recipe']); ?></div>
                    <i><?php echo htmlspecialchars(display_author($recipe['author'], $users)); ?></i>
                </article>
            <?php endforeach ?>
        <?php endif; ?>

    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>