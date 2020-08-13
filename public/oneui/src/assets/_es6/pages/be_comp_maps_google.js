/*
 *  Document   : be_comp_maps_google.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Google Maps Page
 */

// Gmaps.js, for more examples you can check out https://hpneo.github.io/gmaps/
class pageCompMapsGoogle {
    /*
     * Init Search Map functionality
     *
     */
    static initMapSearch() {
        if (jQuery('#js-map-search').length) {
            // Init Map
            let mapSearch = new GMaps({
                div: '#js-map-search',
                lat: 20,
                lng: 0,
                zoom: 2,
                scrollwheel: false
            });

            // When the search form is submitted
            jQuery('.js-form-search').on('submit', e => {
                let inputGroup = jQuery('.js-search-address').parent('.input-group');

                GMaps.geocode({
                    address: jQuery('.js-search-address').val().trim(),
                    callback: (results, status) => {
                        if ((status === 'OK') && results) {
                            let latlng = results[0].geometry.location;

                            mapSearch.removeMarkers();
                            mapSearch.addMarker({ lat: latlng.lat(), lng: latlng.lng() });
                            mapSearch.fitBounds(results[0].geometry.viewport);

                            inputGroup.siblings('.form-text').remove();
                        } else {
                            inputGroup.after('<div class="font-text text-danger text-center animated fadeInDown">Address not found!</div>')
                        }
                    }
                });

                return false;
            });
        }
    }

    /*
     * Init Satellite Map
     *
     */
    static initMapSat() {
        if (jQuery('#js-map-sat').length) {
            new GMaps({
                div: '#js-map-sat',
                lat: 0,
                lng: 0,
                zoom: 2,
                scrollwheel: false
            }).setMapTypeId(google.maps.MapTypeId.SATELLITE);
        }
    }

    /*
     * Init Terrain Map
     *
     */
    static initMapTer() {
        if (jQuery('#js-map-ter').length) {
            new GMaps({
                div: '#js-map-ter',
                lat: 0,
                lng: 0,
                zoom: 2,
                scrollwheel: false
            }).setMapTypeId(google.maps.MapTypeId.TERRAIN);
        }
    }

    /*
     * Init Overlay Map
     *
     */
    static initMapOverlay() {
        if (jQuery('#js-map-overlay').length) {
            new GMaps({
                div: '#js-map-overlay',
                lat: 37.7577,
                lng: -122.4376,
                zoom: 11,
                scrollwheel: false
            }).drawOverlay({
                lat: 37.7577,
                lng: -122.4376,
                content: '<div class="alert alert-warning text-center" style="width: 220px;"><h4 class="alert-heading mb-2">Message Title</h4><p class="font-size-sm mb-0">You can overlay messages on your maps!</p></div>'
            });
        }
    }

    /*
     * Init Markers Map
     *
     */
    static initMapMarkers() {
        if (jQuery('#js-map-markers').length) {
            new GMaps({
                div: '#js-map-markers',
                lat: 37.7577,
                lng: -122.4376,
                zoom: 11,
                scrollwheel: false
            }).addMarkers([
                {lat: 37.70, lng: -122.49, title: 'Marker #1', animation: google.maps.Animation.DROP, infoWindow: {content: '<strong>Marker #1</strong>'}},
                {lat: 37.76, lng: -122.46, title: 'Marker #2', animation: google.maps.Animation.DROP, infoWindow: {content: '<strong>Marker #2</strong>'}},
                {lat: 37.72, lng: -122.41, title: 'Marker #3', animation: google.maps.Animation.DROP, infoWindow: {content: '<strong>Marker #3</strong>'}},
                {lat: 37.78, lng: -122.39, title: 'Marker #4', animation: google.maps.Animation.DROP, infoWindow: {content: '<strong>Marker #4</strong>'}},
                {lat: 37.74, lng: -122.46, title: 'Marker #5', animation: google.maps.Animation.DROP, infoWindow: {content: '<strong>Marker #5</strong>'}}
            ]);
        }
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initMapSearch();
        this.initMapSat();
        this.initMapTer();
        this.initMapOverlay();
        this.initMapMarkers();
    }
}

// Initialize when page loads
jQuery(() => { pageCompMapsGoogle.init(); });
