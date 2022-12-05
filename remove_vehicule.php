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
   <h2 class="center">Supprimer un vehicule</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
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
                      $id_vehicule = $_POST['submit'];
                      $sql = "DELETE from VEHICULE where NUMERO_IMMATRICULATION= '{$id_vehicule}';";
                      pg_query($connection, $sql);
                }
                $requete = file_get_contents("sql/requests/consultations/all_vehicule.sql");
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
                          echo '<td><form method="post" class="i col s8 offset-s2">
                          <div class="row">
                                        <div class="col s12">
                                            <button type="submit" name="submit" value='.$vehicule['numero_immatriculation'].' class="btn-jtb">
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </form></td>';
                          echo '</tr>'."\n";
                      }
                      /*liberation de l'objet requete:*/
                }
                  pg_free_result($res);
                  /*fermeture de la connexion avec la base*/
                  pg_close($connection);
          ?>
          </table>
          <br>
          <div class="row">
                    <div class="col s12 center">
                        <a href="/all_ticket.php" class="btn-jtb">
                              Voir tous les tickets
                        </a>
                      </div>
            </div>
      <div>
    </section>
   <?php include("template/footer.php"); ?>
 </body>
</html>

