# Projet de Base de Données

## Base de données
------------------------
### Installation de PostgreSQL
Les instructions sont les suivantes :
```bash
sudo apt update
sudo apt install postgresql postgresql-contrib
```

### Création de la base de données jtb
On se connecte à la session Postgres :
```
sudo -u postgres psql
```
On crée la base de données jtb :
```
postgres=# CREATE DATABASE jtb;
```

On ajoute un utilisateur :

```
postgres=# CREATE USER jtb WITH PASSWORD 'pwd_jtb';
```
On met à jour certaines caractéristiques de la base de données : 
```
postgres=# ALTER ROLE jtb SET client_encoding TO 'utf8';
postgres=# ALTER ROLE jtb SET default_transaction_isolation TO 'read committed';
postgres=# ALTER ROLE jtb SET timezone TO 'UTC';
```

On accorde les bons droits : 

```
postgres=# GRANT ALL PRIVILEGES ON DATABASE jtb TO jtb;
```

Pour voir si la base de données est crée : 
```
postgres=# \l
```

## Installation de PHP et Apache 2
-----------
```bash
sudo apt-get install php
```

Pour pouvoir se connecter à la base de données PostgreSQL :
```bash 
sudo apt-get install php-pgsql
```

Installation du seveur Apache 2 pour voir le site web : 
```bash
sudo apt-get install apache2
```

Voici quelques commandes qui peuvent être utiles :

- Pour lancer un script php et voir le résultat : 
    ```bash
    php -f file.php
    ```
- Pour relancer le serveur Apache 2 : 
    ```bash 
    sudo systemctl restart apache2
    ```

- Pour avoir des informations sur l'état du serveur :
    ```bash
    sudo systemctl status apache2
    ```

## Exécuter le projet
Il suffit d'exécuter `make.sh` avec le bon paramètre. Pour les connaître, écrivez : `make.sh help`. 
Les différents paramètres sont résumés dans ce tableau :
| Paramètre  |  Utilité |
| :--------------- | :-----|
| create  |     Crée la base de donnée |
| add_data  |   Ajoute des données à la base de donnée |
| select  |   Exécute les requêtes de sélection |
| website  |    Ouvre le site web |
| clean  |    Supprime la base de donnée |
| reset | reset : Réalise clean, create, add-data |