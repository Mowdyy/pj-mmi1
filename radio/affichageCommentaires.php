<?php
    $requser = $bdd->prepare('SELECT DataCommentaire, DATE_FORMAT(Time,"%H:%i") AS Time, Date, Pseudo FROM Commenter INNER JOIN Utilisateur ON Commenter.Id_User = Utilisateur.Id_User WHERE Id_Radio = :idRadio ORDER BY Date DESC, Time DESC');
    $requser->bindValue(':idRadio', $idRadio, PDO::PARAM_INT);
    $requser->execute();
    $commentaires = $requser->fetch(PDO::FETCH_ASSOC); ?>

    
<!-- Affichage des commentaire et de toutes ses données -->

            <div class="commentaires-text">
                <?php 
                while($commentaires != false) { 
                    ?>
                <div class="pseudo-infos">
                    <p>
                        <?php echo($commentaires["Pseudo"]); ?> |
                    </p>
                    <p>
                        <?php echo($commentaires["Date"]); ?> -
                    </p>
                    <p>
                        <?php echo($commentaires["Time"]); ?>
                    </p>
                </div>
                <p>
                    <?php echo($commentaires["DataCommentaire"]); ?>
                </p>
                <?php $commentaires = $requser->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            </div>