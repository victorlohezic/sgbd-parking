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
   <h2 class="center">Communes</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
     ?>
     <section>
      <div class="container">
      <?php 
        include "connect.php";
        if(isset($_POST['submit'])){
          $id = $_POST['id'];
          $name = $_POST['name'];
          $code = $_POST['code'];
          $sql = "insert into COMMUNE values ('{$id}', '{$name}', '{$code}');";
          pg_query($connection, $sql);
        }
      ?>
      <form method="post" class="i col s8 offset-s2">
                  <div class="row">
                    <div class="input-field col s6">
                      <input name="id"  id="id" type="text" class="validate">
                      <label for="id">ID commune</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="name"  id="nom" type="text" class="validate">
                      <label for="nom">Nom commune</label>
                    </div>
                    <div class="input-field col s6">
                      <input name="code" id="code" type="text" class="validate">
                      <label for="code">Code commune</label>
                </div>
                  </div>
                      <div class="col s12">
                          <button type="submit" name="submit" class="btn-jtb">
                              Ajouter une commune
                          </button>
                      </div>
                  </div>
              </form>
              <div class="row">
                    <div class="col s12 center">
                        <a href="/all_commune.php" class="btn-jtb">
                              Voir toutes les communes
                        </a>
                      </div>
            </div>
      </div>
    </div>
    </section>
   <?php include("template/footer.php"); ?>
 </body>
</html>
