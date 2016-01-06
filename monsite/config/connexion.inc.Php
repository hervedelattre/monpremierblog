<?php

$test_connect = FALSE;   //créer une variable type booleen initialiser a false
if (isset($_COOKIE['sid'])) {   //tester la présence de $_cookie
    $val_sid = $_COOKIE['sid'];   // attribuer la valeur de sid à une variable 
    $test_presence = "SELECT * FROM utilisateur WHERE sid='$val_sid'"; //vérification en bdd de la présence de la valeur .
    $resultat = mysql_query($test_presence);
    $result_bool = mysql_fetch_array($resultat);
    if ($result_bool) {
        $test_connect = TRUE;   //si le resultat est ok 
        //echo $test_connect;    //afficher le resultat 
    }
}               //securiser les pages







?>
