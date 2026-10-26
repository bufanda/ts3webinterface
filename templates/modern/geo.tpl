<div style="padding: 15px;">
    <h2 class="thead" style="margin-bottom: 0;">Geo Map - Aktive TeamSpeak Nutzer</h2>
    
    <div id="geo-map" style="width: 100%; height: 600px; border-radius: 8px; border: 1px solid var(--glass-border); background: var(--glass-bg); margin-top: 15px; position: relative; z-index: 1;">
        <!-- Leaflet map container -->
    </div>
    
    <div style="margin-top: 15px; font-size: 0.85rem; opacity: 0.7; padding: 10px; background: rgba(255,255,255,0.05); border-radius: 6px; border: 1px solid var(--glass-border);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: text-bottom; margin-right: 5px;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        <strong>Datenschutz-Hinweis:</strong> Zur Anzeige der Karte werden die aktuellen IP-Adressen der verbundenen Nutzer verarbeitet. Diese Daten werden serverseitig in anonymisierter Form (Hash-Verfahren) zwischengespeichert und <strong>nicht</strong> im Browser abgelegt oder dargestellt.
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
/* Überschreibe das Leaflet z-index verhalten für das Glas-Theme, damit Dropdowns der Navigation nicht von der Karte überdeckt werden */
.leaflet-container {
    z-index: 1 !important;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var clients = {$geo_clients_json};
    
{literal}
    // Initialisiere die Karte (Standard-Ansicht auf Deutschland zentriert, falls keine User da sind)
    var map = L.map('geo-map').setView([51.165691, 10.451526], 5);
    
    // Verwende kostenfreie OpenStreetMap Standard-Kacheln
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var markers = [];
    
    if (clients && clients.length > 0) {
        // Rotes Icon für TeamSpeak User
        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        clients.forEach(function(client) {
            if (client.lat && client.lon) {
                var marker = L.marker([client.lat, client.lon], {icon: redIcon}).addTo(map);
                
                // Tooltip (erscheint bei Mouse-Over)
                marker.bindTooltip("<strong style='color: #333; font-size: 14px;'>" + client.label + "</strong>", {
                    permanent: false, 
                    direction: 'top',
                    offset: [0, -30],
                    opacity: 0.9
                });
                
                markers.push(marker);
            }
        });
        
        // Auto-Zentrierung auf alle Marker
        if (markers.length > 0) {
            var group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds(), {padding: [50, 50], maxZoom: 12});
        }
    } else {
        // Keine geolokalisierten Clients online -> Info anzeigen
        var info = L.control({position: 'topright'});
        info.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'geo-info-box');
            div.innerHTML = '<div style="background: rgba(0,0,0,0.7); color: #fff; padding: 12px 15px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.2); font-weight: 500; font-size: 0.95rem; box-shadow: 0 4px 6px rgba(0,0,0,0.3);">Keine geolokalisierten Nutzer online</div>';
            return div;
        };
        info.addTo(map);
    }
{/literal}
});
</script>
