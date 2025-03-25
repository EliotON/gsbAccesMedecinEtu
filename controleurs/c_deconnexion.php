<?php

if (!isset($_GET['action'])) {
    $_GET['action'] = 'deconnexion';
}
$action = $_GET['action'];

switch ($action) {
    
    case 'deconnexion': {
        if (isset($_SESSION['login'])) {
            // Récupère l'ID du médecin à partir de la session
            $idMedecin = $pdo->donneLeMedecinByMail($_SESSION['login'])['id'];
            
            // Met à jour la date de fin de connexion
            $pdo->updateDateFin($idMedecin);
            
            // Détruit la session pour déconnecter l'utilisateur
            session_unset();
            session_destroy();
            
            // Redirection vers la page de connexion
            header('Location: index.php?action=demandeConnexion');
            exit();
        }
        break;
    }
    
} 
?>
