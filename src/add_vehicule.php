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
   <h2 class="center">Vehicules</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
      <div class="container">
      <?php 
        include "connect.php";
        if(isset($_POST['submit'])){
          $numero = $_POST['numero'];
          $marque = $_POST['marque'];
          $date = $_POST['date'];
          $kilometrage = $_POST['kilometrage'];
          $etat = $_POST['etat'];
          $sql = "insert into VEHICULE values ('{$numero}','{$marque}', '{$date}', '{$kilometrage}', '{$etat}');";
          pg_query($connection, $sql);
        }
      ?>
      <form method="post" class="i col s8 offset-s2">
        <div class="row">
                    <div class="input-field col s6">
                      <input name="numero" id="numero" type="text" class="validate">
                      <label for="numero">Numero Immatriculation</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="marque"  id="marque" type="text" class="validate">
                      <label for="marque">Marque</label>
                    </div>
                    <div class="input-field col s12">   
                      <p>Date de mise en circulation</p>
                      <input type="text" name="date" class="datepicker">
                    </div>
                    <div class="input-field col s6">
                      <input name="kilometrage"  id="kilometrage" type="text" class="validate">
                      <label for="kilometrage">Kilométrage</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="etat"  id="etat" type="text" class="validate">
                      <label for="etat">Etat</label>
                    </div>
                  </div>
                      <div class="col s12">
                          <button type="submit" name="submit" class="btn-jtb">
                              Ajouter un véhicule
                          </button>
                      </div>
                  </div>
              </form>
              <div class="row">
                    <div class="col s12 center">
                        <a href="/all_vehicule.php" class="btn-jtb">
                              Voir tous les véhicules
                        </a>
                      </div>
            </div>
      </div>
    </div>
    </section>
   <?php include("template/footer.php"); ?>
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
 </body>
</html>
