<?php
if (isset($_SESSION['id'])) {
    $idUtilisateur = $_SESSION['id'];

    // Vérifiez si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Vérifiez l'action demandée
            $action = $_GET['action'] ?? null;

            switch ($action) {
                case 'telechargerDonnees':
                    if (isset($_POST['exporter']) && $_POST['exporter'] == '1') {
                        // Exportation des données utilisateur
                        $fichierJson = PdoGsb::getPdoGsb()->exportMedecinDataToJsonById($idUtilisateur);
                        $hashFichier = hash_file('sha256', $fichierJson);
                        $_SESSION['hash_fichier'] = $hashFichier;

                        // Envoi du fichier pour téléchargement
                        header('Content-Type: application/json');
                        header('Content-Disposition: attachment; filename="donnees_utilisateur.json"');
                        readfile($fichierJson);
                        exit(); // Terminer après téléchargement
                    }
                    break;

                case 'supprimerDonnees':
                    if (isset($_POST['supprimer']) && $_POST['supprimer'] == '1') {
                        // Suppression des données utilisateur
                        PdoGsb::getPdoGsb()->supprimerMedecinDataById($idUtilisateur);
                        $message = "Vos données ont été supprimées avec succès.";
                        session_destroy();

                    }
                    break;

                case 'archiverDonnees':
                    if (isset($_POST['archiver']) && $_POST['archiver'] == '1') {
                        // Archivage des données utilisateur
                        PdoGsb::getPdoGsb()->archiverUtilisateur($idUtilisateur);
                        $message = "Vos données ont été archivées avec succès.";
                        session_destroy();
                    }
                    break;

                default:
                    $message = "Action non reconnue.";
            }
        } catch (Exception $e) {
            $message = "Une erreur est survenue : " . $e->getMessage();
        }
    }

    // Afficher le message de retour (si applicable)
    include("vues/v_droits.php"); // Réaffiche le formulaire
} else {
    echo "Utilisateur non connecté.";
}
?>
