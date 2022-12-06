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
   <h2 class="center">Tickets</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
      <div class="container">
      <?php 
        include "connect.php";
        if(isset($_POST['submit'])){
          $id = $_POST['id'];
          $numero = $_POST['numero'];
          $id_place = $_POST['id_place'];
          $date = $_POST['date'];
          $time_entree = $_POST['time_entree'];
          $time_sortie = $_POST['time_sortie'];
          $sql = "insert into TICKET values ('{$id}', '{$date}', '{$time_entree}','{$time_sortie}', '{$numero}','{$id_place}');";
          pg_query($connection, $sql);
        }
      ?>
      <form method="post" class="i col s8 offset-s2">
        <div class="row">
                    <div class="input-field col s6">
                      <input name="id"  id="id" type="text" class="validate">
                      <label for="id">ID ticket</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="numero" id="numero" type="text" class="validate">
                      <label for="numero">Numero Immatriculation</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="id_place"  id="id_place" type="text" class="validate">
                      <label for="id_place">ID place</label>
                    </div>
                    <div class="input-field col s12">    
                      <input type="text" name="date" class="datepicker">
                    </div>
                    <div class="input-field col s12">  
                      <p>Heure d'entrée</p>    
                      <input type="text" name="time_entree" class="timepicker">
                    </div>                    
                    <div class="input-field col s12">  
                      <p>Heure de sortie</p>  
                      <input type="text" name="time_sortie" class="timepicker">
                    </div>
                  </div>
                      <div class="col s12">
                          <button type="submit" name="submit" class="btn-jtb">
                              Ajouter un ticket
                          </button>
                      </div>
                  </div>
              </form>
              <div class="row">
                    <div class="col s12 center">
                        <a href="/all_ticket.php" class="btn-jtb">
                              Voir tous les tickets
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
