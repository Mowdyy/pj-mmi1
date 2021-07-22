<?php if(isset($_SESSION['radio'])){
	
// initialisation bdd
$bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
$bdd->query("SET NAMES utf8");
$bdd->query("SET CHARACTER SET 'utf8'");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$idRadio = $_SESSION['radio'];
$nomRadio = $_SESSION['nomRadio'];
$urlRadio = $_SESSION['urlRadio'];

?>
<div class="lecteur-audio">
    <div class="container">
        <div class="container-header">
            <div class="pp-radio">
                <img class="logo-radio" src="images/imgRadio/<?php echo($nomRadio); ?>.webp" alt="logo de la radio" />
            </div>
            <i><?php echo($nomRadio); ?></i>
        </div>
        <div class="lecteur-js">
            <audio id="player">
                <!--  Lien dinamyque pour la source audio -->
                <source src="<?php echo($urlRadio) ?>" type="audio/mp3">
            </audio>
        </div>
        <div class="controls">
            <?php require("radio/follow.php"); ?>
            <i id="player" class="icon fas fa-play-circle"></i>
            <i class="icon fas fa-volume-down"></i>
            <input type="range" min="0" max="100" value="100" id="volume-control">
        </div>
    </div>
</div>
<?php } ?>
