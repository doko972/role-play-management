# Projet Fils rouge dans le cadre de ma formation Développeur Web et Web mobile

Ce projet est une application web développée en PHP, utilisant Vite pour la gestion des ressources JavaScript et Sass pour le CSS. 
L'application utilise une base de données SQL (nommée `roleplay.sql` que vous trouverez à la racine du projet) 
pour stocker les données et est facilement déployable à l'aide de Docker Compose. 

● Langages de programmation (JavaScript ES6+, PHP 8.1)
● Frameworks (vite, composer)
● Serveur web (phpMyAdmin, Apache)
● Conteneurisation (Docker Compose)


## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants :

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Node.js](https://nodejs.org/) avec npm (pour utiliser Vite)
- [Github](https://github.com/) (pour cloner le dépôt)


# LAMP ENVIRONMENT
## BUILD AND RUN
1. Assurez-vous que Docker et Docker Compose sont installés et en cours d'exécution.

2. Lancez les conteneurs Docker en utilisant la commande suivante :
```sh
docker-compose up -d
```

3. L'application sera accessible via http://localhost:8000.

    Le service 'PHP' est exposé sur le port 8000.
    Le service 'MySQL' est accessible sur le port 3306 avec les identifiants définis dans le fichier docker-compose.yml.


# Docker Compose
```sh
## fichier docker-compose.yml :
services:
  ## Service PHP with Apache
  php-apache:
    build:
      context: .
      dockerfile: Dockerfile
    restart: always
    volumes:
      - ./app:/var/www/html
    ports:
      - "8080:80"
    environment:
      APACHE_RUN_USER: www-data
      APACHE_RUN_GROUP: www-data
      APACHE_LOG_DIR: /var/log/apache2
      APACHE_RUN_DIR: /var/run/apache2
      APACHE_LOCK_DIR: /var/lock/apache2
      PHP_ROOT_DIR: /var/www/html
    working_dir: /var/www/html

 ## Service MySQL
  db:
    image: mysql:8.0
    command: --default-authentication-plugin=mysql_native_password
    restart: always
    volumes:
      - db_data:/var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_DATABASE: database
      MYSQL_USER: db_user
      MYSQL_PASSWORD: db_password

  ## Service PHPMyAdmin
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    restart: always
    ports:
      - "8181:80"
    depends_on:
      - db
    environment:
      PMA_HOST: db
      MYSQL_ROOT_PASSWORD: root_password

volumes:
  db_data: {}
```
-------------
Create a roleplay database and import "roleplay.sql" (show in app folder).
