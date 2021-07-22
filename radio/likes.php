<?php
// Vérifie que le bouton like est valide
        if (isset($_POST["like"])){
            // Vérifie que le bouton like à transmit une valeur true (coché)
            if($_POST["like"] == 'true'){

                $insertLike = $bdd->prepare("INSERT INTO Liker(Id_User, Id_Radio) VALUES(?, ?)");
                $insertLike->execute(array($idUser, $idRadio));

                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = ("radio.php?radio=$idRadio");
                header("Location: http://$host$uri/$extra");

            }else{
                $deleteLike = $bdd->prepare("DELETE FROM Liker WHERE id_User = ? AND Id_Radio = ?");
                $deleteLike->execute(array($idUser, $idRadio));

                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = ("radio.php?radio=$idRadio");
                header("Location: http://$host$uri/$extra");
            }
        }
?>

