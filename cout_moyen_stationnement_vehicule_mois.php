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
   <h2 class="center">Coûts moyen du stationnement d’un véhicule par mois</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
      <div class="row">
      <form method="post" class="i col s8 offset-s2">
                <div class="row">
                  <div class="input-field col s12">
                      <select name="numero_immatriculation">
                        <?php
                          $requete = "select distinct NUMERO_IMMATRICULATION from VEHICULE order by NUMERO_IMMATRICULATION";
                          /* Si l'execution est reussie... */
                          $res = pg_query($connection, $requete);
                            while ($row = pg_fetch_row($res)) {
                              echo "<option value=\"$row[0]\">$row[0]</option>";
                            }
                        ?>
                      </select>
                      <label>Choisir une plaque d'immaticulation</label>
                  </div>
                </div>
                    <div class="col s12">
                        <button type="submit" name="submit" class="btn-jtb">
                            Afficher le coût moyen par mois
                        </button>
                    </div>
                </div>
            </form>
    </div>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>Mois</th>
              <th>Année</th>
              <th>Moyenne coût des tickets</th>
                </tr>
          <?php
                  if(isset($_POST['submit'])){
                    $numero_immatriculation = $_POST['numero_immatriculation'];
                    $requete = "select date_part('month',DATE_TICKET) as mois, date_part('year',DATE_TICKET) as annee, avg(COUT) as moyenne_cout_des_tickets
                    from (select DATE_TICKET, TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600) as COUT
                        from PARKING
                        left outer join PLACE using (ID_PARKING)
                        left outer join TICKET using(ID_PLACE)
                        left outer join VEHICULE using(NUMERO_IMMATRICULATION) 
                        where NUMERO_IMMATRICULATION = '{$numero_immatriculation}' or ID_TICKET is null) as SUBQUERY
                        group by mois, annee;";
                    /* Si l'execution est reussie... */
                    $res = pg_query($connection, $requete);
                    if($res) {
                        /* ... on récupère un tableau stockant le résultat */
                        while ($req =  pg_fetch_assoc($res)) {
                          echo "\t".'<tr><td>'.$req['mois'].'</td>';
                          echo '<td>'.$req['annee'].'</td>';
                          echo '<td>'.$req['moyenne_cout_des_tickets'].'</td>';
                          echo '</tr>'."\n";
                      }
                          /*liberation de l'objet requete:*/
                    }
                      pg_free_result($res);
                  }
                  /*fermeture de la connexion avec la base*/
                  pg_close($connection);
          ?>
          </table>
      <div>
    </section>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('select');
          var instances = M.FormSelect.init(elems, {});
        });
      </script>
   <?php include("template/footer.php"); ?>
 </body>
</html>
