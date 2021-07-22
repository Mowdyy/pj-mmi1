<?php
require("../initialisation.php");

$idPropRadio = $_POST['valId'];

if(isset($_POST['poubelle'])){
            $deletePropRad = $bdd->prepare("DELETE FROM PropositionRadio WHERE Id_PropositionRadio = ? ");
            $deletePropRad->execute(array($idPropRadio));
            }

header("Location: ../admin-radios-soumises.php");
exit();
?>