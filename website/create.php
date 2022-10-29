<html>
 <?php include("template/header.php"); ?>
 <body>
   <?php include("template/navbar.php"); ?>
     <?php
    include "connect.php"; /* Le fichier connect_pg.php contient les identifiants de connexion */
    /* On crée une table avec des données: */
    $creation="create table COMMUNE (
            ID_COMMUNE serial PRIMARY KEY,
            NOM VARCHAR (50) NOT NULL,
            CODE_POSTAL INT   NOT NULL
        );";
    /* Execution d'une requete multiple */
        $result=pg_query($connection, $creation);
     ?>
     <?php if($result) : ?>
        <div class="row">
            <div class="col s4 m4 offset-s4 offset-m4">
            <div class="card green darken-1">
                <div class="card-content white-text">
                <span class="card-title">Création des tables</span>
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
                <span class="card-title">Création des tables</span>
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
