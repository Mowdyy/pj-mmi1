<?php
  // connexion.php
//Initialisation de la session.
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: text/html; charset=utf-8") ;
    require (__DIR__ . "/param_php-bdd/param.inc.php");
    
    $erreurMdp = null;
    $erreurMail = null;
    $bordureErreurCo = null;


    //Vérification des données du formulaire et insertion dans les variables
    if(isset($_POST['form_connexion'])) {
        $form_mail = htmlspecialchars($_POST['form_mail']);
        $form_mdp = sha1($_POST['form_mdp']);

        //Vérification : tout les champs sont remplis
        if(!empty($form_mail)) {

            // Etape 1 : connexion au serveur de base de données
            $bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
            $bdd->query("SET NAMES utf8");
            $bdd->query("SET CHARACTER SET 'utf8'");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Etape 2 : envoi de la requête SQL au serveur
            $requser = $bdd->prepare("SELECT Mail FROM Utilisateur WHERE Mail = ? ");
            $requser->execute(array($form_mail));
            $ligneMail = $requser->fetch(PDO::FETCH_ASSOC);
            
            if($ligneMail != false) {
            //rien
            }else{
                $erreurMail = "Le mail n'existe pas";
                $bordureErreurCo = "bordureRouge";
            }
        }

        if(!empty($form_mdp)) {

            // Etape 1 : connexion au serveur de base de données
            $bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
            $bdd->query("SET NAMES utf8");
            $bdd->query("SET CHARACTER SET 'utf8'");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Etape 2 : envoi de la requête SQL au serveur
            $requser = $bdd->prepare("SELECT Id_User, Pseudo, MotDePasse FROM Utilisateur WHERE Mail = ? AND MotDePasse = ? ");
            $requser->execute(array($form_mail, $form_mdp));
            $ligne = $requser->fetch(PDO::FETCH_ASSOC);

            //récupération de la question secrete pour la stocker dans une variable de session.
            if($ligne != false) {
                $_SESSION['id'] = $ligne['Id_User'];
                $_SESSION['pseudo'] = $ligne['Pseudo'];
                $_SESSION['mail'] = $ligne['Mail'];
                $_SESSION['mdp'] = $ligne['MotDePasse'];

                $pdo = null ;

                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'index.php';
                header("Location: http://$host$uri/$extra");
                exit;

        }else{
                $erreurMdp = "Mot de passe incorrect";
                $bordureErreurCo = "bordureRouge";
        //redirection vers la page index.php
    }}}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="icon" href="images/logo_phone_favicon.svg" />
    <title>FLOW - Connexion</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="page-connexion">
    <div class="connexion">
        <h1>Connexion</h1>
        <p class="desc-form">Rebonjour !</p>

        <form method="POST">
            <div>
                <input type="email" name="form_mail" id="form-mail" placeholder="Adresse mail" aria-label="Votre adresse mail" required class="bordureNone <?=$bordureErreurCo?>" value="<?php if(isset($form_mail)) { echo $form_mail; } ?>" />
            </div>
            <div>
                <input type="password" name="form_mdp" id="form-mdp" placeholder="Mot de passe" aria-label="Votre mot de passe" required minlength="5" class="bordureNone <?=$bordureErreurCo?>" />
            </div>
            <div class="form-erreur">
                <p>
                    <?php echo($erreurMail);?>
                </p>
                <p>
                    <?php echo($erreurMdp);?>
                </p>
            </div>
            <div>
                <button class="send" type="submit" name="form_connexion" aria-label="Se connecter" value="connecter au site">Me connecter</button>
            </div>
            <div>
                <p class="rejoindre-com">Pas de compte ? <a href="inscription.php">Rejoindre la communauté</a></p>
            </div>
        </form>
    </div>
</body>

</html>
