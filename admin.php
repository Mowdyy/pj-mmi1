<?php
//initialisation session
require("initialisation.php");

$requser = $bdd->prepare("SELECT Role, Id_User FROM Utilisateur WHERE Role = 'ADMINISTRATEUR' AND ID_User = ? ");
$idUser = $_SESSION["id"];
    $requser->execute(array($idUser));
    $admin = $requser->fetch(PDO::FETCH_ASSOC);



if($admin != false){

//rien

}else{
                
}

    ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="icon" href="images/logo_phone_favicon.svg" />
    <title>FLOW - Espace Administrateur</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a195f28410.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/logo_phone_favicon.svg" />
        <!-- CSS lecteur audio -->
    <link href="css/lecteur-audio.css" rel="stylesheet">

</head>

<body>
    <?php require("header.php"); ?>
    <?php require("favoris-header.php"); ?>
    <section class="admin-sec">
        <h1>Espace Administrateur</h1>
        <form action="admin-ajouter-radio.php">
            <button class="send" type="submit">Ajouter une radio</button>
        </form>
        <form action="admin-radios-soumises.php">
            <button class="send" type="submit">Radios soumises</button>
        </form>
    </section>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>
    <?php require("footer.php"); ?>
    <?php require("chat.php"); ?>
</body>

</html>
