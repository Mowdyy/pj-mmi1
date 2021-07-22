 <!-- Affichage des catégories -->
<?php
$res = $bdd->prepare('SELECT NomCategorie AS cat, Categorie.Id_Categorie FROM Categorie INNER JOIN Appartient_a_categorie ON Appartient_a_categorie.Id_Categorie = Categorie.Id_Categorie WHERE Id_Radio = ?');
$res->execute(array($idRadio));
$catRadio = $res-> fetch(PDO::FETCH_ASSOC);
while($catRadio != false){
$afficheCat = $catRadio['cat'];
echo('<span class="color-content-radio">'.$afficheCat."</span> ");
$catRadio = $res-> fetch(PDO::FETCH_ASSOC);
}
?>