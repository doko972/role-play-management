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
## Arborescence du Projet

Voici une vue d'ensemble de l'organisation des fichiers dans ce projet :
- CARD-SYSTEM-PHP/
- ├── database/
- │ └── roleplay.sql
- ├── src/
- │ ├── card_marinas.php
- │ ├── card_spectres.php
- │ ├── card.php
- │ ├── dashboard.php
- │ ├── footer.php
- │ ├── forum.php
- │ ├── header.php
- │ ├── index.php
- │ ├── login.php
- │ ├── logout.php
- │ ├── marinas.php
- │ ├── news.php
- │ ├── saint.php
- │ ├── select_card_marinas.php
- │ ├── select_card_spectres.php
- │ ├── select_card.php
- │ ├── spectres.php
- │ ├── update_role.php
- │ ├── welcome.php
- │ ├── js/
- │ │ └── scripts.js
- │ │ └── toggleEdit.js
- │ │ └── toggleEditForm.js
- │ └── css/
- │ └── style.css
- ├── event/
- │ ├── event_1.php
- │ ├── footer.php
- │ ├── header.php
- ├── forum/
- │ ├── category.php
- │ ├── create_post.php
- │ ├── create_topic.php
- │ ├── delete_post.php
- │ ├── edit_post.php
- │ ├── footer.php
- │ ├── headerForum.php
- │ ├── post.php
- ├── img/
- ├── includes/
- │ ├── _config.php
- │ ├── _database.php
- │ ├── _functions.php
- │ ├── _registerAdd.php
- ├── register/
- │ ├── authenticate.php
- │ ├── footer.php
- │ ├── header.php
- │ ├── register_process.php
- │ ├── register.php
- │ ├── registerScript.php
- │ ├── registration_success.php
- ├── story/
- │ ├── story_marinas.php
- │ ├── story_spectres.php
- │ ├── submit_story.php
- ├── uploads/
- ├── docker-compose.yml
- ├── Dockerfile
- └── README.md

## Installation

1. Après avoir "Forké" le projet, Clonez ce dépôt sur votre machine locale :
   ```bash
   git clone https://github.com/'yourusername'/card-system-php.git

2. Accédez au répertoire du projet :
   ```bash
    cd app
    
3. Installez les dépendances Node.js pour Vite :
   ```bash
    npm install

5. Pour lancer vite et le sass :
   ```bash
    npm run dev

6. Construisez les fichiers CSS et JS avec Vite :
   ```bash
    npm run build

## Configuration de la Base de Données

Creez un nouvel utilisateur, et modifier les champs pour vous connecter dans "includes/_database.php",
puis importez le fichier "roleplay.sql" se trouvant dans la racine du projet : 

- $DB_HOST = 'db'; // your address ip - db = docker container
- $DB_NAME = 'roleplay'; // the database name
- $DB_USER = 'user'; // user name
- $DB_PWD = 'password'; // password

## Contribuer

Les contributions sont les bienvenues ! 
Veuillez suivre ces étapes pour contribuer :

1. Forkez le projet
2. Créez une nouvelle branche (`git checkout -b feature/nom-de-votre-fonctionnalité`)
3. Effectuez vos modifications
4. Envoyez vos changements (`git push origin feature/nom-de-votre-fonctionnalité`)
5. Créez une Pull Request

## Remerciements

Merci à Créative Formation de m'avoir apporté toutes ses nouvelles connaissances,
principalement à Guillaume et ses précieux cours !
