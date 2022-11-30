<html>
<script src="js/consultation.js"></script>
 <?php // Bloc PHP qui permet de spécifier une erreur sur la page
 // Intéressant notamment lors d'erreurs 500 peu précises
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);

 ?>
 <?php include("template/header.php"); ?>
 <body>
   <?php include("template/navbar.php"); ?>
   <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
    ?>
    <div class="section no-pad-bot" id="index-banner">
            <div class="container">
            <br><br>
                <h1 class="header center orange-text">JTB Parking</h1>
                <div class="row center">
                    <h5 class="header col s12 light">Un gestionnaire de Parking OpenSource et Libre</h5>
                </div>
            </div>
        </div>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a onClick="window.open('all_commune.php')" class="btn-jtb"> Communes </a>
            </div>
            <div class="col s3 center">
                <a onClick="window.open('all_parking.php')" class="btn-jtb"> Parkings </a>
            </div>
        </div>
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a onClick="window.open('all_vehicule.php')" class="btn-jtb"> Vehicules </a>
            </div>
            <div class="col s3 center">
                <a onClick="window.open('all_place.php')" class="btn-jtb"> Places </a>
            </div>
        </div>
    </div>
    <br><br>

   <?php include("template/footer.php"); ?>



</body>

</html>