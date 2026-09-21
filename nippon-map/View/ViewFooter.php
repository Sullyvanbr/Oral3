<?php
namespace View;

class ViewFooter{
    //ATTRIBUT
    private ?string $buffer;

    //METHODS
    //methode de mise en mémoire tampon
    public function launchBuffer():self{
        ob_start();
?>
    <footer>
        <div class="footer-gauche">
            <div class="footer-logo">
                <img src="./public/assets/img/Vector.svg" alt="Logo" />
                <span>Nippon <em>Map</em></span>
            </div>
            <p class="footer-desc">Explorez le Japon à travers une carte interactive — temples, nature, villes et gastronomie.</p>
        </div>

        <div class="footer-liens">
            <h4>Plan du site</h4>
            <a href="#">Accueil</a>
            <a href="<?php echo $_ENV['explorer'] ?>">Explorer</a>
            <a href="#">Itinéraires</a>
            <a href="#">Favoris</a>
            <a href="#">Contact</a>
            <a href="#">À propos</a>
            <a href="#">Profil</a>
        </div>

        <div class="footer-liens">
            <h4>Légal</h4>
            <a href="#">Mentions légales</a>
            <a href="#">Confidentialité</a>
            <a href="#">CGU</a>
        </div>
    </footer>

    <div class="footer-bas">
        © 2026 Nippon Map — Tous droits réservés
    </div>
</body>
</html>
<?php
        $this->buffer = ob_get_clean();
        return $this;
    }

    //methode d'affichage du contenu HTML
    public function display():void{
        echo $this->buffer;
    }
}
