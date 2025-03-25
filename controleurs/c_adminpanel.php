<?php

if (!isset($_SESSION['id'])) {
    echo "Utilisateur non connecté.";
    exit();
}

$pdoGsb = PdoGsb::getPdoGsb();

// Vérifie si l'utilisateur a la permission d'accès à l'admin panel (permission_id == 3)
if ($_SESSION['permission_id'] != 3) {
    echo "Accès refusé.";
    exit();
}

// Récupère l'état de maintenance
$etatMaintenance = $pdoGsb->getMaintenanceMode();

// Vérifie si le formulaire a été soumis pour changer l'état de maintenance
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'activer') {
            $pdoGsb->activateMaintenance();
            $etatMaintenance = 1; // Met à jour la variable pour refléter le changement
        } elseif ($_POST['action'] === 'desactiver') {
            $pdoGsb->deactivateMaintenance();
            $etatMaintenance = 0; // Met à jour la variable pour refléter le changement
        }
    }
}

// Inclut la vue de l'admin panel
include("vues/v_adminpanel.php");
?>
