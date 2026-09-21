<?php
namespace Model;

use Model\Model;
use PDO;
use Exception;

class ModelPlace extends Model{
    //ATTRIBUTS
    private ?int $id;
    private ?string $name;
    private ?string $japaneseName;
    private ?string $emoji;
    private ?string $category;
    private ?string $lat;
    private ?string $lon;
    private ?string $description;
    private ?bool $isSuggested;

    //METHODS
    //Récupère tous les lieux (la carte les affiche tous, les suggestions sont ceux avec is_suggested = 1)
    public function findAll():?array{
        try{
            //1. Préparer la requête
            $req = $this->getBDD()->prepare('SELECT id_place, name_place, japanese_name, emoji, category, lat, lon, `description`, is_suggested FROM places ORDER BY name_place');

            //2. Exécution de la requête
            $req->execute();

            //3. Retourner les données
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $error){
            die($error->getMessage());
        }
    }
}
