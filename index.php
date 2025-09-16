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

    <?php
        include_once('variables.php');
        include_once('functions.php');
        // Définit $limit si non défini
        if (!isset($limit)) {
            $limit = 3;
        }
        include_once('login.php'); // Inclusion du formulaire de connexion
    ?>

    <h1>Site de Recettes !</h1>

    <!-- Si l'utilisateur existe, on affiche les recettes -->
    <?php if(isset($loggedUser)): ?>
        <?php foreach(get_recipes($recipes, $limit) as $recipe) : ?>
            <article>
                <h3><?php echo htmlspecialchars($recipe['title']); ?> </h3>
                <div><?php echo htmlspecialchars($recipe['recipe']); ?> </div>
                <i><?php echo htmlspecialchars(display_author($recipe['author'], $users)); ?> </i>
            </article>
        <?php endforeach ?>
    <?php endif; ?>

    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>