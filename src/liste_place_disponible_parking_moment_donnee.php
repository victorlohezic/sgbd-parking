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
   <h2 class="center">Liste de places disponibles par parking à un moment donné</h2>
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
                      <select name="name_parking">
                        <?php
                          $requete = "select distinct NOM_PARKING from PARKING order by NOM_PARKING";
                          /* Si l'execution est reussie... */
                          $res = pg_query($connection, $requete);
                            while ($row = pg_fetch_row($res)) {
                              echo "<option value=\"$row[0]\">$row[0]</option>";
                            }
                        ?>
                      </select>
                      <label>Choisir un nom de parking</label>
                  </div>
                  <div class="input-field col s12"> 
                    <p>Date</p>   
                    <input type="text" name="date" class="datepicker">
                  </div>
                  <div class="input-field col s12">
                    <p>Heure</p>    
                    <input type="text" name="time" class="timepicker">
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
                    $time = $_POST['time'];
                    $parking = $_POST['name_parking'];
                    $requete = "select distinct ID_PLACE, NUMERO_PLACE
                    from PLACE
                    left outer join PARKING using(ID_PARKING)
                    where NOM_PARKING='{$parking}'
                    except
                    SELECT ID_PLACE, NUMERO_PLACE
                    from TICKET 
                    natural join PLACE
                    natural join PARKING
                    where DATE_TICKET = '{$date}' and HEURE_SORTIE > '{$time}' and NOM_PARKING='{$parking}';";
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
