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
   <h2 class="center">Liste de voitures et leurs parking actuel</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>Numero d'immatriculation</th>
              <th>Nom parking<th>
                </tr>
          <?php
                $requete = "
                select NUMERO_IMMATRICULATION, NOM_PARKING as PARKING_ACTUEL
                from VEHICULE 
                left outer join TICKET using (NUMERO_IMMATRICULATION)
                left outer join PLACE using (ID_PLACE)
                left outer join PARKING using(ID_PARKING)
                where DATE_TICKET = NOW()::date and HEURE_SORTIE > NOW()::time
                union all
                select distinct on (NUMERO_IMMATRICULATION) NUMERO_IMMATRICULATION, Null as PARKING_ACTUEL
                from VEHICULE 
                left outer join TICKET using (NUMERO_IMMATRICULATION)
                left outer join PLACE using (ID_PLACE)
                left outer join PARKING using(ID_PARKING)
                EXCEPT
                select NUMERO_IMMATRICULATION, Null as PARKING_ACTUEL
                from VEHICULE
                left outer join TICKET using (NUMERO_IMMATRICULATION)
                left outer join PLACE using (ID_PLACE)
                left outer join PARKING using(ID_PARKING)
                where DATE_TICKET = NOW()::date and HEURE_SORTIE > NOW()::time;
                ";
                /* Si l'execution est reussie... */
                $res = pg_query($connection, $requete);
                if($res) {
                    /* ... on récupère un tableau stockant le résultat */
                      while ($vehicule =  pg_fetch_assoc($res)) {
                          echo "\t".'<tr><td>'.$vehicule['numero_immatriculation'].'</td>';
                          if ($vehicule['parking_actuel']) {
                            echo '<td>'.$vehicule['parking_actuel'].'</td>';
                          } else {
                            echo '<td>Garé sur aucun parking</td>';
                          }
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
