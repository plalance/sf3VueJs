<template>
    <div class="google-map" :id="mapName"></div>
</template>
<script>
    export default {
        name: 'google-map',
        props: {
            name: '',
            markerCoordinates: {},
            zoom: {
                default: 8,
                type: Number
            }
        },
        data: function () {
            return {
                mapName: this.name + "-map",
                map: null,
                bounds: null,
                markers: []
            }
        },
        mounted: function () {
            if (navigator.geolocation) {
                // L'API est disponible
            } else {
                // Pas de support, proposer une alternative ?
            }

            this.bounds = new google.maps.LatLngBounds();
            const element = document.getElementById(this.mapName)
            const mapCentre = this.markerCoordinates[0]
            const options = {
                center: new google.maps.LatLng(mapCentre.latitude, mapCentre.longitude),
                zoom: this.zoom
            };
            this.map = new google.maps.Map(element, options);
            this.markerCoordinates.forEach((coord) => {
                const position = new google.maps.LatLng(coord.latitude, coord.longitude);
                const marker = new google.maps.Marker({
                    position,
                    map: this.map
                });
                this.markers.push(marker)
                // this.map.fitBounds(this.bounds.extend(position))
            });
        }
    };
</script>

<style scoped>
    .google-map {
        width: 100%;
        height: 450px;
        margin: 0 auto;
        background: gray;
    }
</style>