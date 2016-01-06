<?php

session_start();
require_once 'config/connexion.inc.php';
require_once 'config/bdd.inc.php';

$select_nombre = "select count(*)as nbarticle from articles where publie=1";
$request = mysql_query($select_nombre);
$result_request = mysql_fetch_array($request);
$nbarticle = $result_request['nbarticle'];

$nbre_d_article_par_page = 2;
$page_actuelle = (isset($_GET['page']) ? $_GET['page'] : 1);


$nombre_page = ceil($nbarticle / $nbre_d_article_par_page);
echo $nombre_page;
$debut = (($page_actuelle - 1) * $nbre_d_article_par_page);
$select_articles = "SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') as date_fr FROM articles WHERE publie = 1 LIMIT $debut,$nbre_d_article_par_page ;";
?>
