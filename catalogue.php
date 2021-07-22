<?php
require("initialisation.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>FLOW - Explorer</title>
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
            <h1>Explorer</h1>
            <h2>Parcourez le catalogue à la recherche de la radio de vos envies. Si vous ne trouvez pas ce vous voulez (ce qui serait triste), n'hésitez pas à nous le faire savoir !</h2>
        <?php require("catalogue/catalogueRadio.php"); ?>
        </section>
    </main>
    <script src="js/jquery-3.6.0.js"></script>
    <?php require("chat.php"); ?>
    <script src="js/catalogueV2.js"></script>
    <script src="js/index.js"></script>
    <script src="js/header.js"></script>
</body>

</html>