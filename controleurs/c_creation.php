<?php

$action = $_GET['action'];

switch ($action) {

    case 'demandeCreation': {
        include("vues/v_creation.php");
        break;
    }

    case 'valideCreation': {
        // Récupération et sécurisation des entrées utilisateur
        $leLogin = htmlspecialchars(trim($_POST['login'])); // L'email
        $lePassword = htmlspecialchars(trim($_POST['mdp']));
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prénom']));
    
        // Initialisation des variables de validation
        $loginOk = true;
        $passwordOk = true;
        $nomOk = true;
        $prenomOk = true;
        $rempli = true;
    
        // Vérification des champs vides
        if (empty($leLogin)) {
            echo 'Le login n\'a pas été saisi<br/>';
            $rempli = false;
            $loginOk = false;
        }
        if (empty($prenom)) {
            echo 'Le prénom n\'a pas été saisi<br/>';
            $rempli = false;
            $prenomOk = false;
        }
        if (empty($nom)) {
            echo 'Le nom n\'a pas été saisi<br/>';
            $rempli = false;
            $nomOk = false;
        }
        if (empty($lePassword)) {
            echo 'Le mot de passe n\'a pas été saisi<br/>';
            $rempli = false;
            $passwordOk = false;
        }
    
        // Vérification du format du login (email)
        if ($rempli) {
            if (!filter_var($leLogin, FILTER_VALIDATE_EMAIL)) {
                echo 'Le mail n\'a pas un format correct<br/>';
                $loginOk = false;
            }
    
            // Vérification du mot de passe
            $patternPassword = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{12,}#';
            if (!preg_match($patternPassword, $lePassword)) {
                echo 'Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule et un caractère spécial<br/>';
                $passwordOk = false;
            }
        }
    
        // Vérification finale avant la création de compte
        if ($rempli && $loginOk && $passwordOk && $nomOk && $prenomOk) {
            // Hachage du mot de passe
            $hashedPassword = password_hash($lePassword, PASSWORD_BCRYPT);
            // Chiffrement de l'email
            $encryptedLogin = secureData($leLogin, 'encrypt');
    
            echo 'Tout est ok, nous allons pouvoir créer votre compte...<br/>';
            $idMedecin = $pdo->creeMedecin($encryptedLogin, $hashedPassword, $nom, $prenom);
    
            if ($idMedecin) {
                echo "C'est bon, votre compte a bien été créé ;-) ";
                $pdo->connexionInitiale($encryptedLogin);  // Utilisation de l'email chiffré
            } else {
                echo "Ce login existe déjà, veuillez en choisir un autre<br/>";
            }
        } else {
            echo 'Veuillez vérifier les informations fournies.<br/>';
        }
    
        break;
    }

    default: {
        include("vues/v_connexion.php");
        break;
    }
}

?>
