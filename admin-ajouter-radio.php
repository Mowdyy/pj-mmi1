<?php
    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    header("Content-Type: text/html; charset=utf-8") ;
    require (__DIR__ . "/param_php-bdd/param.inc.php");
    $erreur = null;

$idUser = $_SESSION["id"];

     $bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                        $bdd->query("SET NAMES utf8");
                        $bdd->query("SET CHARACTER SET 'utf8'");
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Vérifie sur l'utilisateur est un admin

    $requser = $bdd->prepare("SELECT Role, Id_User FROM Utilisateur WHERE Role = 'ADMINISTRATEUR' AND ID_User = ? ");
    $requser->execute(array($idUser));
    $admin = $requser->fetch(PDO::FETCH_ASSOC);

if($admin == true){

if(isset($_POST['form_ajout-radio'])) {

$nomRadio = htmlspecialchars($_POST['form_nom-radio']);
$url = htmlspecialchars($_POST['form_url-radio']);
$nomRadio = htmlspecialchars($_POST['form_nom-radio']);
$description = htmlspecialchars($_POST['form_description-radio']);
$categories = $_POST['form_categorie-radio'];
$dateAjoutRadio = date('y-m-d');

if(!empty($_POST['form_nom-radio']) AND !empty($_POST['form_url-radio']) AND !empty($_POST['form_nom-radio']) AND !empty($_POST['form_description-radio']) AND !empty($_POST['form_categorie-radio'])) {

    //$insertmbr = $bdd->prepare("INSERT INTO Radio(UrlRadio, NomRadio, DateAjoutRadio, DescriptionRadio, Id_Categorie) VALUES (?, ?, ?, ?, ?)");
    $insertmbr = $bdd->prepare("INSERT INTO Radio(UrlRadio, NomRadio, DateAjoutRadio, DescriptionRadio) VALUES (?, ?, ?, ?)");
                                    $insertmbr->execute(array($url, $nomRadio, $dateAjoutRadio, $description));
                                    $idRadio = $bdd -> lastInsertId();

                                    for($i = 0; $i < count($categories); $i++){
                                    $insertmbr = $bdd->prepare("INSERT INTO Appartient_a_categorie(Id_Categorie, Id_Radio) VALUES (?, ?)");
                                    $insertmbr->execute(array($categories[$i], $idRadio));
                                    }
                                    
                                    $pdo = null ;

                                    $erreur = "Parfait, toutes les donées ont bien été enregistré dans la BDD !";
}
}
}else{
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = ("index.php");
    header("Location: http://$host$uri/$extra");
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>FLOW - Ajouter une radio</title>
    <?php require("head.php") ?>
</head>

<?php require("header.php"); ?>
<?php require("favoris-header.php"); ?>

<body class="page-inscription">
    <div class="inscription">
        <h1>Ajouter une web radio</h1>
        <p class="desc-form">Remplir tout les champs ci-dessous pour ajouter la radio à la base de données</p>

        <form method="post" action="">
            <div>
                <input type="text" name="form_nom-radio" id="form-nom-radio" placeholder="Nom exact de la radio" required class="bordureNone" />
            </div>
            <div>
                <input type="text" name="form_url-radio" id="form-url-radio" placeholder="URL/flux de la radio" required class="bordureNone"/>
            </div>
            <div>
                <input type="text" name="form_description-radio" id="form-description-radio" placeholder="Description" required class="bordureNone" />
            </div>
            <div>
                <select name="form_categorie-radio[]" required class="bordureNone" multiple>
                    <option value="1">Chill</option>
                    <option value="2">Rock</option>
                    <option value="3">Pop</option>
                    <option value="4">Jazz</option>
                    <option value="5">Electro</option>
                </select>

            </div>
            <div>
                <button class="send" type="submit" name="form_ajout-radio">Envoyer</button>
            </div>

            <!-- A mettre en forme ! -->
            <div>
                <p class="form-erreur">
                    <?php  echo($erreur);?>
                </p>
            </div>



             <div>
                <p class="rejoindre-com"><a href="admin.php">Retour à la page Administrateur</a></p>
            </div>
        </form>
    </div>
    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/index.js"></script>
    <?php require("footer.php"); ?>
    <?php require("chat.php"); ?>

</body>

</html>