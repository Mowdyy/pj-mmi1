<?php
//initialisation variables
$categorie = null;
$url = null;
$radio = null;
$description = null;
$commentaires = null;
$heure = null;
$pseudo = null;
$date = date("y-m-d"); 
$heure = date("H:i:s");
$erreur = null;

if(isset($_SESSION["nomRadio"])){
$nomRadio = $_SESSION["nomRadio"];
}

if(isset($_SESSION["id"])){
$idUser = $_SESSION["id"];
}
if(isset($_SESSION["radio"])){
$idRadio = $_SESSION["radio"];
}
?>