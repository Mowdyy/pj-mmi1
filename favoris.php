<?php
require("initialisation.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <script src="https://kit.fontawesome.com/a195f28410.js" crossorigin="anonymous"></script>
    <title>FLOW - Mes favoris</title>
    <link href="css/parcourir.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/catalogueV2.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="images/logo_phone_favicon.svg" />
    <!-- CSS lecteur audio -->
    <link href="css/lecteur-audio.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
</head>

<body>
    <?php require("header.php"); ?>
    <?php require("favoris-header.php"); ?>
    <main>
        <section class="parcourir onglet">
            <h1>Vos Favoris</h1>
            <h2>Vous pouvez supprimer ou accéder à une radio mise en favoris !</h2> 
            <section class="favoris grid"> 


                <?php if (isset($_SESSION['id']) AND !empty($_SESSION['id'])){
        
        $idUser = $_SESSION['id'];

        $requser = $bdd->prepare("SELECT MettreEnFavoris.Id_Radio, Radio.NomRadio, DateAjoutRadio FROM MettreEnFavoris INNER JOIN Radio ON MettreEnFavoris.Id_Radio = Radio.Id_Radio WHERE Id_User = ? ORDER BY DateAjoutRadio DESC");
        $requser->execute(array($idUser));
        $follow = $requser->fetch(PDO::FETCH_ASSOC);

        while($follow != false){

        $idRadioFav = $follow['Id_Radio'];
        $NomRadio = $follow['NomRadio']; ?>

                <div class="favoris grid-item">
                    <a href="radio.php?radio=<?php echo($idRadioFav); ?>">
                        <div class="favoris miniature">
                            <img src="images/imgRadio/<?php echo($NomRadio); ?>.webp" alt="">
                        </div>
                    </a>
                    <div class="legende">
                        <a href="radio.php?radio=<?php echo($idRadioFav); ?>"><?php echo($NomRadio); ?></a>
                        <p>Genre :
                            <?php  $res = $bdd->prepare('SELECT Categorie.Id_Categorie, NomCategorie AS cat FROM Categorie INNER JOIN Appartient_a_categorie ON Appartient_a_categorie.Id_Categorie = Categorie.Id_Categorie WHERE Id_Radio = ?');
                    $res->execute(array($idRadioFav));
                    $catRadio = $res-> fetch(PDO::FETCH_ASSOC);
                        
        ?>
                            <?php while($catRadio != false){
                            $afficheCat = $catRadio['cat'];
                            echo('<span class="color-content-radio">'.$afficheCat."</span> ");
                            $catRadio = $res-> fetch(PDO::FETCH_ASSOC);
                        }
    $follow = $requser->fetch(PDO::FETCH_ASSOC);
                        ?></p>

                        <form method="post" action="favori/supprimerPageFav.php">
                            <input type="hidden" name="idRadio" value="<?php echo $idRadioFav?>" />
                            <button class="bouton-favoris" name="supprimer"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                <?php } }else{ ?>
            </section>

            <div class="connexion-out-div">
                <p class="connexion-out-p">Vous devez être connecté pour pouvoir accéder à vos favoris.</p>
                <img class="connexion-out-img" src="images/puix-deco.svg" alt="Vous n'êtes pas connecté">
            </div>
        </section>
    </main> 
    <?php } ?>
    <script src="js/jquery-3.6.0.js"></script>
    <?php require("chat.php"); ?>
    <script src="js/index.js"></script>
    <script src="js/catalogueV2.js"></script>
    <script src="js/header.js"></script>

</body>

</html>
