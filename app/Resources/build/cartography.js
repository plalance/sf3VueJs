var map, infowindow, locations, autocomplete, settings;

console.log("Resources/build/cartography.js");

$(document).ready(function () {

    function initMap() {
        settings = {
            lat: 47.6425875,
            lng: 6.844186600000057,
            zoom: 8
        };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: settings.zoom,
            center: {lat: settings.lat, lng: settings.lng}
        });
        infowindow = new google.maps.InfoWindow({
            content: "No data available"
        });
        setMarkers(map);

        var options = {
            types: ['geocode']
        };
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('autocomplete')),
            options
        );
        autocomplete.addListener('place_changed', placeSearchResult);
    }
    initMap();
});

function setMarkers(map) {
    const url = Routing.generate('api_location_list');
    const iconUrl = ASSET_DIR + "images/map/";

    axios.get(url).then(function (response) {
        locations = JSON.parse(response.data);

        var iconFile = iconUrl + "default-marker.svg";

        for (var i = 0; i < locations.length; i++) {
            var loc = locations[i];
            var latLng = new google.maps.LatLng(loc.latitude, loc.longitude);
            if (loc.icon_for_google_map !== null && loc.icon_for_google_map !== '') {
                iconFile = iconUrl + loc.icon_for_google_map;
            } else {
                iconFile = iconUrl + "default-marker.svg";
            }
            var icon = {
                url: iconFile,
                scaledSize: new google.maps.Size(30, 30),
            };
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                id_location: loc.id,
                content: loc.events,
                name: loc.name,
                icon: icon,
                scaledSize: new google.maps.Size(50, 50)
            });
            google.maps.event.addListener(marker, 'click', showInfoWindow);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function showInfoWindow() {
    var evtUrl = Routing.generate('one_event');
    // this refers to marker instance
    var div = document.createElement('div');
    div.classList.add('infowindow');
    var ul = document.createElement('ul');
    div.appendChild(ul);
    var li = document.createElement('li');
    li.classList.add('infowindow__title');
    li.innerHTML = this.name;

    ul.append(li);
    for (var i = 0; i < this.content.length; i++) {
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.setAttribute('href', evtUrl+'/'+this.content[i].id);
        a.setAttribute('target', '_blank');
        li.appendChild(a);
        a.innerHTML = this.content[i].name;
        ul.append(li);
    }

    // var html = "<h3>"+this.content[0].name+"</h3>";
    infowindow.setContent(div);
    infowindow.open(map, this);
}

function placeSearchResult() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    var lng = place.geometry.location.lng();
    var addressName = place.formatted_address;
    // Remplir le formulaire avec les infos (lat et lng sont cachés de l'utilisateur)
    $('#location_latitude').val(lat);
    $('#location_longitude').val(lng);
    $('#location_addressName').val(addressName);


    M.updateTextFields();

    // Centrer la map sur ce que cherche l'utilisateur
    var myLatlng2 = new google.maps.LatLng(
        lat,
        lng
    );
    map.setCenter(myLatlng2);
}