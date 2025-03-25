<?php

/** 
 * //class.pdogsb.inc.php
 * Classe d'accès aux données. 
 * Utilise les services de la classe PDO pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion,
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 * 
 * @package default
 * @author Cheri Bibi
 * @version 1.0
 * @link http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb {   		
    // Définition des paramètres de connexion
    private static $serveur = 'mysql:host=localhost:3306';
    private static $bdd = 'dbname=gsbextranet';   		
    private static $user = 'gsbextranet';    		
    private static $mdp = '130109';	

    // Propriétés statiques pour la connexion PDO
    private static $monPdo;
    private static $monPdoGsb = null;
		
    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe.
     */				
    private function __construct() {
        PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
        PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
    }

    // Destructeur pour fermer la connexion
    public function __destruct() {
        PdoGsb::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe.
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
     * 
     * @return l'unique objet de la classe PdoGsb
     */
    public static function getPdoGsb() {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }
        return PdoGsb::$monPdoGsb;  
    }

 function checkUser($mail, $pwd): bool {
    $user = false;
    $pdo = PdoGsb::$monPdo;
    
    // Prépare la requête pour vérifier l'email et le token
    $stmt = $pdo->prepare("SELECT motDePasse FROM medecin WHERE mail = :mail AND token IS NULL");
    $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        $unUser = $stmt->fetch(PDO::FETCH_ASSOC);  // Récupère le résultat sous forme de tableau associatif

        if ($unUser !== false) {

            $user = true;

        } else {
            echo "Aucun utilisateur trouvé.<br>";
        }
    } else {
        throw new Exception("Erreur dans la requête SQL");
    }
    
    return $user;
}

public function exportMedecinDataToJsonById($id) {
    $pdo = PdoGsb::$monPdo;
    
    // Préparer la requête pour récupérer les données sauf l'ID et le mot de passe
    $stmt = $pdo->prepare("SELECT nom, prenom, mail, dateCreation, dateConsentement FROM medecin WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            // Convertir les données en JSON
            $jsonData = json_encode($userData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            
            // Créer le dossier 'portabilité' s'il n'existe pas
            $directory = 'portabilite';
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Chemin complet du fichier à créer
            $filename = $directory . '/medecin_data_' . $id . '.json';
            file_put_contents($filename, $jsonData);
            
            return $filename; // Retourne le chemin complet du fichier créé
            throw new Exception("Aucun utilisateur trouvé avec cet ID.");
        }
    } else {
        throw new Exception("Erreur lors de l'exécution de la requête SQL.");
    }
}




function donneLeMedecinByMail($login) {
    
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail,role_id,permission_id FROM medecin WHERE mail= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
return $unUser;   
}

public function tailleChampsMail(){
     $pdoStatement = PdoGsb::$monPdo->prepare("SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS
WHERE table_name = 'medecin' AND COLUMN_NAME = 'mail'");
    $execution = $pdoStatement->execute();
$leResultat = $pdoStatement->fetch();
      
      return $leResultat[0];
    
       
       
}

function verifierLongueurChamps($chaine, $longueurMax) {
    if (strlen($chaine) > $longueurMax) {
        echo 'La chaîne ne peut contenir plus de ' . $longueurMax . ' caractères.<br/>';
        return false;
    }
    return true;
}


public function creeMedecin($email, $mdp, $nom, $prenom)
{
    // Vérifier si l'email existe déjà dans la base de données
    $pdo = PdoGsb::$monPdo;
    $pdoStatement = $pdo->prepare("SELECT count(*) as nbMail FROM medecin WHERE mail = :leMail");
    $pdoStatement->bindValue(':leMail', $email);
    $pdoStatement->execute();
    $resultatRequete = $pdoStatement->fetch();

    if ($resultatRequete['nbMail'] > 0) {
        // Si l'email existe déjà, on retourne false pour indiquer que la création échoue
        return false;
    }

    // Hacher le mot de passe
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

    // Préparer la requête pour insérer les données
    $pdoStatement = $pdo->prepare("INSERT INTO medecin (id, mail, motDePasse, nom, prenom, dateCreation, dateConsentement) "
            . "VALUES (null, :leMail, :leMdp, :leNom, :lePrenom, now(), now())");

    // Lier les valeurs aux paramètres
    $pdoStatement->bindValue(':leMail', $email, PDO::PARAM_STR);
    $pdoStatement->bindValue(':leMdp', $hashedPassword, PDO::PARAM_STR);
    $pdoStatement->bindValue(':leNom', $nom, PDO::PARAM_STR);
    $pdoStatement->bindValue(':lePrenom', $prenom, PDO::PARAM_STR);

    // Exécuter la requête
    $execution = $pdoStatement->execute();

    // Retourner si l'exécution a réussi ou non
    return $execution;
}




// // Fonction pour tester si l'email est déjà présent dans la base de données
// function testMail($email){
//     $pdo = PdoGsb::$monPdo;
//     $pdoStatement = $pdo->prepare("SELECT count(*) as nbMail FROM medecin WHERE mail = :leMail");
//     $pdoStatement->bindValue(':leMail', $email);
//     $execution = $pdoStatement->execute();
//     $resultatRequete = $pdoStatement->fetch();
    
//     return $resultatRequete['nbMail'] > 0;
// }


public function updateDateDebut($idMedecin) {
    // Prépare l'insertion de la date de début de connexion
    $pdoStatement = PdoGsb::$monPdo->prepare("
        INSERT INTO historiqueconnexion (idMedecin, dateDebutLog) 
        VALUES (:idMedecin, NOW())
        ON DUPLICATE KEY UPDATE dateDebutLog = NOW()
    ");
    $pdoStatement->bindValue(':idMedecin', $idMedecin, PDO::PARAM_INT);
    $execution = $pdoStatement->execute();
    
    return $execution;  // Retourne l'état de l'exécution
}

public function logProduitOperation($produitId, $operationType, $compte, $ipAddress, $description = null) {
    // Valider si l'opération est CREATE, UPDATE ou DELETE
    $validOperations = ['CREATE', 'UPDATE', 'DELETE'];
    if (!in_array($operationType, $validOperations)) {
        throw new Exception("Opération invalide: $operationType");
    }

    // Enregistrement du log dans la base de données
    $pdo = PdoGsb::$monPdo;
    $stmt = $pdo->prepare("
        INSERT INTO produit_operations_log (produit_id, operation_type, compte, ip_address, description)
        VALUES (:produit_id, :operation_type, :compte, :ip_address, :description)
    ");
    $stmt->bindValue(':produit_id', $produitId, PDO::PARAM_INT);
    $stmt->bindValue(':operation_type', $operationType, PDO::PARAM_STR);
    $stmt->bindValue(':compte', $compte, PDO::PARAM_STR);
    $stmt->bindValue(':ip_address', $ipAddress, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    
    return $stmt->execute();
}



public function updateDateFin($idMedecin) {
    // Prépare l'insertion ou la mise à jour de la date de fin de connexion
    $pdoStatement = PdoGsb::$monPdo->prepare("
        UPDATE historiqueconnexion 
        SET dateFinLog = NOW() 
        WHERE idMedecin = :idMedecin 
        AND dateFinLog IS NULL
    ");
    $pdoStatement->bindValue(':idMedecin', $idMedecin, PDO::PARAM_INT);
    $execution = $pdoStatement->execute();
    
    return $execution;  // Retourne l'état de l'exécution
}





function connexionInitiale($mail){
     $pdo = PdoGsb::$monPdo;
    $medecin= $this->donneLeMedecinByMail($mail);
    $id = $medecin['id'];
    $this->ajouteConnexionInitiale($id);
    
}

function ajouteConnexionInitiale($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion "
            . "VALUES (:leMedecin, now(), now())");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function donneinfosmedecin($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT id,nom,prenom FROM medecin WHERE id= :lId");
    $bvc1=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
   
    }
    else
        throw new Exception("erreur");
           
    
}

public function getProduits() {
    $pdo = PdoGsb::$monPdo;
    $stmt = $pdo->prepare("SELECT * FROM produits");

    // Exécuter la requête
    if ($stmt->execute()) {
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $produits;
    } else {
        throw new Exception("Erreur lors de l'exécution de la requête SQL.");
    }
}


public function getProduitById($id, $compte, $ipAddress) {
    try {
        $pdo = PdoGsb::$monPdo;
        $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $produit = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->logProduitOperation($id, 'GET_BY_ID', $compte, $ipAddress, "Récupération du produit avec l'ID $id");
            return $produit;
        } else {
            throw new Exception("Erreur lors de l'exécution de la requête SQL.");
        }
    } catch (Exception $e) {
        $this->logProduitOperation($id, 'GET_BY_ID_ERROR', $compte, $ipAddress, $e->getMessage());
        throw $e;
    }
}

public function insertProduit($nom, $objectif, $information, $effetIndesirable, $compte, $ipAddress) {
    try {
        $pdo = PdoGsb::$monPdo;
        $sql = "INSERT INTO produits (nom, objectif, information, effetIndesirable) 
                VALUES (:nom, :objectif, :information, :effetIndesirable)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':objectif', $objectif);
        $stmt->bindValue(':information', $information);
        $stmt->bindValue(':effetIndesirable', $effetIndesirable);

        if ($stmt->execute()) {
            $produitId = $pdo->lastInsertId();
            // Remplace 'INSERT' par 'CREATE' pour respecter l'ENUM
            $this->logProduitOperation($produitId, 'CREATE', $compte, $ipAddress, "Insertion d'un produit ($nom)");
            return $produitId;
        } else {
            throw new Exception("Erreur lors de l'insertion du produit.");
        }
    } catch (Exception $e) {
        // Utiliser 'ERROR' au lieu de 'INSERT_ERROR' pour respecter l'ENUM
        $this->logProduitOperation(null, 'ERROR', $compte, $ipAddress, $e->getMessage());
        throw $e;
    }
}


public function updateProduit($id, $nom, $objectif, $information, $effetIndesirable, $compte, $ipAddress) {
    try {
        $pdo = PdoGsb::$monPdo;
        $stmt = $pdo->prepare("UPDATE produits 
                               SET nom = :nom, objectif = :objectif, information = :information, effetIndesirable = :effetIndesirable 
                               WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':objectif', $objectif);
        $stmt->bindValue(':information', $information);
        $stmt->bindValue(':effetIndesirable', $effetIndesirable);

        if ($stmt->execute()) {
            $this->logProduitOperation($id, 'UPDATE', $compte, $ipAddress, "Mise à jour du produit avec l'ID $id");
            return true;
        } else {
            throw new Exception("Erreur lors de la mise à jour du produit.");
        }
    } catch (Exception $e) {
        // Utiliser 'ERROR' au lieu de 'UPDATE_ERROR' pour respecter l'ENUM
        $this->logProduitOperation($id, 'ERROR', $compte, $ipAddress, $e->getMessage());
        throw $e;
    }
}

public function deleteProduit($id, $compte, $ipAddress) {
    try {
        $pdo = PdoGsb::$monPdo;
        $stmt = $pdo->prepare("DELETE FROM produits WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->logProduitOperation($id, 'DELETE', $compte, $ipAddress, "Suppression du produit avec l'ID $id");
            return true;
        } else {
            throw new Exception("Erreur lors de la suppression du produit.");
        }
    } catch (Exception $e) {
        // Utiliser 'ERROR' au lieu de 'DELETE_ERROR' pour respecter l'ENUM
        $this->logProduitOperation($id, 'ERROR', $compte, $ipAddress, $e->getMessage());
        throw $e;
    }
}

public function getLogsWithPagination($offset, $limit) {
    try {
        $sql = "SELECT * FROM produit_operations_log ORDER BY operation_date DESC LIMIT :offset, :limit";
        $stmt = PdoGsb::$monPdo->prepare($sql); // Utilisation de monPdo pour la connexion
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des logs : " . $e->getMessage();
        return [];
    }
}

/**
 * Fonction pour obtenir le nombre total de logs
 */
public function getTotalLogs() {
    try {
        $sql = "SELECT COUNT(*) FROM produit_operations_log";
        $stmt = PdoGsb::$monPdo->query($sql); // Utilisation de monPdo pour la connexion
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Erreur lors du comptage des logs : " . $e->getMessage();
        return 0;
    }
}

public function getTotalUsers() {
    $pdo = PdoGsb::$monPdo;
    $stmt = $pdo->query("SELECT COUNT(*) FROM medecin");
    return $stmt->fetchColumn();
}

public function getNombreProduits()
{
    $pdo = PdoGsb::$monPdo;
    $sql = "SELECT COUNT(*) AS total FROM produits";
    $stmt = $pdo->query($sql); // Exécution directe si aucune donnée externe n'est passée
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

    return (int)$resultat['total']; // Retourne le total sous forme d'entier
}




 // Méthode pour obtenir l'état de maintenance
 public function getMaintenanceMode() {
    $query = self::$monPdo->query("SELECT maintenance_mode FROM maintenance WHERE id = 1");
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['maintenance_mode'];
}

// Méthode pour activer le mode maintenance
public function activateMaintenance() {
    $query = self::$monPdo->prepare("UPDATE maintenance SET maintenance_mode = 1 WHERE id = 1");
    $query->execute();
}

// Méthode pour désactiver le mode maintenance
public function deactivateMaintenance() {
    $query = self::$monPdo->prepare("UPDATE maintenance SET maintenance_mode = 0 WHERE id = 1");
    $query->execute();
}


public function archiverUtilisateur($id) {
    // Vérifier que la connexion principale (gsbextranet) est initialisée
    if (self::$monPdo === null) {
        throw new Exception("La connexion PDO à 'gsbextranet' n'a pas été initialisée.");
    }

    // Connexion à la base de données d'archivage (archivedb)
    try {
        $pdoArchive = new PDO('mysql:host=localhost:3306;dbname=archivedb', 'login5030', 'MgkJsscFLxgkjET');
        $pdoArchive->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode d'erreur pour voir les exceptions PDO
    } catch (Exception $e) {
        echo "Erreur de connexion à 'archivedb' : " . $e->getMessage();
        return;
    }

    // Commencer la transaction dans la base d'archivage
    $pdoArchive->beginTransaction();

    try {
        // Récupérer les données de l'utilisateur dans la base 'gsbextranet'
        $stmt = self::$monPdo->prepare("SELECT * FROM medecin WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur === false) {
            throw new Exception("Utilisateur non trouvé dans la base 'gsbextranet'.");
        }

        // Insérer les données de l'utilisateur dans la base 'archivedb'
        $stmtInsert = $pdoArchive->prepare("
            INSERT INTO utilisateur (id, dateCreation)
            VALUES (:id, :dateCreation)
        ");
        $stmtInsert->execute([
            ':id' => $utilisateur['id'],
            ':dateCreation' => $utilisateur['dateCreation']
        ]);

        // Archiver l'historique de connexion de l'utilisateur dans 'archivedb'
        $stmtHistory = self::$monPdo->prepare("SELECT * FROM historiqueconnexion WHERE idMedecin = :id");
        $stmtHistory->execute([':id' => $id]);
        $historique = $stmtHistory->fetchAll(PDO::FETCH_ASSOC);

        foreach ($historique as $entry) {
            $stmtInsertHistory = $pdoArchive->prepare("
                INSERT INTO historiqueconnexion (idMedecin, dateDebutLog, dateFinLog)
                VALUES (:idMedecin, :dateDebutLog, :dateFinLog)
            ");
            $stmtInsertHistory->execute([
                ':idMedecin' => $entry['idMedecin'],
                ':dateDebutLog' => $entry['dateDebutLog'],
                ':dateFinLog' => $entry['dateFinLog']
            ]);
        }

        // Archiver les logs des opérations de produit dans 'archivedb'
        $stmtProductLog = self::$monPdo->prepare("SELECT * FROM produit_operations_log WHERE compte = :compte");
        $stmtProductLog->execute([':compte' => $id]);
        $productLogs = $stmtProductLog->fetchAll(PDO::FETCH_ASSOC);

        foreach ($productLogs as $log) {
            $stmtInsertProductLog = $pdoArchive->prepare("
                INSERT INTO produit_operations_log (id, produit_id, operation_type, compte, ip_address, operation_date, description)
                VALUES (:id, :produit_id, :operation_type, :compte, :ip_address, :operation_date, :description)
            ");
            $stmtInsertProductLog->execute([
                ':id' => $log['id'],
                ':produit_id' => $log['produit_id'],
                ':operation_type' => $log['operation_type'],
                ':compte' => $log['compte'],
                ':ip_address' => $log['ip_address'],
                ':operation_date' => $log['operation_date'],
                ':description' => $log['description']
            ]);
        }

        // Si tout est OK, commit la transaction
        $pdoArchive->commit();
        $this->supprimerMedecinDataById($id);
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $pdoArchive->rollBack();
        echo "Erreur lors de l'archivage : " . $e->getMessage();
        throw $e;
    }
}



public function supprimerMedecinDataById($idUtilisateur)
{
        // Supprimer l'historique des connexions liés au médecin
        $query = self::$monPdo->prepare("DELETE FROM historiqueconnexion WHERE idMedecin = :id");
        $query->execute([':id' => $idUtilisateur]);

        // Supprimer d'autres tables pertinentes si nécessaires
        // Exemple :
        // $query = self::$monPdo->prepare("DELETE FROM consultations WHERE medecin_id = :id");
        // $query->execute([':id' => $idUtilisateur]);

        // Enfin, supprimer les données du médecin lui-même
        $query = self::$monPdo->prepare("DELETE FROM medecin WHERE id = :id");
        $query->execute([':id' => $idUtilisateur]);

        // Valider les changements
        self::$monPdo->commit();
        session_destroy();
    
}



}
?>