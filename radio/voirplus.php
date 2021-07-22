<?php session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8") ;
require ("../param_php-bdd/param.inc.php");
// initialisation bdd
$bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
$bdd->query("SET NAMES utf8");
$bdd->query("SET CHARACTER SET 'utf8'");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['plusCom'])){

$idRadio = $_SESSION['radio'];

$requser = $bdd->prepare("SELECT DataCommentaire, Time, Date, Pseudo FROM Commenter INNER JOIN Utilisateur ON Commenter.Id_User = Utilisateur.Id_User WHERE Id_Radio = ? ORDER BY Date DESC, Time DESC LIMIT 3,5");
    $requser->execute(array($idRadio));
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
<?php }else{
    echo("erreur");
}
header("Location : ../radio.php?radio=<?php echo($idRadio) ?>") ?>