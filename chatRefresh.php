
<?php 
require("initialisation.php");

	$recupMsg = $bdd->query('SELECT DataChatDirect, Pseudo, DATE_FORMAT(Time,"%H:%i") AS Time FROM MessageEnDirect INNER JOIN Utilisateur ON Utilisateur.Id_User = MessageEnDirect.Id_User ORDER BY Id_MessageEnDirect ASC');

while($msg = $recupMsg->fetch()){ ?>

<p><span><?php echo($msg['Time']) ?></span><strong><?php echo($msg['Pseudo']) ?></strong> : <?php echo($msg['DataChatDirect']) ?></p>

<?php } ?>
