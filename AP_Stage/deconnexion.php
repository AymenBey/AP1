<?php
// Démarre la session pour accéder aux variables de session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Détruire toutes les variables de session
    session_unset();
    
    // Détruire la session
    session_destroy();
    
    // Optionnel : vous pouvez afficher un message si nécessaire
    echo "<p>Vous avez été déconnecté avec succès.</p>";
}

// Rediriger vers la page d'accueil (par exemple index.php)
header("Location: index.php");  // Remplacez "index.php" par le fichier de la page d'accueil de votre choix
exit();
?>
