<!DOCTYPE html>
<html lang="en">

<?php include("template/header.php"); ?>

<body>
  <?php include("template/navbar.php"); ?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">JTB Parking</h1>
      <div class="row center">
        <h5 class="header col s12 light">Un gestionnaire de Parking OpenSource et Libre</h5>
      </div>
      <div class="row center">
        <a href="http://materializecss.com/getting-started.html" id="download-button"
          class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <a href="create.php" 
              class="btn-large waves-effect waves-light light-blue">Créer la base de données</a>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="icon-block">
            <a href="add_data.php" class="btn-large waves-effect waves-light light-blue">Ajouter des données</a>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="icon-block">
            <a href="remove.php" class="btn-large waves-effect waves-light light-blue">Supprimer des données</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12 m4">
        <div class="icon-block">
          <a href="consult.php"
            class="btn-large waves-effect waves-light light-blue">Consulter les communes</a>
        </div>
      </div>
    </div>
  </div>
    <br><br>
  </div>
  <?php include("template/footer.php"); ?>


</body>

</html>