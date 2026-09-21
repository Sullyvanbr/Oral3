# Nippon Map (MVC)

1. Placer le dossier `nippon-map` dans le dossier du serveur (htdocs / www).
   Si le dossier a un autre nom, changer `RewriteBase` dans `.htaccess` et `$_ENV['explorer']` dans `env.php`.
2. Dans un terminal ouvert dans le projet : `composer install`
3. Importer `script.sql` puis `scriptPlace.sql` dans MySQL.
4. Adapter les identifiants dans `Utils/Utils.php`.
5. Ouvrir http://localhost/nippon-map/  (avec MAMP : http://localhost:8888/nippon-map/)
