<?php
//on instancie un objet de la classe DOMDocument qui représente un fichier XML (ou HTML) entier.
$xml = new DOMDocument();
// On charge le document xml.
$xml->load('source.xml');
// On indique que la page courante = 0.
$page = 0;
// On compte le nombre de page et on la récupère par getElementByTagName.
$count = $xml->getElementsByTagName('page')->length;
// On vérifie que la page est bien reçu et on compte le nombre de page si l'indice est supérieure à 0.
// la méthode get permettra la réécriture d'url par le htaccess avec l'option +FollowSymlinks.
if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] <= $count && $_GET['page'] > 0) {
    //La variable $page est égale à la valeur de 'page' - 1
    $page = $_GET['page'] - 1;
}
?>

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="style.css"/>
        <title></title>
    </head>
    <body>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <a class="navLink" href="index.php"></a>
                <!-- On récupère les informations du fichier XML dans notre DomDocument en faisant appel à la méthode getElementsByTagName-->
                <?php
                foreach ($xml->getElementsByTagName('menu') as $position => $nav) {
                    ?>
                    <!-- On affiche l'index que l'on assigne à notre variable nav en ajoutant 1-->
                    <li><a href="<?= $position + 1 ?>.html"><?= $nav->nodeValue; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    //On récupère le content du fichier xml selon l'id de la page.
                    $ciblePage = $xml->getElementsByTagName('content')->item($page);
                    //Envoi du contenu dans la page avec nodeValue.
                    echo $ciblePage->nodeValue;
                    ?>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>