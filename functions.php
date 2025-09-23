<?php
// functions.php

function isValidRecipe(array $recipe)
{
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }

    return $isEnabled;
}

function displayAuthor(string $authorEmail, array $users)
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
        }
    }
}

function getRecipes(array $recipes)
{
    $validRecipes = [];

    foreach($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $validRecipes[] = $recipe;
        }
    }

    return $validRecipes;
}

function getValidRecipes(PDO $db, int $limit = 5)
{
    $sql = 'SELECT recipe_id, title, recipe, author, is_enabled
            FROM recipes
            WHERE is_enabled = 1
            ORDER BY recipe_id DESC
            LIMIT :limit';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}