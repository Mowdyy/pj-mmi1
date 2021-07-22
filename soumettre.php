<?php
    //initialisation de la session
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: text/html; charset=utf-8") ;
    require (__DIR__ . "/param_php-bdd/param.inc.php");

    //Connexion au serveur de base de données
                        $bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                        $bdd->query("SET NAMES utf8");
                        $bdd->query("SET CHARACTER SET 'utf8'");
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //initialisation des variables
    $validation = null;


    //verification de la validité du formulaire
    if(isset($_POST['form_soumettre'])) {

        //stockage des données dans des variables
        $radio = htmlspecialchars($_POST['form_radio']);
        $flux = htmlspecialchars($_POST['form_flux']);

        //vérification du champ
        if(!empty($_POST['form_radio'])) {

                        $requser = $bdd->prepare("SELECT NomRadioProposer FROM PropositionRadio WHERE NomRadioProposer = ?");
                        $requser->execute(array($radio));
                        $verifRadio = $requser->fetch(PDO::FETCH_ASSOC);

                        $requser = $bdd->prepare("SELECT fluxPropose FROM PropositionRadio WHERE fluxPropose = ? ");
                        $requser->execute(array($flux));
                        $verifFlux = $requser->fetch(PDO::FETCH_ASSOC);


                        if($verifRadio == false || $verifFlux == false){
                        //insertion dans la BDD des propositions
                        $reqradio = $bdd->prepare("INSERT INTO PropositionRadio(NomRadioProposer, fluxPropose, Id_User) VALUES(?, ?, ?)");
                        $reqradio->execute(array($radio, $flux, $_SESSION['id']));
                        
                        //validation auprès de l'utilisateur
                        $validation = 'Votre proposition a bien été prise en compte,<br/> Merci de participer à l\'amélioration de Flow !';
                        //Ferme la connexion au serveur de base de données
                        $pdo = null ;
                    }else{
                        $validation = "oups, cette radio a déjà été proposée !";
                    }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require("head.php"); ?>
    <title>FLOW - Soumettre une radio</title>
</head>

<body class="page-soumettre">
    <?php require("favoris-header.php") ?>
    <?php require("header.php") ?>
    <div class="soumettre">
        <h1>Tu souhaites que Flow héberge une nouvelle radio ?</h1>
        <p class="desc-form">Fais le nous savoir en remplissant ce champ ci-dessous.</p>

        <form method="post">
            <div>
                <input type="text" name="form_radio" id="form-radio" placeholder="Nom de la radio" required class="bordureNone" value="<?php if(isset($radio)) { echo $radio; } ?>"/>
            </div>
            <div>
                <input type="text" name="form_flux" id="form-flux" placeholder="Url / flux de la radio (optionnel)" class="bordureNone" value=""/>
            </div>
            <div>
                <button class="send" type="submit" name="form_soumettre">Envoyer</button>
            </div>
            <div>
                <p class="desc-form"><?php echo($validation)?></p>
            </div>
            <div class="desc-form">
                <a class="retourner" href="index.php">Retourner sur le site</a>
            </div>
        </form>
    </div>
    <?php require("chat.php") ?>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>

</body></html>
