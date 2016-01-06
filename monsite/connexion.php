<?php
session_start();
require_once 'config/bdd.inc.php';//chargement de fichier de connexion a la base de données
require_once 'config/connexion.inc.php';

 
include_once 'include/header.inc.php';
//print_r($_POST);     afficher ce que l utilisitaeur a saisi 
if (isset($_POST['connexion'])) {   //si le bouton connexion est posté,je traite les données
    $email = addcslashes($_POST['email'], "'_%");
    $mdp = addcslashes($_POST['mdp'], "'_%");
    $verif = "SELECT * FROM utilisateur WHERE email='$email' AND mdp='$mdp'"; //verifie si l'email et le mdp est bon
    $result = mysql_query($verif);
    $result_verif = mysql_fetch_array($result);
    if ($result_verif) {      //si le resultat est ok 
        $sid = md5($email . time());   //inserer le sid dans la case de l utilistaeur dans le tableau
        echo $sid;

        $update = "UPDATE utilisateur SET sid='$sid' WHERE id='$result_verif[id]'"; //éxecution de la requete
        mysql_query($update);

        setcookie('sid', "$sid", time() + (30 * 60));   // temps en seconde
        $_SESSION ['msg'] = "connexion reussie";
        header("location: index.php");   //rediriger vers l accueil
    } else {
        $_SESSION ['msg'] = "erreur de connexion";   //creation de message d erreur
        header("Location: connexion.php");   //redirection vers la page connexion.php
    }
}
mysql_query("set names 'utf-8'");
?>
<h1>Connexion </h1>       <!-- debut html -->
<h5>Saisissez les identifiants choisis lors de votre inscription </h5>

<form action="connexion.php" method="post" enctype="multipart/form-data" id="form_article" name="form_article">
    <div class="clearfix">
        <label for="email"> EMAIL : </label>
        <div class="input">
            <input type="email"name="email" id="email" value=""/>
        </div>
    </div>
    <div class="clearfix">
        <label for="mdp"> Mot de passe : </label>
        <div class="textearea">
            <textarea name="mdp" id="mdp"></textarea>
        </div>
    </div>



    <div class="form-actions">
        <input type="submit" name="connexion" value="connexion" class="btn btn-large btn-primary"/>
    </div>
</form>                     <!--  fin html -->
<?php
include_once 'include/menu.inc.php';
include_once 'include/footer.inc.php';
?>   
