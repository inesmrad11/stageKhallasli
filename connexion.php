<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khallasli_crm";

// Créer la connexion
$connect = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($connect->connect_error) {
    die("Échec de la connexion : " . $connect->connect_error);
}
?>

