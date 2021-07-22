<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8") ;
require ("../param_php-bdd/param.inc.php");
// initialisation bdd
$bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
$bdd->query("SET NAMES utf8");
$bdd->query("SET CHARACTER SET 'utf8'");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_SESSION["id"]) AND !empty($_SESSION['id'])){

        $idUser = $_SESSION['id'];

if(isset($_POST['idRadio'])){
    $idRadio = $_POST['idRadio'];
    echo($idRadio);
}else{
    echo("marche pas");
}

    if(isset($_POST["favori"])){

        if($_POST["favori"] == 'true'){
            
            $insertFav = $bdd->prepare("INSERT INTO MettreEnFavoris(Id_Radio, Id_User) VALUES (?, ?)");
            $insertFav->execute(array($idRadio, $idUser));
                                   
        }else{

                $deleteFav = $bdd->prepare("DELETE FROM MettreEnFavoris WHERE id_User = ? AND Id_Radio = ?");
                $deleteFav->execute(array($idUser, $idRadio));
        }
    }
}
$mot = $_SESSION['mot'];
header("Location: ../resultats.php?mot=$mot");
?>