<?php
//Instanciation d'un objet avec la classe DOMDocument qui réprensente notre fichier XML
$xml = new DOMDocument();
//Chargement du fichier XML
$xml->load('source.xml');
//Variable permettant d'établir la valeur de la page à 0
$page = 0;
//Récupération du nombre de pages
$count = $xml->getElementsByTagName('page')->length;
//Vérification de la réception de la page
//Méthode GET pour réécriture d'URL
//Fonction is_numeric() permet de définir que la valeur est bien un nombre
if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] <= $count && $_GET['page'] > 0) {
    //La variable $page est égale à la valeur de 'page' - 1 => Par rapport aux valeurs d'un tableau qui débutent à 0
    $page = $_GET['page'] - 1;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet"> 
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Projet IMTC</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="logo center-block" src="assets/img/logo.png" alt="logo de l'entreprise Ocordo"/>
                </div>
            </div>

            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <a class="navLink" href="index.php"></a>
                        <!-- Grâce à getElementsByTagName on récupère les informations du fichier XML -->
                        <?php
                        foreach ($xml->getElementsByTagName('menu') as $link => $index) {
                            ?>
                            <!-- On génère l'index afin d'assigner un lien à chaque li de la navbar -->
                            <li><a href="<?= $link + 1 ?>.html"><?= $index->nodeValue; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>
            <div class="background">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        //Récupération du content de la page en fonction de son ID
                        $targetPage = $xml->getElementsByTagName('content')->item($page);
                        //nodeValue permet l'envoi du contenu dans la page
                        echo $targetPage->nodeValue;
                        if ($page == 1) {
                            ?>   
                            <p class="linkYoutube"><a href="https://www.youtube.com/embed/Crh5lFpNK0o?feature=oembed">Lien YouTube</a></p>
                        <?php } ?> 
                    </div>
                </div>
            </div>
            <footer>
                <div class="footerOcordo">
                    <p class="copyright">Copyright 1999-2018 by Refsnes Data. All Rights Reserved.</p>
                    <div class="row authorOcordo">
                        <div class="col-lg-3 col-md-6 col-xs-12"><a href="https://chloelente.github.io/">Chloé</a></div>
                        <div class="col-lg-3 col-md-6 col-xs-12"><a href="https://www.linkedin.com/in/ibrahima-bamba-304394132/">Ibrahima</a></div>
                        <div class="col-lg-3 col-md-6 col-xs-12"><a href="https://maximedefretin.github.io/">Maxime</a></div>
                        <div class="col-lg-3 col-md-6 col-xs-12"><a href="https://thomasszymanski.github.io/">Thomas</a></div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>
