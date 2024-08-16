<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Vérifiez si l'utilisateur a le rôle approprié
if ($_SESSION['role'] !== 'manager') {
    header('Location: unauthorized.php'); // Page pour les accès non autorisés
    exit();
}

// Le reste du code pour le dashboard manager va ici
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manager</title>
    <!-- Incluez vos styles et scripts ici -->
</head>
<body>
    <h1>Bienvenue sur le Dashboard Manager</h1>
    <!-- Le contenu spécifique au dashboard manager -->
</body>
</html>
