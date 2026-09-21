<?php
namespace Utils;

use PDO;

class Utils{
    //Connexion à la BDD
    //charset=utf8mb4 : nécessaire pour afficher correctement les emojis et le japonais
    public static function connect():PDO{
        return new PDO('mysql:host=127.0.0.1;port=3306;dbname=nippon_map;charset=utf8mb4','root','root',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}
