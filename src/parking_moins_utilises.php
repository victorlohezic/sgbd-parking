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
   <h2 class="center">Parkings</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>Classement</th>
              <th>Nom Parking</th>
              <th>Nombre de tickets</th>
                </tr>
          <?php
                $requete = file_get_contents("sql/requests/stats/parkings_moins_utilises.sql");
                /* Si l'execution est reussie... */
                $res = pg_query($connection, $requete);
                $i = 0;
                if($res) {
                    /* ... on récupère un tableau stockant le résultat */
                      while ($parking =  pg_fetch_assoc($res)) {
                          echo "\t".'<tr><td>'.$i.'</td>';
                          echo '<td>'.$parking['nom_parking'].'</td>';
                          echo '<td>'.$parking['nombre_ticket'].'</td>';
                          echo '</tr>'."\n";
                          $i++;
                      }
                      /*liberation de l'objet requete:*/
                }
                  pg_free_result($res);
                  /*fermeture de la connexion avec la base*/
                  pg_close($connection);
          ?>
          </table>
      <div>
    </section>
   <?php include("template/footer.php"); ?>
 </body>
</html>
