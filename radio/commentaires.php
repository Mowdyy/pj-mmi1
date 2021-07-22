<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8") ;
require ("../param_php-bdd/param.inc.php");
require("initialisationVariables.php");

// initialisation bdd
$bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
$bdd->query("SET NAMES utf8");
$bdd->query("SET CHARACTER SET 'utf8'");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_SESSION['id']) AND !empty($_SESSION['id'])){
$idRadio = $_SESSION["radio"];

// Publier un commentaire

// vérifie si le formulaire est valide
        if (isset($_POST["form_publier"])){
// Gestion de l'insertion des commentaires dans la BDD
            //Vérifie que le formulaire pour commenter est remplie
            if (!empty($_POST["form_com"])){
                $formCommentaire = $_POST["form_com"];
                $nbFormCommentaire = mb_strlen($_POST["form_com"]);
            
            if($nbFormCommentaire <= 300){
                //Insertion du commentaire
                $insertmbr = $bdd->prepare("INSERT INTO Commenter(DataCommentaire, Time, Date, Id_Radio, id_User) VALUES(?, ?, ?, ?, ?)");
                $insertmbr->execute(array($formCommentaire, $heure, $date, $idRadio, $idUser));
            }else{
                $erreur = "Votre message est trop long !";
            }
            }
        }
        header("Location: ../radio.php?radio=$idRadio");
        exit();
}
        header("Location: ../connexion.php");
        exit();
?>