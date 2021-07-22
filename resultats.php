<?php
require("initialisation.php");

$radio = $bdd ->query('SELECT NomRadio, Id_Radio FROM Radio ORDER BY NomRadio DESC');
$radio->execute();
$toutesRadios = $radio-> fetch(PDO::FETCH_ASSOC);

if(isset($_GET['mot']) AND !empty($_GET['mot'])) {
    
    $mot = htmlspecialchars($_GET['mot']);
    $_SESSION['mot'] = $mot;
    
    $radio = $bdd ->query('SELECT NomRadio, Id_Radio FROM Radio WHERE NomRadio LIKE "%'.$mot.'%" ORDER BY NomRadio DESC');
}else{    
    header("Location: catalogue.php");
}
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <title>FLOW - Résultats</title>
    <?php require("head.php"); ?>
    <link href="css/parcourir.css" rel="stylesheet" />
    <link href="css/catalogueV2.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/header.css" />
</head>

<body>
    <?php 
    require("header.php");
    require("favoris-header.php");
?>
    <main>
        <section class="parcourir onglet">
            <h1>Résultats des recherches</h1>
            <h2>Parcourez le catalogue à la recherche de la radio de vos envies. Si vous ne trouvez pas ce vous voulez (ce qui serait triste), n'hésitez pas à nous le faire savoir !</h2>
            <section class="catalogue grid">

                <!--- if quand le resultat est trouvé--->
                <?php if($radio->rowCount() > 0) {
while($res = $radio->fetch()) {

    $nomRadio = $res['NomRadio'];
    $idRadio = $res['Id_Radio'];

?>
                <div class="catalogue grid-item">
                    <a href="radio.php?radio=<?php echo($idRadio); ?>">
                        <div class="catalogue miniature">
                            <img src="images/imgRadio/<?php echo($nomRadio); ?>.webp">
                        </div>
                    </a>
                    <div class="legende">
                        <a href="radio.php?radio=<?php echo($idRadio); ?>">

                            <!-- affiche le resultat titre de la radio-->
                            <?= $res['NomRadio'] ?>

                        </a>

                        <p>Genre :

                            <?php
    $res = $bdd->prepare('SELECT NomCategorie AS cat, Categorie.Id_Categorie FROM Categorie INNER JOIN Appartient_a_categorie ON Appartient_a_categorie.Id_Categorie = Categorie.Id_Categorie WHERE Id_Radio = ?');
    $res->execute(array($idRadio));
    $catRadio = $res-> fetch(PDO::FETCH_ASSOC);

        while($catRadio != false){
        $afficheCat = $catRadio['cat'];
        echo('<span class="color-content-radio">'.$afficheCat."</span> ");
        $catRadio = $res-> fetch(PDO::FETCH_ASSOC);
        }
?>
                        </p>
                        <?php

if(isset($_SESSION["id"]) AND !empty($_SESSION['id'])){

    $idUser = $_SESSION['id'];

    $SelectFav = $bdd->prepare("SELECT Id_User, Id_Radio FROM MettreEnFavoris WHERE Id_User = ? AND Id_Radio = ? ");
    $SelectFav->execute(array($idUser, $idRadio));
    $aFav = $SelectFav-> fetch(PDO::FETCH_ASSOC);
?>

                        <form class="form-lecteur" method="post" action="recherche/majFav.php">
                            <input type="hidden" name="idRadio" value="<?php echo($idRadio) ?>" />
                            <?php if($aFav != false){ ?>

                            <button class="bouton-favoris" name="favori" value="false"><i class="fas fa-heart coloredred"></i></button>
                            <?php 
    }else{ 
?>
                            <button class="bouton-favoris" name="favori" value="true"><i class="far fa-heart"></i></button>
                            <?php 
    } 
?>
                        </form>

                        <?php 
}else{ 
?>
                        <a href="connexion.php" class="bouton-favoris"><i class="icon far fa-heart"></i></a>
                        <?php 
} 
?>
                    </div>
                </div>
                <?php

} ?>

                <!--- else quand le resultat est  pas trouvé (fin if)--->
                <?php 
}else{ 
?> </section>
            <p class="capter">Nous ne trouvons aucun résultat pour "<?= $mot ?>". N'hésites pas à proposer la radio de tes rêves <a href="soumettre.php">ici</a> !</p>
            <?php 
}
?>

        </section>
    </main>

    <?php require("chat.php"); ?>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/catalogueV2.js"></script>
    <script src="js/index.js"></script>
    <script src="js/header.js"></script>
</body>

</html>
