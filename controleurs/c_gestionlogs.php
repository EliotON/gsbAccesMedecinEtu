<?php
if (!estConnecte() || $_SESSION['permission_id'] != '3') {
    // Rediriger si l'utilisateur n'est pas connecté ou n'a pas la permission 3 (admin)
    header('Location: index.php?uc=connexion');
    exit();
}

// Connexion à la base de données
$pdoGsb = PdoGsb::getPdoGsb();

// Paramètres de pagination
$logsPerPage = 10; // Nombre de logs par page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle
$offset = ($currentPage - 1) * $logsPerPage;

// Récupérer les logs avec pagination
$logs = $pdoGsb->getLogsWithPagination($offset, $logsPerPage);

// Compter le nombre total de logs pour déterminer le nombre de pages
$totalLogs = $pdoGsb->getTotalLogs();
$totalPages = ceil($totalLogs / $logsPerPage);

// Inclure la vue de gestion des logs
include("vues/v_gestionlogs.php");
?>
