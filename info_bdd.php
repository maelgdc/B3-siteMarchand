<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$mon_pdo = new PDO("mysql:host=" . $_ENV['host'] . ";dbname=" . $_ENV['db_name'] . ";charset=utf8", $_ENV['login'], $_ENV['pwd']);
?>
