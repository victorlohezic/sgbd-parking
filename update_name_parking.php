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
   <h2 class="center">Parkings</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
      <div class="container">
      <?php 
        include "connect.php";
        if(isset($_POST['submit'])){
          $old_name = $_POST['old_name'];
          $new_name = $_POST['new_name'];
          $sql = "CALL rename('{$old_name}', '{$new_name}');";
          pg_query($connection, $sql);
        }
      ?>
      <form method="post" class="i col s8 offset-s2">
                  <div class="row">
                    <div class="input-field col s12">
                        <select name="old_name">
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
                        <input name="new_name"  id="nom" type="text" class="validate">
                        <label for="new_name">Nouveau nom de parking</label>
                      </div>
                  </div>
                      <div class="col s12">
                          <button type="submit" name="submit" class="btn-jtb">
                              Modifier nom du parking
                          </button>
                      </div>
                  </div>
              </form>
              <div class="row">
                    <div class="col s12 center">
                        <a href="/all_parking.php" class="btn-jtb">
                              Voir tous les parkings
                        </a>
                      </div>
            </div>
      </div>
    </div>
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
