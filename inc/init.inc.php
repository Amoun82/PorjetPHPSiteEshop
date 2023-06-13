<?php


// La connexion à la BDD
$host = 'mysql:host=localhost;dbname=tic_site';
$login = 'root'; // login
$password = ''; // mdp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
$pdo = new PDO($host, $login, $password, $options);

echo "<pre>";
var_dump($pdo);
echo "</pre>";
// declaration des constantes 

// lancement de la session utilisateur 
session_start() ;

$_SESSION['URL'] = "http://localhost/PHPprojetDoranco/";
$messageErreur = "";
