<?php
namespace View;

use View\View;

class ViewExplorer extends View{
    //METHODS
    //Méthode qui met le HTML de la page Explorer en mémoire tampon
    public function launchBuffer():self{
        $places = $this->getData();

        ob_start();
?>
    <main>
        <section class="hero">
            <h1>Explore le Japon</h1>
            <p>Découvrez temples, nature et saveurs sur une carte interactive</p>
            <div class="carte-container">
                <div id="map"></div>
            </div>
        </section>

        <section class="suggestions">
            <h2>Suggestions de lieux</h2>
            <div class="grille">
<?php
                //Boucle d'affichage : seulement les lieux suggérés (is_suggested = 1)
                foreach($places as $row){
                    if($row['is_suggested']){
?>
                <a class="carte" href="#">
                    <div class="carte-image"><?= htmlspecialchars($row['emoji'] ?? '') ?></div>
                    <div class="carte-texte">
                        <h3><?= htmlspecialchars($row['name_place']) ?></h3>
                        <span><?= htmlspecialchars($row['japanese_name'] ?? '') ?> · <?= htmlspecialchars($row['category']) ?></span>
                    </div>
                </a>
<?php
                    }
                }
?>
            </div>
        </section>

        <!-- PHP fabrique le tableau JavaScript avec les lieux de la BDD. explorer.js l'utilise pour placer les marqueurs -->
        <script>
            const lieux = <?= json_encode($places, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?>;
        </script>
    </main>
<?php
        $this->setBuffer(ob_get_clean());
        return $this;
    }
}
