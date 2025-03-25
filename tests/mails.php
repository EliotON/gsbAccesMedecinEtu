<?php
// Afficher les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuration de l'email
$to = "test@example.com";  // Adresse email de test
$subject = "Test MailDev depuis PHP";
$message = "Ceci est un email de test envoyé à partir de PHP vers MailDev.";
$headers = "From: webmaster@example.com\r\n"; // L'expéditeur

// Envoi de l'email
if (mail($to, $subject, $message, $headers)) {
    echo "Email envoyé avec succès à $to";
} else {
    echo "L'envoi de l'email a échoué.";
}
?>
