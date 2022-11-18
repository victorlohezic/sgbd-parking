<html>
 <?php include("template/header.php"); ?>
 <body>
   <?php include("template/navbar.php"); ?>
     <?php
    include "connect.php"; /* Le fichier connect_pg.php contient les identifiants de connexion */
    /* On crée une table avec des données: */
    $add=file_get_contents('sql/add_data.sql');;
    /* Execution d'une requete multiple */
        $result=pg_query($connection, $add);
     ?>
     <?php if($result) : ?>
        <div class="row">
            <div class="col s4 m4 offset-s4 offset-m4">
            <div class="card green darken-1">
                <div class="card-content white-text">
                <span class="card-title">Ajout de valeurs dans la base de données réussi</span>
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
                <span class="card-title">Echec de l'ajout de valeurs dans la base de données</span>
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
