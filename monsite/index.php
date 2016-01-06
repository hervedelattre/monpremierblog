<?php

session_start();

require_once 'config/bdd.inc.php';
require_once 'config/connexion.inc.php';
include_once 'include/header.inc.php';
//pagination
$select_nombre = "select count(*)as nbarticle from articles where publie=1";
$request = mysql_query($select_nombre);
$result_request = mysql_fetch_array($request);
$nbarticle = $result_request['nbarticle'];

$nbre_d_article_par_page = 2;
$page_actuelle = (isset($_GET['page']) ? $_GET['page'] : 1);


$nombre_page = ceil($nbarticle / $nbre_d_article_par_page);
//echo $nombre_page;
$debut = (($page_actuelle - 1) * $nbre_d_article_par_page);

$select_all_post = "SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') as date_fr FROM articles WHERE publie = 1 LIMIT $debut,$nbre_d_article_par_page ;";
$request = mysql_query($select_all_post);


while ($result_request = mysql_fetch_array($request)) {
    echo '<img src="img/' . $result_request ['id'] . '.jpg" alt="erreur image" width="200px"/>';
    echo '<h2>' . $result_request ['titre'] . '</h2>';
    echo '<p>' . $result_request ['texte'] . '<p>';
    echo '<p>' . $result_request ['date_fr'] . '</p>';
}
//creation lien  de pages
for ($i = 1; $i <= $nombre_page; $i++) {
    echo "<a href='index.php?page=$i'> $i </a>";
}

include_once 'include/menu.inc.php';
include_once 'include/footer.inc.php';
?>   