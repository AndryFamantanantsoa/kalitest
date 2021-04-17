KALITEST
=========
##### Pré-requis
- Php >= 7.2
- Mysql 5.7
- Composer

##### Installation et configuration
~~~ console
$ git clone https://github.com/AndryFamantanantsoa/kalitest.git
$ cd kalitest
$ composer install
~~~

##### Configurer de la base de données
1. Configurer `DATABASE_URL` dans le fichier `.env` à la base du projet en renseignant les bonnes informations pour la connexion à la base de données
`DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"`

2. Créer la base de données
~~~ console
$ bin/console doctrine:database:create 
~~~
3. Lancer la migration
~~~ console
$ bin/console doctrine:migrations:migrate 
~~~
    
##### Lancer le serveur local
~~~ console
$ php -S 0.0.0.0:8000 -t public/ 
~~~
    
Accéder à l'application sur [http://localhost:8000](http://localhost:8000)
