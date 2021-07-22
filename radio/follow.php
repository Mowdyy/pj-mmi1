<?php

if(isset($_SESSION["id"]) AND !empty($_SESSION['id'])){

        $idUser = $_SESSION['id'];
        $idRadio = $_SESSION['radio'];

    $SelectFav = $bdd->prepare("SELECT Id_User, Id_Radio FROM MettreEnFavoris WHERE Id_User = ? AND Id_Radio = ? ");
    $SelectFav->execute(array($idUser, $idRadio));
    $aFav = $SelectFav-> fetch(PDO::FETCH_ASSOC);

?>

<form class="form-lecteur" method="post" action="radio/majFav.php">

    <?php if($aFav != false){ ?>


    <button class="button-form" name="favori" value="false"><i class="icon fas fa-heart coloredred"></i></button>
    <?php 
    }else{ ?>
    <button class="button-form" name="favori" value="true"><i class="icon far fa-heart"></i></button>
    <?php } ?>

</form>



<?php 
}else{ ?>
<form class="form-lecteur"><a href="connexion.php"><i class="icon far fa-heart"></i></a></form>
<?php } ?>
