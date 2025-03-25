<?php
//on insère le fichier qui contient les fonctions
require_once ("../include/class.pdogsb.inc.php");

//appel de la fonction qui permet de se connecter à la base de données
$lePdo = PdoGsb::getPdoGsb();

// Fonction de test principale
function testArchiverUtilisateur() {
    try {
        // Jeu de tests :
        $jeuDeTest = [
            [
                'description' => "Test avec un utilisateur existant et des historiques",
                'idUtilisateur' => 1,
                'expectedResult' => true // Archivage et suppression doivent réussir
            ],
            [
                'description' => "Test avec un utilisateur inexistant",
                'idUtilisateur' => 999,
                'expectedResult' => false // Doit échouer car l'utilisateur n'existe pas
            ],
            [
                'description' => "Test avec un utilisateur sans historique ni logs",
                'idUtilisateur' => 2,
                'expectedResult' => true // Archivage doit réussir même sans historique
            ]
        ];

        foreach ($jeuDeTest as $test) {
            echo "\nExécution : " . $test['description'] . "\n";

            try {
                PdoGsb::archiverUtilisateur($test['idUtilisateur']);
                echo "Archivage réussi pour l'utilisateur ID : " . $test['idUtilisateur'] . "\n";

                if (!$test['expectedResult']) {
                    echo "Erreur : Test échoué, une exception était attendue.\n";
                }
            } catch (Exception $e) {
                // Log complet en cas d'exception
                echo "Exception capturée : " . $e->getMessage() . "\n";
                echo "Trace complète : \n" . $e->getTraceAsString() . "\n";

                if ($test['expectedResult']) {
                    echo "Erreur : Test échoué. Une exception inattendue a été levée.\n";
                } else {
                    echo "Exception capturée comme attendu.\n";
                }
            }
        }

    } catch (Exception $e) {
        echo "Erreur globale lors des tests : " . $e->getMessage() . "\n";
    }
}

// Appeler la fonction de test
testArchiverUtilisateur();
