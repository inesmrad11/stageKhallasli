<?php
// Génération du hash du mot de passe : pour admin admin , employee nom de la ville
// Mot de passe en clair que vous souhaitez hasher
$plainPassword = 'manager';

// Génération du hash du mot de passe
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// Affichage du mot de passe hashé
echo "Mot de passe en clair : " . $plainPassword . "<br>";
echo "Mot de passe hashé : " . $hashedPassword;
?>

// Génération du hash du mot de passe : pour admin admin , employee nom de la ville
