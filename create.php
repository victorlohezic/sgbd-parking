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
     <?php if($rmvresult and $creresult) : ?>
        <div class="row">
            <div class="col s4 m4 offset-s4 offset-m4">
            <div class="card green darken-1">
                <div class="card-content white-text">
                <span class="card-title">Création des tables réussie</span>
                </div>
                <div class="card-action">
                <a href="/index.php">Revenir à la page d'accueil</a>
                </div>
            </div>
            </div>
        </div>
     <?php elseif($creation === false) : ?>
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
     <?php else : ?>
        <div class="row">
            <div class="col s12 s4 m4 offset-s4 offset-m4">
            <div class="card red darken-1">
                <div class="card-content white-text">
                <span class="card-title">Erreur</span>
                <span class="card-title">Echec de création des tables</span>
                </div>
                <div class="card-action">
                <a href="/index.php">Revenir à la page d'accueil</a>
                </div>
            </div>
            </div>
        </div>
     <?php endif; ?>
     <?php include("template/footer.php"); ?>
 </body>
</html>
