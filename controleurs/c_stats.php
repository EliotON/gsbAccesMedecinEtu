<?php
// Vérifier si l'utilisateur est connecté et a les droits administratifs
if (!estConnecte() || $_SESSION['permission_id'] != '3') {
    header('Location: index.php?uc=connexion');
    exit();
}

try {
    // Charger la connexion PDO
    $pdoGsb = PdoGsb::getPdoGsb();

    // Récupérer les données nécessaires
    $nombreProduits = $pdoGsb->getNombreProduits(); // Comptez directement via SQL (évite de charger tous les produits en mémoire)
    $nombreUsers = $pdoGsb->getTotalUsers();       // Nombre total d'utilisateurs
    $logs = $pdoGsb->getTotalLogs();               // Nombre de logs

    // Récupérer les détails des produits pour affichage si nécessaire
    $produits = $pdoGsb->getProduits();

} catch (Exception $e) {
    // Gérer les erreurs proprement (log et affichage utilisateur)
    error_log("Erreur lors de la récupération des statistiques : " . $e->getMessage());
    header('Location: index.php?uc=erreur');
    exit();
}

// Inclure la vue correspondante
include("vues/v_stats.php");
?>
