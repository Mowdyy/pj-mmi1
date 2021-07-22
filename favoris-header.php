<div class="favoris-header favoris-undisplay">
    <div class="follow-button">
        <p>VOUS LES SUIVEZ</p>
        <a class="fleche"><i class="fas fa-angle-double-left fleche-undisplay"></i></a>
    </div>

    <?php
    if(isset($_SESSION['id'])){
        $idUser = $_SESSION['id'];

        $requser = $bdd->prepare("SELECT MettreEnFavoris.Id_Radio, Radio.NomRadio FROM MettreEnFavoris INNER JOIN Radio on MettreEnFavoris.Id_Radio = Radio.Id_Radio WHERE Id_User = ? ");
        $requser->execute(array($idUser));
        $follow = $requser->fetch(PDO::FETCH_ASSOC) ;
?>
    <div class="follows">

<?php while($follow != false){

        $idRadioFav = $follow['Id_Radio'];
        $NomRadio = $follow['NomRadio']; ?>

        <div class="follows-flex">
            <a href="https://la-projets.univ-lemans.fr/~mmi1pj07/radio.php?radio=<?php echo($idRadioFav); ?>">
                <div class="icon-radio">
                    <img src="images/imgRadio/<?php echo($NomRadio); ?>.webp" alt="Nom de votre radio favorite">
                </div>
                <div class="infos-genre">
                    <p class="radio-nom"><?php echo($NomRadio); ?></p>
                    <p class="radio-genre">

        <?php  $res = $bdd->prepare('SELECT Categorie.Id_Categorie, NomCategorie AS cat FROM Categorie INNER JOIN Appartient_a_categorie ON Appartient_a_categorie.Id_Categorie = Categorie.Id_Categorie WHERE Id_Radio = ?');
        $res->execute(array($idRadioFav));
        $catRadio = $res-> fetch(PDO::FETCH_ASSOC);
                        
        ?>
                    <?php while($catRadio != false){
                            $afficheCat = $catRadio['cat'];
                            echo($afficheCat." ");
                            $catRadio = $res-> fetch(PDO::FETCH_ASSOC);
                        }
    $follow = $requser->fetch(PDO::FETCH_ASSOC);
                        ?></p>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
    <!-- Affichage de la barre des favoris quand on est déco -->
    <?php } else { ?>

    <div class="connexion-out-div">
        <p class="connexion-out-p">Vous devez être connecté pour pouvoir accéder à vos favoris.</p>
        <img class="connexion-out-img" src="images/puix-deco.svg" alt="Vous n'êtes pas connecté">
    </div>

    <?php } ?>

    <!-- Intégration lecteur radio -->
    <?php require("lecteur-audio.php"); ?>

</div>
