<?php
session_start();

require_once 'config/bdd.inc.php'; //chargement de fichier de connexion a la base de données
require_once 'config/connexion.inc.php';

if ($test_connect == FALSE) {      //tester la valeur $test_connect grace a une condition 
    header("Location: connexion.php"); //si vrai redirection pages articles.php
} else {

    if (isset($_POST['envoyer'])) {   //si le bouton envoyer est posté,je traite les données
        $titre = addcslashes($_POST['titre'], "'_%"); //securisation des variables
        $texte = addcslashes($_POST['texte'], "'_%");
        $publie = (!empty($_POST['publie']) ? $_POST['publie'] : 0);
        $date = date("Y-m-d");      //reprise de la date systeme
        //echo $titre . '&'. $texte . '&' . $publie . '&' . $date;
        $req_insertion = "INSERT INTO articles (titre,texte,date,publie) VALUES ('$titre','$texte','$date',$publie)";


        $erreur_image = $_FILES['image']['error'];

        if ($erreur_image != 0) {          // si l image contient une erreur on arrette le traiement
            $_SESSION ['msg_error'] = "une erreur est survenu ,vous serez redriger vers la page article";
            header("location:article.php");   //apres l erreur on rederige vers la page article.php


            echo 'erreur pendant le chargement  ';
        } else {
            mysql_query($req_insertion);
            $id_article = mysql_insert_id();
            move_uploaded_file($_FILES['image']['tmp_name'], dirname(__FILE__) . "/img/$id_article.jpg");
            echo 'insertion de l \'article Reussie ';

            $_session ['msg'] = "chargement reussi";
            header("location:index.php");   //apres le chargement de l image on redirige vers index.php
        }
    } else {

        /* ------HTML ----- */


        include_once 'include/header.inc.php';
        if (isset($_SESSION['msg_error'])) {       //verifier si msg_error existe 
            ?> <div  class="alert alert-error" id="notif">    

                <?php echo $_SESSION['msg_error']; ?></div><?php
                //afficher message d erreur
                unset($_SESSION['msg_error']);           //detruire la variable 
            }
            ?> 
        <form action="article.php" method="post" enctype="multipart/form-data" id="form_article" name="form_article">
            <div class="clearfix">
                <label for="titre"> Titre : </label>
                <div class="input">
                    <input type="text"name="titre" id="titre" value=""/>
                </div>
            </div>
            <div class="clearfix">
                <label for="texte"> Texte : </label>
                <div class="textearea">
                    <textarea name="texte" id="texte"></textarea>
                </div>
            </div>
            <div class="clearfix">
                <label for="image"> Image : </label>
                <div class="input">
                    <input type="file" name="image" id="image"/>
                </div>
            </div>
            <div class="clearfix">
                <label for="Publie"> Publié : </label>
                <div class="input">
                    <input type="checkbox"name="publie" id="publie" value="1"/>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="envoyer" value="envoyer" class="btn btn-large btn-primary"/>
            </div>
        </form>
        <?php
        include_once 'include/menu.inc.php';
        include_once 'include/footer.inc.php';
    }
}
?>   