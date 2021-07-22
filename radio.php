<?php
//initialisation session
require("radio/initialisation.php");

//Répertoire de stockage des variables pour tout le dossier
require("radio/initialisationVariables.php");

// récupère l'id de radio transmit par le lien
if (isset($_GET["radio"])){

//Récupère toutes les données d'une radio
require("radio/donneesRadio.php");


// Vérifier que l'on est bien connecté
if (isset($_SESSION['id']) AND !empty($_SESSION['id'])){

    $idUser = $_SESSION['id'];

//Gestion insertion et delete de likes
require("radio/likes.php");

//Sinon message d'erreur
}else{
        $erreur = '<a class="erreur-connexion" href="connexion.php">Vous devez être connecté pour pouvoir utiliser toutes les fonctions de Flow !</a>';

    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>FLOW - <?php echo($nomRadio)?></title>
    <link href="css/catalogueV2.css" rel="stylesheet" />
    <link href="css/parcourir.css" rel="stylesheet" />
    <?php require("head.php"); ?>
</head>

<body class="page-lecture">


    <!-- Require des Header -->
    <?php require("header.php"); ?>
    <?php require("favoris-header.php"); ?>


    <section class="onglet">
        <h1 class="radio-ecouter">Écouter</h1>
        <div class="radio-cargo">
            <div class="radio-container">
                <div class="radio-banner">

                    <?php require("radio/follow.php") ?>


                    <img src="images/imgRadio/<?php echo($nomRadio)?>.webp" alt="">
                </div>
                <div class="radio-info">
                    <h2><?php echo($nomRadio); ?></h2>
                    <p class="p-info"><strong>Genre :</strong>


                        <?php //Affichage des catégories
require("radio/categories.php"); ?>

                    </p>
                    <div class="radio-content">
                        <div class="radio-column">
                            <div class="radio-interaction">
                                <audio id="player">
                                    <!-- Lien dinamyque pour la source audio -->
                                    <source src="<?php echo($url) ?>" type="audio/mp3">
                                </audio>
                                <button><i class="far fa-play-circle" controls></i></button>

                                <!-- Requete pour compter le nombre de likes + Affichage du pouve bleu ou nom -->
                                <?php require("radio/compteurLikes.php"); ?>


                                <!-- Afficher le nombre de likes -->
                                <p class="number-like"> <?php echo($likeRadio['nbLikes']); ?> </p>
                            </div>

                            <!-- Affichage de la description de la radio -->
                            <p class="p-info"><strong>Description :</strong>
                                <span class="color-content-radio">
                                    <?php echo($description);?>
                                </span>
                            </p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="radio-trait">
            </div>


            <!-- Affichage du nombre de commentaires fait sur la page de la radio -->
            <div class="radio-commentaires">
                <h1>Commentaires (<?php require("radio/nbCommentaires.php");?>)</h1>
            </div>

            <!-- Formulaire pour publier un commentaire -->
            <form method="post" action="radio/commentaires.php">
                <div class="w-commentaire">
                    <textarea id="autoresizing" name="form_com" placeholder="Écrire un commentaire (max 300 caractères)" required maxlength="300"></textarea>
                    <button type="submit" name="form_publier" value="">Publier</button>
                </div>
            </form>
            <!-- Affichage de l'erreur, veuillez vous connecter -->
            <div><?php echo($erreur); ?></div>
            <?php


require("radio/affichageCommentaires.php");

 ?>
            <div class="voir-plus">
                <button><i class="fas fa-chevron-down"></i></button>
                <p>Voir plus</p>
            </div>
        </div>
        <h1>Suggestions</h1>
    </section>


    <!-- Scripts -->
    <?php require("radio/scriptRadio.php"); ?>

    <?php require("catalogue/catalogueRadioLimit6.php"); 
    require("chat.php");?>
</body>

</html>
