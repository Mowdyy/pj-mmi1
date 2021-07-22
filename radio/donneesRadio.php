<?php $idRadio = $_GET["radio"];
$_SESSION['radio'] = $_GET["radio"]; 

     //requète qui recupère toutes les infos d'une radio
    $requser = $bdd->prepare("SELECT NomCategorie, UrlRadio, NomRadio, DescriptionRadio FROM Radio, Categorie INNER JOIN Appartient_a_categorie ON Appartient_a_categorie.Id_Categorie = Categorie.Id_Categorie WHERE Appartient_a_categorie.Id_Radio = Radio.Id_Radio AND Radio.Id_Radio = ? ");
    $requser->execute(array($idRadio));
    $radio = $requser->fetch(PDO::FETCH_ASSOC);

        // insertion des valeurs récupéré dans des variables
    $categorie = $radio['NomCategorie'];
    $url = $radio["UrlRadio"];
    $nomRadio = $radio["NomRadio"];
    $description = $radio["DescriptionRadio"];

    $_SESSION['nomCategorie'] = $radio['NomCategorie'];
    $_SESSION['nomRadio'] = $radio['NomRadio'];
    $_SESSION['urlRadio'] = $radio["UrlRadio"];
?>