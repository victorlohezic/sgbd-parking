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
   <h2 class="center">Durée moyenne de stationnement d'un véhicule par parking</h2>
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
                            Afficher la durée moyenne de stationnement par parking
                        </button>
                    </div>
                </div>
            </form>
    </div>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>Id Parking</th>
              <th>Durée moyenne</th>
                </tr>
          <?php
                  if(isset($_POST['submit'])){
                    $numero_immatriculation = $_POST['numero_immatriculation'];
                    $requete = "select ID_PARKING, avg(DUREE)
                    from (select ID_PARKING, (HEURE_SORTIE-HEURE_ENTREE) as DUREE 
                        from PLACE 
                        left outer join TICKET using(ID_PLACE)
                        left outer join VEHICULE using(NUMERO_IMMATRICULATION) 
                        where NUMERO_IMMATRICULATION = '{$numero_immatriculation}' or ID_TICKET is null) as SUBQUERY
                        group by ID_PARKING;";
                    /* Si l'execution est reussie... */
                    $res = pg_query($connection, $requete);
                    if($res) {
                        /* ... on récupère un tableau stockant le résultat */
                        while ($req =  pg_fetch_assoc($res)) {
                          echo "\t".'<tr><td>'.$req['id_parking'].'</td>';
                          echo '<td>'.$req['avg'].'</td>';
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
