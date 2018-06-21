var mymap, locations;

mymap = L.map('map').setView([47.6425875, 6.844186600000057], 8);
const urlLocationsAPI = Routing.generate('api_location_list');

// Définir emplacement des images de la librairie
L.Icon.Default.imagePath = globals.LEAFLET_IMAGE_PATH;

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token='+globals.MAPBOX_API_TOKEN, {
    // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'your.mapbox.access.token'
}).addTo(mymap);

var iconUrl = globals.IMG_DIR+'/map/';

var defaultIcon = L.Icon.extend({
    options: {
        iconUrl: iconUrl+'home-marker.svg',
        iconSize:     [38, 95],
        shadowSize:   [50, 64],
        iconAnchor:   [22, 94],
        shadowAnchor: [4, 62],
        popupAnchor:  [-3, -76]
    }
});

axios.get(urlLocationsAPI).then(function (response) {
    locations = JSON.parse(response.data);

    for (var i = 0; i < locations.length; i++) {
        var loc = locations[i];

        if (loc.icon_for_google_map !== null && loc.icon_for_google_map !== '') {
            var iconFile = iconUrl + loc.icon_for_google_map;
        } else {
            var iconFile = iconUrl + "default-marker.svg";
        }

        // Add marker
        var marker = L.marker([loc.latitude, loc.longitude],
            {
                icon: new defaultIcon({iconUrl: iconFile})
            }
        );
        generateInfoWindows(marker, loc);
    }
}).catch(function (error) {
    console.log(error);
});

function generateInfoWindows(marker, loc) {
    console.log(loc);

    var evtUrl = Routing.generate('one_event');
    // this refers to marker instance
    var div = document.createElement('div');
    div.classList.add('infowindow');
    var ul = document.createElement('ul');
    div.appendChild(ul);
    var li = document.createElement('li');
    li.classList.add('infowindow__title');
    li.innerHTML = loc.name;

    ul.append(li);
    for (var i = 0; i < loc.events.length; i++) {
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.setAttribute('href', evtUrl+'/'+loc.events[i].id);
        a.setAttribute('target', '_blank');
        li.appendChild(a);
        a.innerHTML = loc.events[i].name;
        ul.append(li);
    }

    var popup = L.popup();
    popup.setContent(div);

    marker.bindPopup(popup);
    marker.addTo(mymap);
}