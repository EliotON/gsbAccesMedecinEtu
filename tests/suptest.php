<?php
// On inclut le fichier contenant les fonctions
require_once("../include/class.pdogsb.inc.php");

// Connexion à la base de données via PdoGsb
$lePdo = PdoGsb::getPdoGsb();

// Fonction de test pour supprimerMedecinDataById
function testSupprimerMedecinDataById() {
    // try {
        // // Jeu de tests
        // $jeuDeTest = [
        //     [
        //         'description' => "Test avec un médecin existant",
        //         'idUtilisateur' => 99,
        //         'expectedResult' => true
        //     ],
        //     [
        //         'description' => "Test avec un médecin inexistant",
        //         'idUtilisateur' => 999,
        //         'expectedResult' => false
        //     ],
        //     [
        //         'description' => "Test avec un médecin ayant des relations dans plusieurs tables",
        //         'idUtilisateur' => 2,
        //         'expectedResult' => true
        //     ]
        // ];

        // foreach ($jeuDeTest as $test) {
        //     echo "\nExécution : " . $test['description'] . "\n";

        //     try {
            $lePdo = PdoGsb::getPdoGsb();

            $lePdo->supprimerMedecinDataById(99);

    //             if ($result === $test['expectedResult']) {
    //                 echo "Test réussi pour l'utilisateur ID : " . $test['idUtilisateur'] . "\n";
    //             } else {
    //                 echo "Erreur : Test échoué. Résultat inattendu pour l'utilisateur ID : " . $test['idUtilisateur'] . "\n";
    //             }
    //         } catch (Exception $e) {
    //             if (!$test['expectedResult']) {
    //                 echo "Exception capturée comme attendu : " . $e->getMessage() . "\n";
    //             } else {
    //                 echo "Erreur : Une exception inattendue a été levée. Message : " . $e->getMessage() . "\n";
    //             }
    //         }
    //     }
    // } catch (Exception $e) {
    //     echo "Erreur globale lors des tests : " . $e->getMessage() . "\n";
    // }
}

// Appeler la fonction de test
testSupprimerMedecinDataById();