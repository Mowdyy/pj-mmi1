<?php 
require("initialisation.php");
$heure = date("G:i");
?>
<?php
$deleteFav = $bdd->query("DELETE FROM MessageEnDirect");
?>
<p><span><?php echo($heure) ?></span><strong><?php echo("système") ?></strong> : <?php echo("Le chat à été supprimé, il est automatiquement nettoyé toutes les 12h !") ?></p>