<?php
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: text/html; charset=utf-8") ;
    require (__DIR__ . "/param_php-bdd/param.inc.php");

$idUser = $_SESSION["id"];
            // Connexion au serveur de base de données
            $bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS);
            $bdd->query("SET NAMES utf8");
            $bdd->query("SET CHARACTER SET 'utf8'");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requser = $bdd->prepare("SELECT Role, Id_User FROM Utilisateur WHERE Role = 'ADMINISTRATEUR' AND ID_User = ? ");
            $requser->execute(array($idUser));
            $admin = $requser->fetch(PDO::FETCH_ASSOC);

if($admin == true){
}else{
    $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = ("index.php");
                header("Location: http://$host$uri/$extra");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>FLOW | Admin - Radios Soumises</title>
    <?php require("head.php"); ?>
</head>

<body class="radios-s">
    <!-- A CHANGERRRR -->
    <?php require("header.php"); ?>
    <?php require("favoris-header.php"); ?>
    <section class="sec-soumis">
        <h1>Les radios proposées par les utilisateurs</h1>
        <div class="soumises">
            <?php        
            // Envoi de la requête SQL au serveur
            $requser = $bdd->prepare("SELECT Pseudo, NomRadioProposer, fluxPropose, Id_PropositionRadio AS propRad FROM PropositionRadio INNER JOIN Utilisateur ON PropositionRadio.Id_User = Utilisateur.Id_User ORDER BY Id_PropositionRadio DESC");
            $requser->execute(array());
            $ligne = $requser->fetch(PDO::FETCH_ASSOC);

while($ligne !=false){
?>
            <p><?php echo ("Utilisateur : ".$ligne['Pseudo']." - ".$ligne['NomRadioProposer']." - ".$ligne['fluxPropose']) ?>
                <button class="bouton-favoris" name="supprimer">
                    <form method="post" action="propositionRadio/suppPropRad.php">
                        <input type="hidden" name="valId" value="<?php echo($ligne['propRad']); ?>" />
                        <button type="hidden" name="poubelle">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </button>
            </p>
            <?php

            $ligne = $requser->fetch(PDO::FETCH_ASSOC); ?><?php
}

$pdo = null;
?>
        </div>

        <div>
            <p class="rejoindre-com radio-s-retour"><a href="admin.php">Retour à la page Administrateur</a></p>
        </div>

    </section>
    <?php require("footer.php"); ?>

<script src="js/jquery-3.6.0.js"></script>
<script src="js/index.js"></script>
</body>

</html>
