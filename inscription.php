<!-- Projet GP 007 - FLOW -->

<!-- Page d'inscription -->

<?php

    // Initialisation de la session, du header et du fichier require pamam.inc.php pour se connecter à la BDD - > Jamais à modifier
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: text/html; charset=utf-8") ;
    require (__DIR__ . "/param_php-bdd/param.inc.php");
    
    // Initialisation des variables
        $erreur = null;

        $bordureErreurMail = null;
        $erreurMail = null;
        $erreurMail2 = null;
        $erreurMail3 = null;

        $bordureErreurMdp = null;
        $erreurMdp = null;
        $erreurMdp2 = null;

        $bordureErreurPseudo = null;
        $erreurPseudo = null;
        $erreurPseudo2 = null;

        $bordureErreurChamp = null;
        $erreurG = false;

    // Verifie les donées reçues du formulaire
    if(isset($_POST['form_inscription'])) {

        // Insertion des donées reçues du formulaire dans des variables
        $pseudo = htmlspecialchars($_POST['form_pseudo']);
        $mail = htmlspecialchars($_POST['form_mail']);
        $mail2 = htmlspecialchars($_POST['form_mail2']);
        $mdp = sha1($_POST['form_mdp']);
        $mdp2 = sha1($_POST['form_mdp2']);


        // On vérifie que les champs ont bien été remplis, son différent de vide
        if(!empty($_POST['form_pseudo']) AND !empty($_POST['form_mail']) AND !empty($_POST['form_mail2']) AND !empty($_POST['form_mdp']) AND !empty($_POST['form_mdp2'])) { 
        
        $pseudolength = mb_strlen($pseudo);

        }else {
            $erreurG = true;
        }

        // Le pseudo doit faire moins de 15 caractères
        if($pseudolength <= 15  AND $erreurG == false) {
        // Pas d'action si ok
        } else {
        $erreurG = true;
        $erreurPseudo = "Votre pseudo ne peux pas faire plus de 15 caractères";
        $pseudo = null;
        $bordureErreurPseudo = "bordureRouge";
        }

        // Connexion au serveur de base de données - > Jamais à modifier
        $bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
        $bdd->query("SET NAMES utf8");
        $bdd->query("SET CHARACTER SET 'utf8'");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // On vérifie qu'il n'y a pas déjà le même pseudo dans la BDD
        $reqpseudo = $bdd->prepare("SELECT * FROM Utilisateur WHERE pseudo = ?");
        $reqpseudo->execute(array($pseudo));
        $verificationPseudo = $reqpseudo->fetch(PDO::FETCH_ASSOC) ;


        // Si ce pseudo n'existe pas encore
        if($verificationPseudo == false ){
            //pas d'action si ok
        } else {
        $erreurG = true;
        $erreurPseudo2 = "Le pseudo est déjà utilisé";
        $bordureErreurPseudo = "bordureRouge";
        }

        // Les deux mails doivent-être indentiques
        if($mail == $mail2 ) {
        //pas d'action si ok
        } else {
        $erreurG = true;
        $erreurMail = "Vos adresses mails ne correspondent pas";
        $mail2 = null;
        $bordureErreurMail = "bordureRouge";
        }

        // On vérifie que le mail a une structure conforme
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {

        } else {
        $erreurG = true;
        $erreurMail2 = "Votre adresse mail n'est pas valide";
        $bordureErreurMail = "bordureRouge";
        }


        // On vérifie qu'il n'y a pas déjà le même mail dans la BDD
        $reqmail = $bdd->prepare("SELECT * FROM Utilisateur WHERE mail = ?");
        $reqmail->execute(array($mail));
        $verificationMail = $reqmail->fetch(PDO::FETCH_ASSOC) ;

        // Si ce mail n'existe pas encore
        if($verificationMail == false) {
        } else {
        $erreurG = true;
        $erreurMail3 = "Adresse mail déjà utilisée";
        $bordureErreurMail = "bordureRouge";
        }

        // Le mot de passe doit faire plus de 5 caractères
        if (mb_strlen($_POST["form_mdp"]) >= 5 ){
        // Insertion de la longeur du mot de passe dans la variable
        } else {
            $erreurG = true;
            $erreurMdp = "Votre mot de passe doit faire plus de 5 caractères";
            $pseudo = null;
            $bordureErreurPseudo = "bordureRouge";;
        }
        // On vérifie que les mails sont identiques
        if($mdp == $mdp2) {
                // Insertion de la longeur du mot de passe dans la variable
        } else {
            $erreurG = true;
            $erreurMdp2 = "Vos mots de passes ne correspondent pas";
            $bordureErreurMdp = "bordureRouge";
        }


        if($erreurG == false) {

        // Insertion dans la BDD des données reçues après toutes les vérifications 
        $insertmbr = $bdd->prepare("INSERT INTO Utilisateur(Pseudo, Mail, MotDePasse) VALUES(?, ?, ?)");
        $insertmbr->execute(array($pseudo, $mail, $mdp));

if(!empty($mail)) {

            // Etape 2 : envoi de la requête SQL au serveur
            $requser = $bdd->prepare("SELECT Mail FROM Utilisateur WHERE Mail = ? ");
            $requser->execute(array($mail));
            $ligneMail = $requser->fetch(PDO::FETCH_ASSOC);
            
            if($ligneMail != false) {
            //rien
            }else{
                $erreurMail = "Le mail n'existe pas";
                $bordureErreurCo = "bordureRouge";
            }
        }

        if(!empty($mdp)) {
            // Etape 2 : envoi de la requête SQL au serveur
            $requser = $bdd->prepare("SELECT Mail, Pseudo, Id_User, MotDePasse FROM Utilisateur WHERE Mail = ? AND MotDePasse = ? ");
            $requser->execute(array($mail, $mdp));
            $ligne = $requser->fetch(PDO::FETCH_ASSOC);

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
        }
    }
}
}
    // ferme la connexion au serveur de base de données
    $pdo = null ;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="icon" href="images/logo_phone_favicon.svg" />
    <title>FLOW - Inscription</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="page-inscription">
    <div class="inscription">
        <h1>Inscription</h1>
        <p class="desc-form">Tu t'apprêtes à créer ton compte Flow, hâte de t'accueillir parmi nous !</p>

        <form method="post" action="">
            <div>
                <input type="text" name="form_pseudo" id="form_pseudo" placeholder="Pseudo" aria-label="Votre pseudo" required class="bordureNone <?=$bordureErreurPseudo?>" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
            </div>
            <div>
                <input type="email" name="form_mail" id="form_mail" placeholder="Adresse mail" aria-label="Votre adresse mail" required class="bordureNone <?=$bordureErreurMail?>" value="<?php if(isset($mail)) { echo $mail; } ?>" />
            </div>
            <div>
                <input type="email" name="form_mail2" id="form_mail2" placeholder="Confirmation de l'adresse mail" aria-label="Confirmation de l'adresse mail" required class="bordureNone <?=$bordureErreurMail?>" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
            </div>
            <div>
                <input type="password" name="form_mdp" id="form_mdp" placeholder="Mot de passe (5 caractères min)" aria-label="Votre mot de passe" required minlength="5" class="bordureNone <?=$bordureErreurMdp?>" />
            </div>
            <div>
                <input type="password" name="form_mdp2" id="form_mdp2" placeholder="Confirmation du mot de passe" aria-label="Confirmation du mot de passe" required minlength="5" class="bordureNone <?=$bordureErreurMdp?>" />
            </div>
            <div>
            </div>
            <div class="form-erreur">
                <p>
                    <?php echo($erreurPseudo); ?>
                </p>
                <p>
                    <?php echo($erreurPseudo2); ?>
                </p>
                <p>
                    <?php echo($erreurMail); ?>
                </p>
                <p>
                    <?php echo($erreurMail2); ?>
                </p>
                <p>
                    <?php echo($erreurMail3); ?>
                </p>
                <p>
                    <?php echo($erreurMdp); ?>
                </p>
                <p>
                    <?php echo($erreurMdp2); ?>
                </p>
            </div>
            <div>
                <button class="send" type="submit" aria-label="Envoyer le formulaire" name="form_inscription">Créer mon compte</button>
            </div>
            <div>
                <p class="rejoindre-com"><a href="index.php">Retourner sur le site</a></p>
            </div>
            <!-- A revoir quand on aura le temps, utiliser des array et une boucle -->
        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>
