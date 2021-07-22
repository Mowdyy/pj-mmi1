<?php
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])){

$idUser = $_SESSION['id'];

//$recupPseudo = $bdd->prepare('SELECT Pseudo, Utilisateur.Id_User FROM Utilisateur INNER JOIN MessageEnDirect ON Utilisateur.Id_User = MessageEnDirect.Id_User');
//$recupPseudo->execute(array());
//$pseudo = $recupPseudo-> fetch(PDO::FETCH_ASSOC);

if(isset($_POST['message']) AND !empty($_POST['message'])){

$message = htmlspecialchars($_POST['message']);
$heure = date("G:i");

$insertMsg = $bdd->prepare('INSERT INTO MessageEnDirect(DataChatDirect, Id_User, Time) VALUES(?, ?, ?)');
$insertMsg->execute(array($message, $idUser, $heure));

}
?>
<div class="cargo-chat">
    <div class="discussion">
        <h1>DISCUSSION EN DIRECT</h1>
        <i class="fas fa-times"></i>
    </div>
    <div class="bienvenue-chat">
        <p>Bienvenue dans l'espace d'échange !</p>
    </div>
    <div class="container-chat">
        <div class="direct-chat-box">
            <?php 

$recupMsg = $bdd->query('SELECT DataChatDirect, Pseudo, DATE_FORMAT(Time,"%H:%i") AS Time FROM MessageEnDirect INNER JOIN Utilisateur ON Utilisateur.Id_User = MessageEnDirect.Id_User ORDER BY Id_MessageEnDirect ASC');

while($msg = $recupMsg->fetch()){ ?>

            <p><span><?php echo($msg['Time']) ?></span><strong><?php echo($msg['Pseudo']) ?></strong> : <?php echo($msg['DataChatDirect']) ?></p>

            <?php } ?>

        </div>
        <div class="ecrire-chat">
            <form method="post" action="">
                <input type="text" autocomplete="off" name="message" placeholder="Écrire un message" />
                <button type="submit" /><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>
    <script src="js/ajaxChat.js"></script>

    <?php }else{ ?>

    <div class="cargo-chat">
        <div class="discussion">
            <h1>DISCUSSION EN DIRECT</h1>
            <i class="fas fa-times"></i>
        </div>
        <div class="bienvenue-chat">
            <p>Bienvenue dans l'espace d'échange !</p>
        </div>
        <div class="container-chat">
            <div class="direct-chat-box">

                <?php 
$recupMsg = $bdd->query('SELECT DataChatDirect, Pseudo, DATE_FORMAT(Time,"%H:%i") AS Time FROM MessageEnDirect INNER JOIN Utilisateur ON Utilisateur.Id_User = MessageEnDirect.Id_User ORDER BY Id_MessageEnDirect ASC');

while($msg = $recupMsg->fetch()){ ?>

                <p><span><?php echo($msg['Time']) ?></span><strong><?php echo($msg['Pseudo']) ?></strong> : <?php echo($msg['DataChatDirect']) ?></p>

                <?php } ?>

            </div>
            <div class="ecrire-chat">
                <form method="post" action="">
                    <input type="text" autocomplete="off" name="message" placeholder="Vous devez être connecté pour discuter !" disabled />
                    <button type="submit" /><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
        <?php } ?>
        <script src="js/chat.js"></script>
