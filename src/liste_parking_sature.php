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
   <h2 class="center">Liste des parkings qui sont saturés à un jour donnée</h2>
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
                    <input type="text" name="date" class="datepicker">
                  </div>
                  <div class="input-field col s12">    
                    <input type="text" name="time" class="timepicker">
                  </div>
                </div>
                    <div class="col s12">
                        <button type="submit" name="submit" class="btn-jtb">
                            Afficher les parkings
                        </button>
                    </div>
                </div>
            </form>
    </div>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>ID Parking</th>
              <th>Nom Parking</th>
                </tr>
          <?php
                  if(isset($_POST['submit'])){
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $requete = "select P.ID_PARKING, P.NOM_PARKING, count(*) - (
                      SELECT count(*)
                      from TICKET 
                      natural join PLACE
                      natural join PARKING
                      where DATE_TICKET = '{$date}' and HEURE_SORTIE > '{$time}' and ID_PARKING=P.ID_PARKING
                  ) as NOMBRE_PLACE_PARKING
                  from PLACE
                  right outer join PARKING P
                  on PLACE.ID_PARKING = P.ID_PARKING
                  group by P.NOM_PARKING, P.ID_PARKING;";
                    /* Si l'execution est reussie... */
                    $res = pg_query($connection, $requete);
                    if($res) {
                      /* ... on récupère un tableau stockant le résultat */
                        while ($parking =  pg_fetch_assoc($res)) {
                            echo "\t".'<tr><td>'.$parking['id_parking'].'</td>';
                            echo '<td>'.$parking['nom_parking'].'</td>';
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
      </script>
   <?php include("template/footer.php"); ?>
 </body>
</html>
