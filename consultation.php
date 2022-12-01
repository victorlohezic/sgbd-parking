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
    <br></br>
    <h3 class="center"> Données brutes de la BDD </h3>
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
        <div class="row">
            <div class="col s6 offset-s3 center">
                <a onClick="window.open('all_ticket.php')" class="btn-jtb"> Tickets </a>
            </div>
        </div>  
    </div>
    <br><br>
    <h3 class="center"> Requêtes spécifiques aux parkings</h3>
    <div class="container">
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a onClick="window.open('places_par_parking.php')" class="btn-jtb"> Nombre de places par parking </a>
            </div>
            <div class="col s3 center">
                <a onClick="window.open('communes_par_parking.php')" class="btn-jtb"> Nom de commune par parking </a>
            </div>
        </div>
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a onClick="window.open('liste_voiture_par_parking.php')" class="btn-jtb">Liste des voitures par parking</a>
            </div>
            <div class="col s3 center">
                <a onClick="window.open('liste_parking_par_commune.php')" class="btn-jtb">Liste des parkings par communes</a>
            </div>
        </div>
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a onClick="window.open('liste_place_disponible_parking_moment_donnee.php')" class="btn-jtb">Liste des places disponibles par parking, à un moment donnée</a>
            </div>
            <div class="col s3 center">
                <a onClick="window.open('liste_parking_sature.php')" class="btn-jtb">Liste des parkings qui sont saturés à un jour donnée</a>
            </div>
        </div>
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a onClick="window.open('nombre_place_disponible_parking_moment_donnee.php')" class="btn-jtb">Nombre de place disponibles par parking à un moment donnée</a>
            </div>
        </div>
    <br><br>
    <h3 class="center"> Requêtes spécifiques aux voitures</h3>
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a onClick="window.open('voiture_deux_parkings.php')" class="btn-jtb"> Véhicules s'étant stationnés deux fois en un jour</a>
            </div>
            <div class="col s3 center">
                <a onClick="window.open('voitures_par_parkings.php')" class="btn-jtb"> Liste de voitures et leurs parking actuel</a>
            </div>
        </div>
    </div>
</div>
    <br><br>

   <?php include("template/footer.php"); ?>



</body>

</html>