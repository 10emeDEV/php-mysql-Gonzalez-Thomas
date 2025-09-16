<?php
// functions.php

function isValidRecipe(array $recipe)
{
    return isset($recipe['is_enabled']) ? $recipe['is_enabled'] : false;
}

// Correction du nom de la fonction pour correspondre à index.php
function display_author($authorEmail, array $users)
{
    foreach ($users as $author) {
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . ' (' . $author['age'] . ' ans)';
        }
    }

    // Auteur non trouvé : on renvoie l'email tel quel
    return $authorEmail;
}

function get_recipes(array $recipes, $limit = null)
{
    $validRecipes = array();

    foreach ($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $validRecipes[] = $recipe;
        }
    }

    if ($limit !== null) {
        return array_slice($validRecipes, 0, (int)$limit);
    }

    return $validRecipes;
}