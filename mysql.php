<?php
const MYSQL_HOST     = 'localhost';
const MYSQL_PORT     = 3306;
const MYSQL_NAME     = 'my_recipes';
const MYSQL_USER     = 'root';
const MYSQL_PASSWORD = 'root';

try {
    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', MYSQL_HOST, MYSQL_PORT, MYSQL_NAME);
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $db = new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD, $options);
} catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
