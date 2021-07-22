<section class="catalogue grid">

<?php
$SelectRadio = $bdd->prepare("SELECT NomRadio, Id_Radio, UrlRadio, DateAjoutRadio FROM Radio ORDER BY RAND() LIMIT 6 ");
$SelectRadio->execute();
$toutesRadios = $SelectRadio-> fetch(PDO::FETCH_ASSOC);


while($toutesRadios != false){ 

    $nomRadio = $toutesRadios['NomRadio'];
    $idRadio = $toutesRadios['Id_Radio']; 
    $UrlRadio = $toutesRadios['UrlRadio'];
    $idRadioFav = $toutesRadios['Id_Radio'];
?>

        <div class="catalogue grid-item">
            <a href="radio.php?radio=<?php echo($idRadio); ?>">
                <div class="catalogue miniature">
                    <img src="images/imgRadio/<?php echo($nomRadio); ?>.webp" alt="">
                </div>
            </a>
            <div class="legende">
                <a href="radio.php?radio=<?php echo($idRadio); ?>"><?php echo($nomRadio); ?></a>
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

<form class="form-lecteur" method="post" action="catalogue/majFav.php">
<input type="hidden" name="idRadio" value="<?php echo($idRadioFav) ?>"/>
    <?php if($aFav != false){ ?>
    
    <button class="bouton-favoris" name="favori" value="false"><i class="fas fa-heart coloredred"></i></button>
    <?php 
    }else{ ?>
    <button class="bouton-favoris" name="favori" value="true"><i class="far fa-heart"></i></button>
    <?php } ?>

</form>

<?php 
}else{ ?>
<a href="connexion.php" class="bouton-favoris"><i class="icon far fa-heart"></i></a>
<?php } ?>
            </div>
        </div>
<?php $toutesRadios = $SelectRadio-> fetch(PDO::FETCH_ASSOC);
     } ?>
    </section>

