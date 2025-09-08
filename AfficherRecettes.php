<?php
// === Données de test ===
$users = [
    [
        'full_name' => 'Mickaël Andrieu',
        'email' => 'mickael.andrieu@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Mathieu Nebra',
        'email' => 'mathieu.nebra@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Laurène Castor',
        'email' => 'laurene.castor@exemple.com',
        'age' => 28,
    ],
];

$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => '',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Salade Romaine',
        'recipe' => '',
        'author' => 'laurene.castor@exemple.com',
        'is_enabled' => true,
    ],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Recettes</title>
    <style>
        body { font-family: Arial, sans-serif; background:#fafafa; margin:0; padding:24px; }
        h1 { font-size:32px; margin:0 0 18px; }
        .recipe {
            background:#fff; border:1px solid #e5e7eb; border-radius:12px;
            padding:16px; margin-bottom:14px; box-shadow:0 1px 3px rgba(0,0,0,.06);
        }
        .recipe h2 { margin:0 0 8px; font-size:24px; }
        .author { margin:6px 0 0; color:#555; font-style:italic; }
        .muted { color:#6b7280; font-size:14px; margin:0; }
    </style>
</head>
<body>
<h1>Les recettes</h1>

<?php
// 1) Boucler sur les recettes valides uniquement (is_enabled == true)
foreach ($recipes as $recipe) {
    if ($recipe['is_enabled'] == true) {

        // 2) Récupérer l'email de l'auteur indiqué sur la recette
        $recipeEmail = $recipe['author'];

        // 3) Chercher le nom correspondant dans la liste des utilisateurs
        $authorName = 'Auteur inconnu';
        foreach ($users as $user) {
            if ($user['email'] == $recipeEmail) {
                $authorName = $user['full_name'];
                break; // on a trouvé le bon utilisateur
            }
        }

        // 4) Afficher la recette + le nom de l'auteur trouvé
        echo '<article class="recipe">';
        echo '<h2>' . htmlspecialchars($recipe['title']) . '</h2>';

        // le champ "recipe" est vide dans les tests, on affiche une petite note
        echo '<p class="muted">Etape 1 : (à compléter)</p>';

        echo '<p class="author">' . htmlspecialchars($authorName) . '</p>';
        echo '</article>';
    }
}
?>
</body>
</html>