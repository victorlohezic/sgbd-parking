#!/bin/bash
export PGPASSWORD=pwd_jtb
nb_parameter=$(echo $@ | wc -w)

if [ $nb_parameter -eq 1 ]
then 
    case $1 in
        create)
            psql -h localhost -p 5432 -U jtb -f sql/create.sql 
        ;;
        add_data)
            psql -h localhost -p 5432 -U jtb -f sql/insert.sql 
        ;;
        select)
            psql -h localhost -p 5432 -U jtb -f sql/select.sql 
        ;;
        consult)
            psql -h localhost -p 5432 -U jtb -f sql/requests/consultations/consultation.sql 
        ;;
        stat)
            psql -h localhost -p 5432 -U jtb -f sql/requests/stats/stat.sql 
        ;;
        update)
            psql -h localhost -p 5432 -U jtb -f sql/update.sql 
        ;;
        website)
            sudo cp -r ./src/* /var/www/html/
            sudo cp -r ./sql /var/www/html/
            firefox http://localhost/index.php &
        ;;
        clean)
            psql -h localhost -p 5432 -U jtb -f sql/drop.sql 
        ;;
        reset)
            psql -h localhost -p 5432 -U jtb -f sql/drop.sql
            psql -h localhost -p 5432 -U jtb -f sql/create.sql
            psql -h localhost -p 5432 -U jtb -f sql/insert.sql
        ;;
        help)
            echo "create : Crée la base de donnée"
            echo "add_data : Ajoute des données à la base de donnée"
            echo "select : Exécute les requêtes de consultation et statistiques"
            echo "consult : Exécute les requêtes de consultation"
            echo "stat : Exécute les requêtes statistiques"
            echo "update : Exécute les requêtes de mide à jour"
            echo "website : Ouvre le site web"
            echo "clean : Supprime la base de donnée"
            echo "reset : Réalise clean, create, add-data"
        ;;
        *)
            echo "La commande est inconnue, pour obtenir de l'aide : ./make.sh help"
        ;;
    esac
elif [ $nb_parameter -eq 0 ]
then 
    echo "Presque, mais vous avez oubliez un paramètre !"
else 
    echo "Oups, il y a trop de paramètres !"
fi

# psql -h localhost -p 5432 -U jtb -f clean.sql