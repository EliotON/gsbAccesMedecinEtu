<!-- c_gestionproduits -->

<?php
if (!estConnecte() || $_SESSION['permission_id'] == '2') {

// Vérifiez si l'utilisateur est connecté
    $pdoGsb = PdoGsb::getPdoGsb();
    
// Récupérer l'IP de l'utilisateur
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Récupérer l'utilisateur connecté (si stocké dans la session)
$compte = isset($_SESSION['id']) ? $_SESSION['id'] : 'Invité';

// Appeler la méthode avec les paramètres pour recup produits liste.
$produits = $pdoGsb->getProduits();

    // Vérifiez si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifiez le type d'action à effectuer (ajout, mise à jour ou suppression)
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            try {
                switch ($action) {
                    case 'ajouter':
                        // Récupérer les données du produit à ajouter
                        $nom = $_POST['nom'];
                        $objectif = $_POST['objectif'];
                        $information = $_POST['information'];
                        $effetIndesirable = $_POST['effetIndesirable'];
    
                        // Insérer le produit pour obtenir son ID
                        $id = $pdoGsb->insertProduit($nom, $objectif, $information, $effetIndesirable, $compte, $ipAddress);
                        if ($id) {
    
                            // Si un fichier est uploadé, le traiter
                            if (!empty($_FILES['image']['name'])) {
                                // Définir le répertoire de stockage et le nom du fichier basé sur l'ID du produit
                                $uploadDir = 'images/produits/';
                                $uploadFile = $uploadDir . $id . '.png';
    
                                // Vérifier si le dossier existe, sinon le créer
                                if (!is_dir($uploadDir)) {
                                    mkdir($uploadDir, 0755, true);
                                }
    
                                // Vérifier si le fichier a été correctement téléchargé
                                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                                    // Vérification du type de fichier avec finfo pour plus de fiabilité
                                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                    $fileType = finfo_file($finfo, $_FILES['image']['tmp_name']);
                                    finfo_close($finfo);
    
                                    $allowedTypes = ['image/png'];
    
                                    // Vérifier si le type du fichier correspond bien au type autorisé
                                    if (in_array($fileType, $allowedTypes)) {
                                        // Déplacer le fichier téléchargé vers le dossier cible
                                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                                            echo "<script>showToast('Produit ajouté avec succès avec image.', 'success');</script>";

                                        } else {
                                            echo "<script>showToast('Produit ajouté, mais échec de l'upload de l'image.', 'error');</script>";
                                        }
                                    } else {
                                        echo "<script>showToast('Type de fichier non autorisé. Veuillez ajouter une image au format PNG.', 'error');</script>";
                                    }
                                } else {
                                    echo "<script>showToast('Erreur lors de l'upload du fichier. Code d'erreur : ', 'error');</script>";
                                }
                            } else {
                                echo "<script>showToast('Produit ajouté sans image.', 'error');</script>";
                            }
                        } else {
                            echo "<script>showToast('Échec de l'ajout du produit.', 'error');</script>";
                        }
    
                        break;

                        case 'modifier':
                            $id = $_POST['id'];
                            $nom = $_POST['nom2'];
                            $objectif = $_POST['objectif2'];
                            $information = $_POST['information2'];
                            $effetIndesirable = $_POST['effetIndesirable2'];
                        
                            if ($pdoGsb->updateProduit($id, $nom, $objectif, $information, $effetIndesirable, $compte, $ipAddress)) {
                                // Traiter l'upload de l'image si un nouveau fichier est fourni
                                if (!empty($_FILES['image']['name'])) {
                                    $uploadDir = 'images/produits/';
                                    $uploadFile = $uploadDir . $id . '.png';
                        
                                    // Vérifier et créer le répertoire si nécessaire
                                    if (!is_dir($uploadDir)) {
                                        mkdir($uploadDir, 0755, true);
                                    }
                        
                                    // Vérifier les permissions du répertoire
                                    if (is_writable($uploadDir)) {
                                        // Vérifier que le fichier a été correctement téléchargé
                                        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                                            // Vérifier le type de fichier avec finfo
                                            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                            $fileType = finfo_file($finfo, $_FILES['image']['tmp_name']);
                                            finfo_close($finfo);
                        
                                            $allowedTypes = ['image/png'];
                        
                                            if (in_array($fileType, $allowedTypes)) {
                                                // Déplacer le fichier téléchargé vers le dossier cible
                                                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                                                    echo "Produit mis à jour avec nouvelle image.";
                                                } else {
                                                    echo "Produit mis à jour, mais échec de l'upload de l'image.";
                                                }
                                            } else {
                                                echo "Type de fichier non autorisé. Veuillez ajouter une image au format PNG.";
                                            }
                                        } else {
                                            echo "Erreur lors de l'upload du fichier. Code d'erreur : " . $_FILES['image']['error'];
                                        }
                                    } else {
                                        echo "Erreur : le dossier $uploadDir n'est pas accessible en écriture.";
                                    }
                                } else {
                                    echo "Produit mis à jour sans changement d'image.";
                                }
                            } else {
                                echo "Échec de la mise à jour du produit.";
                            }
                            break;
                        
                        
                        

                    case 'supprimer':
                        // Récupérer l'ID du produit à supprimer
                        $id = $_POST['id'];

                        // Appeler la méthode pour supprimer le produit
                        if ($pdoGsb->deleteProduit($id, $compte, $ipAddress)) {
                            echo "Produit supprimé avec succès.";
                        } else {
                            echo "Échec de la suppression du produit.";
                        }
                        break;

                    default:
                        echo "Action non reconnue.";
                        break;
                }
            } catch (Exception $e) {
                echo "Erreur lors de l'exécution de l'action : " . $e->getMessage();
            }
        }
    } 

    // Inclure la vue de gestion des produits
    include("vues/v_gestionproduits.php"); // Affiche la vue de gestion des produits
} else {
        // Rediriger si l'utilisateur n'est pas connecté ou n'a pas la permission 3 (admin)
        header('Location: index.php?uc=connexion');
        exit();
}
?>
