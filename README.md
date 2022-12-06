# Projet de Base de Données

## Installation de la base de données PostgreSQL 
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

## Modification des fichiers du projet pour pouvoir utiliser sa propre base de données
### make.sh
Pour pouvoir utiliser le script shell, il est nécessaire de le modifier. A la deuxième ligne de celui-ci, vous devez indiquer le mot de passe de votre base de données : 
```bash
#!/bin/bash
export PGPASSWORD=VOTRE_MOT_DE_PASSE
...
```

### Site web
Pour pouvoir utiliser le site web, vous devez modifier le fichier suivant `src/connect.php` : 
```PHP
<?php
  $login = 'jtb';
  $db_pwd = 'pwd_jtb';
  /* Creation de l'objet qui gere la connexion: */
  $connection_string = "host=localhost port=5432 dbname=".$login." user=".$login." password=".$db_pwd;
  $connection = pg_connect($connection_string);
  if(!$connection) {
     echo 'error';
  }
?> 
```
Il suffit alors de modifier les deux premières lignes de la manière suivante :
```PHP
<?php
  $login = 'VOTRE_LOGIN';
  $db_pwd = 'VOTRE_MOT_DE_PASSE';
...
```

## Exécuter le projet
Il suffit d'exécuter `make.sh` avec le bon paramètre. 

Pour les connaître, écrivez : `./make.sh help` dans votre terminal. Il faut être à la racine du projet. 

Les différents paramètres sont résumés dans ce tableau :
| Paramètre  |  Utilité |
| :--------------- | :-----|
| create  |     Crée la base de donnée |
| add_data  |   Ajoute des données à la base de donnée |
| clean  |    Supprime la base de donnée |
| reset | Exécute clean, create et add_data |
| select  |   Exécute les requêtes de consultation et statistiques |
| consult  |   Exécute les requêtes de consultation |
| stat  |   Exécute les requêtes statistiques |
| website  |    Ouvre le site web |

Par exemple, vous pouvez lancer les requêtes d'exécutions de la manière suivante : 

```bash
./make.sh consult
```

Pour lancer le site web, il suffit d'écrire : 
```bash
./make.sh website
```