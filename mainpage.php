<html>
 <?php // Bloc PHP qui permet de spécifier une erreur sur la page
 // Intéressant notamment lors d'erreurs 500 peu précises
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);

 ?>
 <?php include("template/header.php"); ?>
 <body>
   <?php include("template/navbar.php"); ?>
     <?php
    include "connect.php"; /* Le fichier connect_pg.php contient les identifiants de connexion */
    /* On crée une table avec des données: */
    $remove=file_get_contents('sql/clean.sql');
    /* Execution d'une requete multiple */
        $rmvresult=pg_query($connection, $remove);
    $creation=file_get_contents('sql/create.sql');
    /* Execution d'une requete multiple */
        $creresult=pg_query($connection, $creation);
     ?>
     <?php if($rmvresult==false) :?>
        <div class="row">
            <div class="col s12 s4 m4 offset-s4 offset-m4">
            <div class="card red darken-1">
                <div class="card-content white-text">
                <span class="card-title">Erreur</span>
                <span class="card-title">Echec de suppression des tables</span>
                </div>
                <div class="card-action">
                <a href="/index.php">Revenir à la page d'accueil</a>
                </div>
            </div>
            </div>
        </div>
    <?php elseif($creresult === false) : ?>
        <div class="row">
            <div class="col s12 s4 m4 offset-s4 offset-m4">
            <div class="card red darken-1">
                <div class="card-content white-text">
                <span class="card-title">Erreur</span>
                <span class="card-title">Echec de lecture de la query</span>
                </div>
                <div class="card-action">
                <a href="/index.php">Revenir à la page d'accueil</a>
                </div>
            </div>
            </div>
        </div>
    <?php else :?>
        <div class="section no-pad-bot" id="index-banner">
            <div class="container">
            <br><br>
                <h1 class="header center orange-text">JTB Parking</h1>
                <div class="row center">
                    <h5 class="header col s12 light">Un gestionnaire de Parking OpenSource et Libre</h5>
                </div>
            </div>
        </div>
        <div class="container">
            <br><br>
            <div class="row">
                <div class="col s12 s4 m4 offset-s4 offset-m4">
                    <div class="card green darken-1">
                        <div class="card-content white-text">
                            <span class="card-title center">Base de données initilaisée avec succes</span>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">

                <div class="col s6 center">
                    <a href="/consultation.php" class="btn-jtb"> Consulter la base de données</a>
                </div>
                <div class="col s6 center">
                    <a href="/stats.php" class="btn-jtb"> Consulter les statistiques de la base de données</a>
                </div>
            </div>
            <br><br>
        </div>

    <?php endif; ?>

<?php include("template/footer.php"); ?>


</body>

</html>