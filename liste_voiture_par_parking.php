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
   <h2 class="center">Liste des voitures par parking</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
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
                </div>
                    <div class="col s12">
                        <button type="submit" name="submit" class="btn-jtb">
                            Afficher les voitures
                        </button>
                    </div>
                </div>
            </form>
    </div>
     <div class="row">
            <table class="col s8 m8 offset-s2 offset-m2">
                <tr>
              <th>Immatriculation</th>
              <th>Marque</th>
              <th>Date de mise en circulation</th>
              <th>Kilométrage</th>
              <th>Etat</th>
                </tr>
          <?php
                  if(isset($_POST['submit'])){
                    $nom = $_POST['name_parking'];
                    $requete = "select VEHICULE.*
                    from (((VEHICULE inner join TICKET using (NUMERO_IMMATRICULATION))
                        inner join PLACE using (ID_PLACE))
                            inner join PARKING using(ID_PARKING))
                            where nom_parking = '{$nom}';";
                    /* Si l'execution est reussie... */
                    $res = pg_query($connection, $requete);
                    if($res) {
                        /* ... on récupère un tableau stockant le résultat */
                        while ($vehicule =  pg_fetch_assoc($res)) {
                          echo "\t".'<tr><td>'.$vehicule['numero_immatriculation'].'</td>';
                          echo '<td>'.$vehicule['marque'].'</td>';
                          echo '<td>'.$vehicule['date_mise_en_circulation'].'</td>';
                          echo '<td>'.$vehicule['kilometrage'].'</td>';
                          echo '<td>'.$vehicule['etat'].'</td>';
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
