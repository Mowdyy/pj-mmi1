<header class="header-accueil">
    <a href="index.php"><img class="logo" src="images/logo.svg" alt="logo" /></a>
	<link href="css/header.css" rel="stylesheet"/>
    <nav class="menu">
        <ul>
            <li><a href="index.php"><img class="logo-phone" src="images/logo-phone.svg"/><i>Accueil</i></a></li>
            <li><a href="catalogue.php"><i class="fas fa-search"></i><i>Explorer</i></a></li>
            <li><a href="favoris.php"><i class="far fa-heart"></i><i>Favoris</i></a></li>
            <li><a><i class="fas fa-comment"></i></a></li>
        </ul>
    </nav>
    <div class="recherche">
        <?php require("recherche.php");?>
    </div>


    <?php if(isset($_SESSION['id']) != null){
        ?>
    <div class="deco">
        <p class="btn discret">
            <?php
                $idUser = $_SESSION['id'];
                $siAdmin = $bdd->prepare("SELECT Role, Id_User FROM Utilisateur WHERE Role = 'ADMINISTRATEUR' AND ID_User = ? ");
                $siAdmin->execute(array($idUser));
                $admin = $siAdmin->fetch(PDO::FETCH_ASSOC);?>

            <?php if($admin == true){?>
            <a href="admin.php">
                <?php
                    }else{
                    }?>
                <?php echo($_SESSION['pseudo']); ?></a></p>

        <a class="btn voyant" href="deconnexion.php">Me déconnecter</a>
    </div>
    <?php
            } else { ?>
    <a class="btn voyant" href="connexion.php">Me connecter</a>
    <?php
            } 
            ?>
</header>
