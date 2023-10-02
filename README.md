# Projet GSB - 2SIO (version examen)
## Technologies
PHP, CodeIgniter 4, Bootstrap 5,HTML 5 , CSS 3, SQL.

Accès vers la documentation : 
https://github.com/carolinejffr/gsb2sio/wiki

## Installation en local
### Instructions générales
* télécharger l'archive et placer son contenu à l'emplacement désiré (www, htdocs...).
* Créer la base de données avec les scripts du dossier sql.
* Modifier au besoin les fichiers de configuration de CodeIgniter pour coller à votre système. Par défaut, les login MySQL sont root/password.
### Spécificités pour Windows
#### WAMP
Il suffit ensuite de vous connecter à localhost et de naviguer jusqu'au dossier "public".
#### XAMPP
* Modifiez C:\xampp\php\php.ini (windows) et enlevez le point-virgule devant "extension=intl".
* Il suffit ensuite de vous connecter à localhost et de naviguer jusqu'au dossier "public".
### Spécificités pour Mac
#### MAMP  
Il est plus simple de configurer le site avec MAMP qu'avec XAMPP, car il n'y a pas besoin de compiler intl depuis son code source.  
* Placer le contenu du site dans le dossier htdocs de MAMP, situé dans le dossier application.  
* [Suivez ce lien](https://documentation.mamp.info/en/MAMP-Mac/FAQ/How-do-I-change-the-password-of-the-MySQL-root-user/) pour changer le mot de passe du compte root.
* Le site devrait fonctionner.
### Spécificités pour Linux
Les instructions suivantes peuvent changer selon la distribution que vous utilisez.
* Tout d'abord, installez l'extension intl `sudo apt install php-intl`
* Puis, modifier php.ini et enlevez le point-virgule devant "extension=intl".
* Lancez votre Lamp: `sudo systemctl start apache2` et `sudo systemctl start mysql`.
* Dans un terminal, naviguez à la racine du site. Vous devrez voir (avec ls par exemple) qu'il existe un fichier spark.
* Dans le même dossier que spark, faites `php spark serve`.
* Le site est accessible à localhost:8080.
