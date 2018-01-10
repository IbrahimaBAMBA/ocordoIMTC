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
        <link rel="stylesheet" href="assets/css/style2.css" />
        <title>Projet IMTC</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="logo center-block" src="assets/img/logo.png" alt="logo de l'entreprise Ocordo"/>
                </div>
            </div>
            
            <div class="menunavbar collapse navbar-collapse">
                
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
            <div class="background">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        //Récupération du content de la page en fonction de son ID
                        $targetPage = $xml->getElementsByTagName('content')->item($page);
                        //nodeValue permet l'envoi du contenu dans la page
                        echo $targetPage->nodeValue;
                        ?>
                    </div>
                </div>
            </div>
        <footer>
            <p>blabla</p>
        </footer>
        </div>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>
