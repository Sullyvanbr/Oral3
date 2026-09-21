<?php
namespace View;

//Class ViewHeader
class ViewHeader{
    //ATTRIBUTS
    private ?string $title;
    private ?string $linkScript;
    private ?string $buffer;

    //CONSTRUCTOR
    public function __construct(?string $title = "Nippon Map", ?string $linkScript = ''){
        $this->title = $title;
        $this->linkScript = $linkScript;
    }

    //METHOD
    //Méthode pour mettre en mémoire tampon un template HTML
    public function launchBuffer():self{
        ob_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $this->title ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;700&family=Noto+Sans:wght@400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./public/src/css/explorer.css">

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js" defer></script>
    <script src="<?php echo $this->linkScript ?>" defer></script>
</head>
<body>
    <header>
        <nav>
            <a href="<?php echo $_ENV['explorer'] ?>" class="nav-logo">
                <img src="./public/assets/img/Vector.svg" alt="Logo Nippon Map" />
                <span>Nippon <em>Map</em></span>
            </a>
            <ul class="nav-links" id="nav-liens">
                <li><a href="<?php echo $_ENV['explorer'] ?>" class="actif">Explorer</a></li>
                <li><a href="#">Itinéraires</a></li>
                <li><a href="#">Favoris</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Profil</a></li>
            </ul>

            <button class="burger" id="burger" onclick="toggleMenu()" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>
<?php
        $this->buffer = ob_get_clean();
        return $this;
    }

    //Method pour afficher le contenu de la mémoire tampon
    public function display():void{
        echo $this->buffer;
    }
}
