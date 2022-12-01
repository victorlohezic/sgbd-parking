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
              <th>ID Parking</th>
              <th>Nom Parking</th>
              <th>Adresse</th>
              <th>Tarif horaire (€)</th>
              <th>ID Commune </th>
                </tr>
          <?php
                $requete = file_get_contents("sql/requests/consultations/all_parking.sql");
                /* Si l'execution est reussie... */
                $res = pg_query($connection, $requete);
                if($res) {
                    /* ... on récupère un tableau stockant le résultat */
                      while ($parking =  pg_fetch_assoc($res)) {
                          echo "\t".'<tr><td>'.$parking['id_parking'].'</td>';
                          echo '<td>'.$parking['nom_parking'].'</td>';
                          echo '<td>'.$parking['adresse_parking'].'</td>';
                          echo '<td>'.$parking['tarif_horaire'].'</td>';
                          echo '<td>'.$parking['id_commune'].'</td>';
                          echo '</tr>'."\n";
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
