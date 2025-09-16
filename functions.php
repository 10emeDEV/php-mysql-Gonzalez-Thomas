<?php
// functions.php

function current_user() {
    return isset($_SESSION['LOGGED_USER']) ? $_SESSION['LOGGED_USER'] : null;
}

function require_login() {
    if (!current_user()) {
        header('Location: index.php');
        exit;
    }
}

function isValidRecipe(array $recipe)
{
    return isset($recipe['is_enabled']) ? $recipe['is_enabled'] : false;
}

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