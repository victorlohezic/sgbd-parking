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
   <h2 class="center">Tickets</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>ID Ticket</th>
              <th>Date Ticket</th>
              <th>Heure d'entrée</th>
              <th>Heure de sortie</th>
              <th>Numéro d'immatriculation</th>
              <th>ID Place</th>
                </tr>
          <?php
                $requete = file_get_contents("sql/requests/consultations/all_ticket.sql");
                /* Si l'execution est reussie... */
                $res = pg_query($connection, $requete);
                if($res) {
                    /* ... on récupère un tableau stockant le résultat */
                      while ($place =  pg_fetch_assoc($res)) {
                          echo "\t".'<tr><td>'.$place['id_ticket'].'</td>';
                          echo '<td>'.$place['date_ticket'].'</td>';
                          echo '<td>'.$place['heure_entree'].'</td>';
                          echo '<td>'.$place['heure_sortie'].'</td>';
                          echo '<td>'.$place['numero_immatriculation'].'</td>';
                          echo '<td>'.$place['id_place'].'</td>';
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
