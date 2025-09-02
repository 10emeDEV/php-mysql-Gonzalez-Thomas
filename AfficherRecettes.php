<?php
// AfficherRecettes.php

// 1) Recettes en tableaux associatifs
$recipes = array(
    array(
        'title' => 'Cassoulet',
        'author' => 'mickael.andrieu@exemple.com',
        'enabled' => true,
        'steps' => array(
            'Etape 1 : des flageolets !'
        )
    ),
    array(
        'title' => 'Couscous',
        'author' => 'mickael.andrieu@exemple.com',
        'enabled' => false, // ne doit pas s’afficher
        'steps' => array(
            'Etape 1 : préparez la semoule'
        )
    ),
    array(
        'title' => 'Escalope milanaise',
        'author' => 'mathieu.nebra@exemple.com',
        'enabled' => true,
        'steps' => array(
            'Etape 1 : prenez une belle escalope'
        )
    )
);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>recettes disponibles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            padding: 20px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        .recipe {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
        }
        .recipe h2 {
            margin: 0 0 10px 0;
            font-size: 22px;
        }
        .step {
            margin: 0 0 8px 0;
        }
        .author {
            font-style: italic;
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Les recettes</h1>

    <?php
    // 2) On affiche seulement si enabled est vrai
    foreach ($recipes as $recipe) {
        if ($recipe['enabled'] == true) {
            echo '<div class="recipe">';
            echo '<h2>' . $recipe['title'] . '</h2>';

            // Afficher la première étape si elle existe
            if (!empty($recipe['steps'])) {
                echo '<p class="step">' . $recipe['steps'][0] . '</p>';
            }

            echo '<p class="author">' . $recipe['author'] . '</p>';
            echo '</div>';
        }
    }
    ?>
</body>
</html>