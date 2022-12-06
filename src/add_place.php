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
   <h2 class="center">Places</h2>
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
          $id_parking = $_POST['id_parking'];
          $sql = "insert into PLACE values ('{$id}', '{$numero}', '{$id_parking}');";
          pg_query($connection, $sql);
        }
      ?>
      <form method="post" class="i col s8 offset-s2">
        <div class="row">
                    <div class="input-field col s6">
                      <input name="id"  id="nom" type="text" class="validate">
                      <label for="nom">ID place</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="numero" id="numero" type="text" class="validate">
                      <label for="numero">Numero Place</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="id_parking"  id="id_parking" type="text" class="validate">
                      <label for="id_parking">ID parking</label>
                    </div>
                  </div>
                      <div class="col s12">
                          <button type="submit" name="submit" class="btn-jtb">
                              Ajouter une place
                          </button>
                      </div>
                  </div>
              </form>
              <div class="row">
                    <div class="col s12 center">
                        <a href="/all_place.php" class="btn-jtb">
                              Voir toutes les places
                        </a>
                      </div>
            </div>
      </div>
    </div>
    </section>
   <?php include("template/footer.php"); ?>
 </body>
</html>
