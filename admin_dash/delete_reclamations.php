<?php
// Connexion à la base de données
$host = 'localhost'; // Nom d'hôte
$db = 'khallasli_crm'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur
$pass = ''; // Mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Vérifier si l'ID est passé en paramètre
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        // Préparer et exécuter la requête de suppression
        $stmt = $pdo->prepare("DELETE FROM reclamations WHERE id = ?");
        $stmt->execute([$id]);
        
        // Rediriger avec un message de succès
        header('Location: CRUD_reclamations.php?message=Réclamation supprimée avec succès');
        exit();
    } else {
        // Rediriger avec un message d'erreur si l'ID n'est pas fourni
        header('Location: CRUD_reclamations.php?error=ID de réclamation manquant');
        exit();
    }
} catch (PDOException $e) {
    // En cas d'erreur, rediriger avec un message d'erreur
    header('Location: CRUD_reclamations.php?error=Erreur de connexion à la base de données');
    exit();
}
?>