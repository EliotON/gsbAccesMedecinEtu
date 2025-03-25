


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("include/fct.inc.php");
require_once("include/class.pdogsb.inc.php");
require_once("include/fonctions.php");


session_start();
date_default_timezone_set('Europe/Paris');

$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();

// Vérifie si le site est en mode maintenance
$modeMaintenance = $pdo->getMaintenanceMode(); // Méthode pour obtenir l'état de maintenance

// Vérifie l'UC à charger
if (!isset($_GET['uc'])) {
    $_GET['uc'] = 'connexion';
} else {
    if ($_GET['uc'] === "connexion" && !estConnecte()) {
        $_GET['uc'] = 'connexion';
    }
}
// Si le site est en maintenance et que l'utilisateur n'est pas admin, redirige
if ($modeMaintenance && (!isset($_SESSION['permission_id']) || $_SESSION['permission_id'] != 3)) {
    include("vues/v_maintenance.php"); // Affiche la vue de maintenance
    exit; // Terminer le script après l'affichage de la maintenance
}

$uc = $_GET['uc'];

// Inclusion du contrôleur approprié
switch ($uc) {
    case 'connexion':
        include("controleurs/c_connexion.php");
        break;
    case 'creation':
        include("controleurs/c_creation.php");
        break;
    case 'droits':
        include("controleurs/c_droits.php");
        break;
    case 'gestionproduits':
        include("controleurs/c_gestionproduits.php");
        break;
    case 'accueil':
        include("controleurs/c_accueil.php");
        break;
    case 'adminpanel':
        include("controleurs/c_adminpanel.php");
        break;
    case 'gestionlogs':
            include("controleurs/c_gestionlogs.php");
            break;
    case 'stats':
            include("controleurs/c_stats.php");
            break;
    case 'deconnexion':
            include("controleurs/c_deconnexion.php");
            break;
    default:
        include("controleurs/c_connexion.php"); // Redirection par défaut
        break;
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center bg-gray-100 min-h-screen flex flex-col">
    
    <!-- Contenu principal -->
    <div class="container mx-auto my-4 flex-grow">
        <!-- Le contenu du contrôleur est déjà inclus ci-dessus -->
    </div>

    <?php include('vues/v_footer.php'); ?>
</body>
</html>
