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
   <h2 class="center">Moyenne des kilométrages des voitures ayant le plus de tickets</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
     <div class="container">
            <br><br>
            <div class="row">
                <div class="col s12 s4 m4 offset-s4 offset-m4">
                    <div class="card white darken-1">
                        <div class="card-content black-text">
                            <span class="card-title center">
            <br><br>
          <?php
                $requete = file_get_contents("sql/requests/stats/moyenne_kilometrages_voitures_plus_tickets.sql");
                /* Si l'execution est reussie... */
                $res = pg_query($connection, $requete);
                $i = 0;
                if($res) {
                    /* ... on récupère un tableau stockant le résultat */
                      $avg =  pg_fetch_assoc($res);
                      echo 'La moyenne des kilométrages des voitures ayant le plus de tickets est '.round($avg['moyenne_km'], 0).'km.';
                      /*liberation de l'objet requete:*/
                }
                  pg_free_result($res);
                  /*fermeture de la connexion avec la base*/
                  pg_close($connection);
          ?>
                      </span>
                    </div>
                    </div>
                </div>
            </div>
      <div>
        
    </section>
   <?php include("template/footer.php"); ?>
 </body>
</html>
