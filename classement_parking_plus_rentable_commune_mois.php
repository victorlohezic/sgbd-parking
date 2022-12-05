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
   <h2 class="center">Classement des parkings les plus rentables par commune et par mois</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
     <div class="row center">
      <div class="col s12 m6 offset-m3">
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <span class="card-title">Conseil</span>
            <p>Pour visualiser des données, choisir le jour '2020-12-30' et l'heure '19:49:27'.</p>
          </div>
        </div>
      </div>
    </div>
      <div class="row">
      <form method="post" class="i col s8 offset-s2">
                <div class="row">
                <div class="input-field col s12">
                      <select name="id_commune">
                        <?php
                          $requete = "select distinct ID_COMMUNE, NOM_COMMUNE from COMMUNE order by NOM_COMMUNE";
                          /* Si l'execution est reussie... */
                          $res = pg_query($connection, $requete);
                            while ($row = pg_fetch_row($res)) {
                              echo "<option value=\"$row[0]\">$row[1]</option>";
                            }
                        ?>
                      </select>
                      <label>Choisir une commune</label>
                  </div>
                  <div class="input-field col s12">    
                    <p>Mois</p>
                    <input type="text" name="date" class="datepicker">
                  </div>
                </div>
                    <div class="col s12">
                        <button type="submit" name="submit" class="btn-jtb">
                            Afficher les places
                        </button>
                    </div>
                </div>
            </form>
    </div>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>ID Place</th>
              <th>Numéro Place</th>
                </tr>
          <?php
                  if(isset($_POST['submit'])){
                    $date = $_POST['date'];
                    $month = substr($date, 5, 2);
                    $id_commune = $_POST['id_commune'];
                    $requete = "select ID_PARKING, NOM_PARKING, coalesce(sum(TARIF_HORAIRE*(date_part('hour', HEURE_SORTIE-HEURE_ENTREE) + date_part('minute', HEURE_SORTIE-HEURE_ENTREE)/60 + date_part('second', HEURE_SORTIE-HEURE_ENTREE)/3600)),0) as CHIFFRE_DAFFAIRE
                    from PARKING  
                    left outer join PLACE using(ID_PARKING) 
                    left outer join TICKET using (ID_PLACE)
                    where (date_part('month',DATE_TICKET)=11 and date_part('year',DATE_TICKET)=2020) or ID_TICKET is null
                    group by(ID_PARKING, NOM_PARKING)
                    having ID_COMMUNE='{$id_commune}'
                    order by CHIFFRE_DAFFAIRE desc;";
                    /* Si l'execution est reussie... */
                    $res = pg_query($connection, $requete);
                    if($res) {
                      /* ... on récupère un tableau stockant le résultat */
                        while ($place =  pg_fetch_assoc($res)) {
                            echo "\t".'<tr><td>'.$place['id_place'].'</td>';
                            echo '<td>'.$place['numero_place'].'</td>';
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
          var elems = document.querySelectorAll('.datepicker');
          var instances = M.Datepicker.init(elems, {format: 'yyyy-mm-dd', defaultDate: new Date(2020, 12, 30)});
        });
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.timepicker');
          var instances = M.Timepicker.init(elems, {twelveHour: false});
        });
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('select');
          var instances = M.FormSelect.init(elems, {});
        });
      </script>
   <?php include("template/footer.php"); ?>
 </body>
</html>
