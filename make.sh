#!/bin/bash
export PGPASSWORD=pwd_jtb
nb_parameter=$(echo $@ | wc -w)

if [ $nb_parameter -eq 1 ]
then 
    case $1 in
        create)
           echo "pwd_jtb" | psql -h localhost -p 5432 -U jtb -f sql/create.sql 
        ;;
        add_data)
            psql -h localhost -p 5432 -U jtb -f sql/add_data.sql 
        ;;
        consult)
            psql -h localhost -p 5432 -U jtb -f sql/consultation.sql 
        ;;
        stat)
            psql -h localhost -p 5432 -U jtb -f sql/stat.sql 
        ;;
        update)
            psql -h localhost -p 5432 -U jtb -f sql/update.sql 
        ;;
        website)
            sudo cp -r ./* /var/www/html/
            firefox http://localhost/index.php &
        ;;
        clean)
            psql -h localhost -p 5432 -U jtb -f sql/clean.sql 
        ;;
        reset)
            psql -h localhost -p 5432 -U jtb -f sql/clean.sql
            echo "pwd_jtb" | psql -h localhost -p 5432 -U jtb -f sql/create.sql
            psql -h localhost -p 5432 -U jtb -f sql/add_data.sql
        ;;
        help)
            echo "create : Crée la base de donnée"
            echo "add_data : Ajoute des données à la base de donnée"
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