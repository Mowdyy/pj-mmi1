<?php
                    $res = $bdd->prepare('SELECT count(*) AS nb FROM Commenter WHERE id_Radio = ?');
                    $res->execute(array($idRadio));
                    $comm = $res-> fetch(PDO::FETCH_ASSOC);
                    $nb = $comm['nb'];
                    echo($nb);
?>