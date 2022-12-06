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
   <h2 class="center">Classement des communes les plus demandées par semaine</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
     <div class="row center">
      <div class="col s12 m6 offset-m3">
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <span class="card-title">Conseil</span>
            <p>Pour visualiser des données, choisir le jour '2020-12-30'.</p>
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
                </div>
                    <div class="col s12">
                        <button type="submit" name="submit" class="btn-jtb">
                            Afficher les communes
                        </button>
                    </div>
                </div>
            </form>
    </div>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>Id Communes</th>
              <th>Nom Communes</th>
              <th>Nombres de tickets vendus</th>
                </tr>
          <?php
                  if(isset($_POST['submit'])){
                    $date = $_POST['date'];
                    $date_after = date('Y-m-d', strtotime($date. ' + 7 days'));
                    $requete = "
                    select ID_COMMUNE, NOM_COMMUNE, count(ID_TICKET) as nb_tickets
                    from COMMUNE
                    left outer join PARKING using(ID_COMMUNE)
                    left outer join PLACE using(ID_PARKING)
                    left outer join TICKET using(ID_PLACE)
                    where (DATE_TICKET between '{$date}' and '{$date_after}') or ID_TICKET is null
                    group by ID_COMMUNE, NOM_COMMUNE
                    order by nb_tickets desc;";
                    /* Si l'execution est reussie... */
                    $res = pg_query($connection, $requete);
                    if($res) {
                      /* ... on récupère un tableau stockant le résultat */
                        while ($parking =  pg_fetch_assoc($res)) {
                            echo "\t".'<tr><td>'.$parking['id_commune'].'</td>';
                            echo '<td>'.$parking['nom_commune'].'</td>';
                            echo '<td>'.$parking['nb_tickets'].'</td>';
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
