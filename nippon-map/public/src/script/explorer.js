// Leaflet
const carte = L.map('map').setView([36.5, 137], 5);

// Fond de carte
L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap © CARTO',
    maxZoom: 18
}).addTo(carte);

// La variable "lieux" est créée par PHP dans ViewExplorer (données de la BDD).
// Les noms sont ceux des colonnes : name_place, japanese_name, emoji, lat, lon, description
lieux.forEach(function(lieu) {
    // Icône : on utilise textContent (et pas de HTML en texte) pour éviter d'injecter du code
    const emoji = document.createElement('div');
    emoji.className = 'marqueur-emoji';
    emoji.textContent = lieu.emoji || '📍';

    const icone = L.divIcon({
        html: emoji,
        className: '',
        iconSize: [30, 30],
        iconAnchor: [15, 15],
        popupAnchor: [0, -18]
    });

    const marqueur = L.marker([lieu.lat, lieu.lon], { icon: icone, title: lieu.name_place }).addTo(carte);

    // Contenu de la popup
    const popup = document.createElement('div');
    popup.className = 'popup-contenu';

    const titre = document.createElement('h3');
    titre.textContent = (lieu.emoji || '') + ' ' + lieu.name_place + ' ';

    const jp = document.createElement('span');
    jp.className = 'popup-jp';
    jp.textContent = lieu.japanese_name || '';
    titre.appendChild(jp);

    const desc = document.createElement('p');
    desc.textContent = lieu.description || '';

    popup.appendChild(titre);
    popup.appendChild(desc);
    marqueur.bindPopup(popup);
});

// Menu burger
function toggleMenu() {
    const menu = document.getElementById('nav-liens');
    const burger = document.getElementById('burger');
    menu.classList.toggle('ouvert');
    burger.classList.toggle('ouvert');
}
