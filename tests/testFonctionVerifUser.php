<?php

//on insère le fichier qui contient les fonctions
require_once ("../include/class.pdogsb.inc.php");

//appel de la fonction qui permet de se connecter à la base de données

$pdo= PdoGsb::getPdoGsb();


/***** cas TRUE *******************/
$mail="eliot@mail.com";
$pwd="#niy%uBCj#6BSY7kVzvE^wWvVGy%%WA!";

var_dump($pdo->checkUser($mail,$pwd));


/***** cas FALSE *******************/
$mail="eliot@mail.com";
$pwd="passwordd";

var_dump($pdo->checkUser($mail,$pwd));

/***** cas FALSE *******************/
$mail="bidule@gmail.fr";
$pwd="YJhd4gR#9UAR2pGA";

var_dump($pdo->checkUser($mail,$pwd));



