<?php

if (isset($_SESSION['login']) && isset($_SESSION['permission_id'])) {
    // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
    header('Location: index.php?uc=accueil');
    exit();
}

if (!isset($_GET['action'])) {
    $_GET['action'] = 'demandeConnexion';
}
$action = $_GET['action'];

switch ($action) {

    case 'demandeConnexion': {
        include("vues/v_connexion.php");
        break;
    }

    case 'valideConnexion': {
        $login = htmlspecialchars(trim($_POST['login']));
        $mdp = htmlspecialchars(trim($_POST['mdp']));
    
        // Chiffrer l'email pour vérifier dans la base
        $encryptedLogin = secureData($login, 'encrypt');
    
        $connexionOk = $pdo->checkUser($encryptedLogin, $mdp);
        if (!$connexionOk) {
            ajouterErreur("Login ou mot de passe incorrect");
            include("vues/v_erreurs.php");
            include("vues/v_connexion.php");
        } else {
            // Générer et stocker le code de vérification
            $verificationCode = generateCode();
            $_SESSION['code_verification'] = $verificationCode; // Stockage du code
            $_SESSION['login'] = $encryptedLogin; // Stockage de l'email chiffré
            $_SESSION['code_timestamp'] = time(); // Horodatage du code
    
            // Simuler l'envoi d'un email en affichant le code
            echo '
            <div style="font-family: Arial, sans-serif; margin: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9;">
                <h2 style="color: #333;">Email de vérification</h2>
                <p>Bonjour,</p>
                <p>Un email fictif a été envoyé à <strong>' . htmlspecialchars($login) . '</strong> avec le code de vérification :</p>
                <h3 style="color: #4CAF50;">' . htmlspecialchars($verificationCode) . '</h3>
                <p>Veuillez entrer ce code dans le champ ci-dessous pour vous connecter.</p>
                <p>Cordialement,<br>Votre équipe.</p>
            </div>';
    
            include("vues/v_verification_code.php");
        }
        break;
    }

    case 'valideCode': {
        $codeSaisi = htmlspecialchars(trim($_POST['code_verification']));
        $codeTimestamp = $_SESSION['code_timestamp'];
    
        // Vérifier si le code est toujours valide (limite de 1 minute)
        if (time() - $codeTimestamp > 60) {
            echo "Le délai de vérification a expiré. Veuillez demander un nouveau code.";
            session_unset(); // Effacer les variables de session
            include("vues/v_connexion.php");
        } elseif ($codeSaisi === $_SESSION['code_verification']) {
            // Code correct, connecter l'utilisateur
            $infosMedecin = $pdo->donneLeMedecinByMail($_SESSION['login']);
            $_SESSION['permission_id'] = $infosMedecin['permission_id'];
            $id = $infosMedecin['id'];
            $nom = $infosMedecin['nom'];
            $prenom = $infosMedecin['prenom'];
            
            connecter($id, $nom, $prenom); // Mettre à jour la session
            $pdo->updateDateDebut($id);
    
            // Redirection vers la page d'accueil
            header('Location: index.php?uc=accueil');
            exit();
        } else {
            echo "Code de vérification incorrect.";
            include("vues/v_verification_code.php");
        }
        break;
    }

    case 'deconnexion': {
        if (isset($_SESSION['login'])) {
            $idMedecin = $pdo->donneLeMedecinByMail($_SESSION['login'])['id'];
            $pdo->updateDateFin($idMedecin);
            session_unset();
            session_destroy();
            header('Location: index.php?action=demandeConnexion');
            exit();
        }
        break;
    }

    default: {
        include("vues/v_connexion.php");
        break;
    }
}

?>
