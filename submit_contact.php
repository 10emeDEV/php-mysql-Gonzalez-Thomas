<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Message reçu</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <?php include_once('header.php'); ?>

        <?php
        if (
            empty($_POST['email']) ||
            empty($_POST['message'])
        ) {
            echo '<h1>Site de recettes</h1>';
            echo '<p>Il faut un email et un message pour soumettre le formulaire.</p>';
        } else {
        ?>
            <h1>Message bien reçu !</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rappel de vos informations</h5>
                    <p class="card-text"><b>Email</b> : <?php echo htmlspecialchars($_POST['email']); ?> </p>
                    <p class="card-text"><b>Message</b> : <?php echo htmlspecialchars($_POST['message']); ?> </p>
                </div>
            </div>
        <?php
        }
        ?>

    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>