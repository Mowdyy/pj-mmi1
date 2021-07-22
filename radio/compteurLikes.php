<!-- fonction pour compter les likes relatif à la radio -->
<?php 
$res = $bdd->prepare('SELECT Id_Radio, COUNT(Id_User) AS nbLikes FROM Liker WHERE Id_Radio = ? ');
$res->execute(array($idRadio));
$likeRadio = $res-> fetch(PDO::FETCH_ASSOC);

//fonction qui détermine si une radio à déjà été liké ou non par l'utilisateur pour afficher le resultat. S'il n'est pas connecté il est redirigé vers connexion
if(isset($_SESSION["id"]) AND !empty($_SESSION['id'])){

    $idUser = $_SESSION['id'];
    $res = $bdd->prepare('SELECT Id_User, Id_Radio FROM Liker WHERE Id_User = ? AND Id_Radio = ? ');
    $res->execute(array($idUser, $idRadio));
    $alike = $res-> fetch(PDO::FETCH_ASSOC);
?>

<form action="" method="post" class="form-like">
    <?php if($alike != false){ ?>
    <button name="like" value="false" class="button-like">
        <abbr class="abbr-like" title="Vous avez aimé !"><i class="fas fa-thumbs-up colored"></i></abbr>
    </button>
    <?php } else { ?>
    <button name="like" value="true" class="button-like">
        <abbr class="abbr-like" title="Cliquez pour aimer ce contenu"><i class="far fa-thumbs-up"></i></abbr>
    </button>
    <?php } ?>
</form>
<?php }else{ ?>
<a class="href-button-like" href="connexion.php">
    <button class="button-like"><i class="far fa-thumbs-up"></i></button>
</a>
<?php } ?>
