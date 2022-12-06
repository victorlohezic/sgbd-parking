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
    <h3 class="center">Requêtes spécifiques aux parkings</h3>
    <div class="container">
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a href="moyenne_nombre_place_par_parking.php" class="btn-jtb">Moyenne du nombre de places disponibles par parking</a>
            </div>
            <div class="col s3 center">
                <a href="duree_moyenne_stationnement_vehicule_par_parking.php" class="btn-jtb">Durée moyenne de stationnement d'un véhicule par parking</a>
            </div>
        </div>
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a href="parking_moins_utilises.php" class="btn-jtb">Classement des parkings les moins utilisés</a>
            </div>
            <div class="col s3 center">
                <a href="classement_parking_plus_rentable_commune_mois.php" class="btn-jtb">Classement des parkings les plus rentables par commune et par mois</a>
            </div>
        </div>
    </div>
    <br><br>
    <h3 class="center"> Requête spécifique aux Véhicules</h3>
    <div class="container">
        <div class="row">
            <div class="col s3 offset-s3 center">
                <a href="cout_moyen_stationnement_vehicule_mois.php" class="btn-jtb">Coûts moyen du stationnement d’un véhicule par mois</a>
            </div>
            <div class="col s3 center">
                <a href="moyenne_kilometrages_voitures_plus_tickets.php" class="btn-jtb">Moyenne des kilométrages des voitures ayant le plus de tickets</a>
            </div>
        </div>
    <br><br>
    <h3 class="center"> Requêtes spécifiques aux communes</h3>
        <div class="row">
        <div class="col s4 offset-s4 center">
                <a href="classement_commune_plus_demande_par_semaine.php" class="btn-jtb">Classement des communes les plus demandées par semaine</a>
            </div>
        </div>
    </div>
</div>
    <br><br>
   <?php include("template/footer.php"); ?>
</body>

</html>