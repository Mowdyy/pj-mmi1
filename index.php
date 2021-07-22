<?php  
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8") ;
require (__DIR__ . "/param_php-bdd/param.inc.php");
// initialisation bdd
$bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
$bdd->query("SET NAMES utf8");
$bdd->query("SET CHARACTER SET 'utf8'");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_SESSION['id'])){
$idUser = $_SESSION['id'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
        <title>FLOW - Accueil</title>
        <?php require("head.php"); ?>
</head>

<body>
    
    <section class="loader">
        <div class="ground">
            <div class="traits"></div>
            <div class="logoChargement">
                <img src="images/logo.svg" alt="logo de flow">
            </div>
        </div>
        <div class="radio">
            <svg width="675" height="569" viewBox="0 0 675 569" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="Group">
                    <g id="Radio">
                        <g id="Group_2">
                            <g id="boutonG">
                                <path id="Vector" fill-rule="evenodd" clip-rule="evenodd" d="M521.891 184.606C521.891 177.793 516.359 172.261 509.548 172.261H464.173C457.351 172.261 451.82 177.793 451.82 184.606C451.82 191.42 457.351 196.952 464.173 196.952H509.548C516.359 196.952 521.891 191.42 521.891 184.606Z" fill="#576287" />
                            </g>
                            <g id="boutonD">
                                <g id="Group_3">
                                    <path id="Vector_2" fill-rule="evenodd" clip-rule="evenodd" d="M566.605 172.261C566.378 173.568 568.937 174.823 575.892 175.848C587.543 177.563 595.799 181.285 601.485 185.19C601.227 191.734 595.82 196.952 589.205 196.952H543.829C537.008 196.952 531.476 191.42 531.476 184.606C531.476 177.793 537.008 172.261 543.829 172.261H566.605Z" fill="#576287" />
                                </g>
                                <g id="Group_4">
                                    <path id="Vector_3" fill-rule="evenodd" clip-rule="evenodd" d="M566.604 172.258H589.206C596.015 172.258 601.547 177.79 601.547 184.604L601.489 185.186C595.804 181.284 587.539 177.561 575.896 175.847C568.94 174.82 566.382 173.568 566.604 172.258Z" fill="#727DA3" />
                                </g>
                            </g>
                            <g id="antenna">
                                <g id="Group_5">
                                    <path id="Vector_4" fill-rule="evenodd" clip-rule="evenodd" d="M379.707 0.455429C377.746 0.125911 375.705 0.542134 373.864 1.60406C361.497 8.74674 338.271 22.1529 327.718 28.2457C326.304 29.0635 325.29 30.4323 324.917 32.0252C324.556 33.6181 324.85 35.2937 325.77 36.6531C327.571 39.3506 329.759 42.6071 331.494 45.2046C333.228 47.79 336.67 48.5891 339.365 47.0336L354.693 38.1859C366.74 24.0994 375.225 9.26438 379.707 0.455429Z" fill="#9FA6BC" />
                                    <g id="Group_6">
                                        <path id="Vector_5" fill-rule="evenodd" clip-rule="evenodd" d="M379.707 0.451477C375.224 9.26976 366.713 24.0781 354.679 38.1927L383.282 21.6768C386.137 20.0225 388.191 17.261 388.938 14.0459C389.685 10.8307 389.059 7.45551 387.231 4.72064V4.70728C385.47 2.07914 382.668 0.544863 379.707 0.451477Z" fill="#B9C0D5" />
                                    </g>
                                </g>
                                <g id="Group_7">
                                    <path id="Vector_6" fill-rule="evenodd" clip-rule="evenodd" d="M14.1441 211.361C23.1625 199.577 37.3705 191.968 53.3395 191.968H94.3625L337.779 51.4323C341.234 49.4365 342.422 45.0127 340.421 41.5574L333.19 29.0383C331.202 25.5831 326.773 24.3971 323.318 26.3916L17.4393 202.991C14.4776 204.705 13.1836 208.215 14.1441 211.361Z" fill="#8A91A8" />
                                </g>
                            </g>
                            <g id="Group_8">
                                <path id="Vector_7" fill-rule="evenodd" clip-rule="evenodd" d="M0 519.528V519.511V243.938C18.6433 224.641 54.7766 198.715 118.714 189.301L118.755 189.293H625.437C652.664 189.293 674.776 211.403 674.776 238.636V467.403C674.339 467.994 616.605 545.778 337.392 545.778C57.1162 545.778 0 467.4 0 467.4V519.528Z" fill="#4C75FF" />
                                <g id="Group_9">
                                    <path id="Vector_8" fill-rule="evenodd" clip-rule="evenodd" d="M118.746 189.293H49.3476C22.1057 189.293 0 211.412 0 238.641V243.951C18.6371 224.646 54.7773 198.725 118.706 189.307L118.746 189.293Z" fill="#3F65E3" />
                                </g>
                                <g id="Group_10">
                                    <path id="Vector_9" fill-rule="evenodd" clip-rule="evenodd" d="M0 519.534V467.406C0 467.406 57.1118 545.786 337.389 545.786C616.598 545.786 674.337 468.001 674.778 467.408V519.516C674.778 546.749 652.659 568.86 625.43 568.86H49.3476C22.119 568.86 0.0133408 546.758 0 519.534Z" fill="#3F65E3" />
                                </g>
                            </g>
                            <g id="Group_11">
                                <path id="Vector_10" d="M171.423 480.846C233.513 480.846 283.846 430.513 283.846 368.423C283.846 306.334 233.513 256 171.423 256C109.334 256 59 306.334 59 368.423C59 430.513 109.334 480.846 171.423 480.846Z" fill="#576287" />
                            </g>
                            <g id="Group_12">
                                <path id="Vector_11" fill-rule="evenodd" clip-rule="evenodd" d="M565.492 323.639C565.492 315.761 559.115 309.375 551.231 309.375H436.286C428.402 309.375 422.025 315.761 422.025 323.639V323.643C422.025 331.52 428.402 337.907 436.286 337.907H551.231C559.115 337.907 565.492 331.52 565.492 323.643V323.639Z" fill="#576287" />
                            </g>
                        </g>
                    </g>
                    <g id="smileMouth">
                        <path id="Vector_12" fill-rule="evenodd" clip-rule="evenodd" d="M287.716 442.21C287.716 450.727 292.325 458.864 300.883 465.249C311.401 473.099 328.32 478.436 347.458 478.436C366.54 478.436 383.404 473.539 393.897 466.065C402.541 459.904 407.199 451.919 407.199 443.313C407.199 438.996 403.7 435.491 399.38 435.491C395.061 435.491 391.562 438.996 391.562 443.313C391.562 447.254 388.777 450.504 384.821 453.325C376.404 459.319 362.763 462.792 347.458 462.792C332.208 462.792 318.616 458.965 310.236 452.711C306.188 449.69 303.354 446.239 303.354 442.21C303.354 437.893 299.854 434.388 295.535 434.388C291.216 434.388 287.716 437.893 287.716 442.21Z" fill="#3F65E3" />
                    </g>
                    <g id="deadEyes">
                        <g id="Group_13">
                            <path id="Vector_13" fill-rule="evenodd" clip-rule="evenodd" d="M243.287 304L266.145 326.858L220.429 372.574L266.145 418.287L243.287 441.145L197.571 395.429L151.855 441.145L129 418.287L174.713 372.574L129 326.858L151.855 304L197.571 349.716L243.287 304Z" fill="#8E9BFF" />
                        </g>
                        <g id="Group_14">
                            <path id="Vector_14" fill-rule="evenodd" clip-rule="evenodd" d="M544.46 304L567.318 326.858L521.602 372.574L567.318 418.287L544.46 441.145L498.744 395.429L453.028 441.145L430.173 418.287L475.886 372.574L430.173 326.858L453.028 304L498.744 349.716L544.46 304Z" fill="#454757" />
                        </g>
                    </g>
                    <g id="winkEyes">
                        <g id="Group_15">
                            <path id="Vector_15" fill-rule="evenodd" clip-rule="evenodd" d="M588.536 399.991C589.365 385.096 582.706 371.366 571.407 361.215C565.527 355.938 558.333 351.686 550.289 348.741C542.475 345.877 533.81 344.372 524.748 344.279C519.481 344.338 514.358 344.811 509.473 345.787C497.432 348.192 486.717 353.173 478.485 360.094C466.998 369.742 460.166 383.019 460.959 398.028C460.959 399.398 462.294 400.51 463.946 400.51C465.592 400.51 466.934 399.398 466.934 398.028C467.619 384.98 474.675 373.946 485.39 366.208C490.7 362.37 496.962 359.432 503.824 357.431C510.317 355.537 517.367 354.532 524.748 354.642C532.157 354.565 539.228 355.749 545.736 357.857C552.554 360.065 558.774 363.253 564.055 367.32C574.733 375.532 581.84 386.97 582.561 399.991C582.561 401.36 583.896 402.472 585.549 402.472C587.194 402.472 588.536 401.36 588.536 399.991Z" fill="#3F65E3" />
                        </g>
                        <g id="Group_16">
                            <path id="Vector_16" d="M173.881 455.762C222.416 455.762 261.762 416.416 261.762 367.881C261.762 319.346 222.416 280 173.881 280C125.346 280 86 319.346 86 367.881C86 416.416 125.346 455.762 173.881 455.762Z" fill="white" />
                        </g>
                        <g id="Group_17">
                            <path id="Vector_17" fill-rule="evenodd" clip-rule="evenodd" d="M218.491 348.041C221.233 354.091 222.735 360.812 222.735 367.882C222.735 394.845 200.845 416.735 173.882 416.735C146.919 416.735 125.029 394.845 125.029 367.882C125.029 340.919 146.919 319.029 173.882 319.029C180.955 319.029 187.673 320.534 193.726 323.272L181.343 360.424L218.491 348.041Z" fill="black" />
                        </g>
                    </g>
                    <g id="bigEyes">
                        <g id="Group_18">
                            <path id="Vector_18" d="M175.078 448.157C219.304 448.157 255.157 412.304 255.157 368.078C255.157 323.852 219.304 288 175.078 288C130.852 288 95 323.852 95 368.078C95 412.304 130.852 448.157 175.078 448.157Z" fill="white" />
                        </g>
                        <g id="Group_19">
                            <path id="Vector_19" fill-rule="evenodd" clip-rule="evenodd" d="M215.729 350C218.227 355.514 219.595 361.638 219.595 368.08C219.595 392.649 199.649 412.595 175.08 412.595C150.511 412.595 130.565 392.649 130.565 368.08C130.565 343.511 150.511 323.565 175.08 323.565C181.525 323.565 187.647 324.936 193.162 327.431L181.879 361.285L215.729 350Z" fill="black" />
                        </g>
                        <g id="Group_20">
                            <path id="Vector_20" d="M498.91 448.157C543.136 448.157 578.988 412.304 578.988 368.078C578.988 323.852 543.136 288 498.91 288C454.684 288 418.831 323.852 418.831 368.078C418.831 412.304 454.684 448.157 498.91 448.157Z" fill="white" />
                        </g>
                        <g id="Group_21">
                            <path id="Vector_21" fill-rule="evenodd" clip-rule="evenodd" d="M539.56 350C542.058 355.514 543.427 361.638 543.427 368.08C543.427 392.649 523.48 412.595 498.911 412.595C474.343 412.595 454.396 392.649 454.396 368.08C454.396 343.511 474.343 323.565 498.911 323.565C505.356 323.565 511.478 324.936 516.993 327.431L505.71 361.285L539.56 350Z" fill="black" />
                        </g>
                    </g>
                    <g id="mouthOpen">
                        <path id="Vector_22" fill-rule="evenodd" clip-rule="evenodd" d="M313.078 490.596C304.354 481.755 299 469.607 299 456.216C299 443.549 303.795 431.993 311.799 423.386L312.851 424.672C316.181 427.993 320.669 429.855 325.371 429.855H371.053C375.754 429.855 380.256 427.993 383.572 424.672L384.625 423.393C392.629 431.997 397.424 443.552 397.424 456.216C397.424 469.667 392.016 481.864 383.239 490.725C376.593 486.589 366.938 482.526 352.207 482.018C334.56 481.411 321.695 485.777 313.078 490.596Z" fill="#FF726A" />
                        <g id="Group_22">
                            <path id="Vector_23" fill-rule="evenodd" clip-rule="evenodd" d="M313.079 490.595C321.696 485.774 334.561 481.406 352.208 482.018C366.938 482.524 376.594 486.587 383.24 490.729C374.33 499.812 361.917 505.432 348.213 505.432C334.441 505.432 321.989 499.759 313.079 490.595Z" fill="#E5665E" />
                        </g>
                        <g id="Group_23">
                            <path id="Vector_24" fill-rule="evenodd" clip-rule="evenodd" d="M311.797 423.391C320.684 413.285 333.719 407 348.208 407C362.706 407 375.75 413.285 384.627 423.391L383.579 424.671C380.258 427.992 375.75 429.855 371.049 429.855H325.375C320.674 429.855 316.176 427.992 312.855 424.671L311.797 423.391Z" fill="white" />
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </section>
    <main class="main-accueil mainHide">
       <?php require("header.php"); ?>
        <?php require("favoris-header.php"); ?>
        <section class="presentation-accueil">
            <div>
                <div>
                    <h1>Qu'est-ce qu'on vous sert ?</h1>
                    <p><strong>Flow</strong> est une plateforme de streaming pas comme les autres. Tu peux y venir écouter des centaines de musiques et d’émissions en choissisant parmis de nombreuses radios. Pas de panique, il y en a pour tous les goûts : <strong>pop, rock, jazz, chill et électro</strong> ! Qu’est-ce que tu attends, lance-toi !</p>
                </div>
                <a href="catalogue.php" class="send" type="submit">Écouter une radio</a>
            </div>
        </section>
        <section class="moment-accueil">
            <div>
                <img class="illustration" src="images/vignettes1.svg" alt="Discussion en direct !">
                <div class="accueil-content">
                    <h2>Passe d'agréables moments grâce au chat en direct</h2>
                    <p>Ne te coupes pas du monde et rejoins les autres utilisateurs sur le chat en direct. L'espace de discussion idéal pour blablater & partager vos réactions !</p>
                </div>
            </div>
        </section>
        <svg class="wave1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160">
            <path fill="#2e2f38" fill-opacity="1" d="M0,32L48,48C96,64,192,96,288,96C384,96,480,64,576,64C672,64,768,96,864,112C960,128,1056,128,1152,117.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>
        <section class="preferee-accueil">
            <div>
                <div class="accueil-content">
                    <h2>Ecoute ta radio préférée en un seul clic</h2>
                    <p>Une radio te plaît ? Ajoute la directement à tes favoris et lance la en quelques secondes grâce au panneau latéral.</p>
                </div>
                <img class="illustration" src="images/vignettes2.svg" alt="Les favoris">
            </div>
        </section>
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160">
            <path fill="#2e2f38" fill-opacity="1" d="M0,32L48,48C96,64,192,96,288,96C384,96,480,64,576,64C672,64,768,96,864,112C960,128,1056,128,1152,117.3C1248,107,1344,85,1392,74.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
        <section class="soumettre-accueil">
            <div>
                <img class="illustration" src="images/vignettes3.svg" alt="Tu souhaites une nouvelle radio ?">
                <div class="accueil-content">
                    <h2>Ta radio préféré n'est pas trouvable sur Flow?</h2>
                    <p>Fais le nous savoir en remplissant un formulaire <a href="soumettre.php">disponible ici</a>. Nous étudierons ta requête le plus rapidement possible.</p>
                </div>
            </div>
        </section>
    <?php require("chat.php"); ?>
    </main>
    <script src="js/index.js"></script>
    <script src="js/header.js"></script>
    <script src="js/loader.js"></script>
    <script src="js/chargement.js"></script>
    <script src="js/lecteur-audio.js"></script>
    <script src="js/jquery-3.6.0.js"></script>
    <?php require("footer.php"); ?>
</body>
</html>
