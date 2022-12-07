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
   <h2 class="center">Liste des parkings par communes</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
      <div class="row">
      <form method="post" class="i col s8 offset-s2">
                <div class="row">
                  <div class="input-field col s12">
                      <select name="name_commune">
                        <?php
                          $requete = "select distinct NOM_COMMUNE from COMMUNE order by NOM_COMMUNE";
                          /* Si l'execution est reussie... */
                          $res = pg_query($connection, $requete);
                            while ($row = pg_fetch_row($res)) {
                              echo "<option value=\"$row[0]\">$row[0]</option>";
                            }
                        ?>
                      </select>
                      <label>Choisir une commune</label>
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
              <th>Adresse</th>
              <th>Tarif horaire (€)</th>
              <th>ID Commune </th>
                </tr>
          <?php
                  if(isset($_POST['submit'])){
                    $nom = $_POST['name_commune'];
                    $requete = "select PARKING.*
                    from PARKING natural join COMMUNE where NOM_COMMUNE = '{$nom}';";
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
