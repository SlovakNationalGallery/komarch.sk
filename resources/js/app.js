require('./bootstrap');

import Vue from 'vue';
import VueMapbox from "vue-mapbox";
import Mapbox from "mapbox-gl";

Vue.component('navigation-toggle', require('./components/NavigationToggle').default);
Vue.component('filter-listing-posts', require('./components/FilterListingPosts').default);
Vue.component('filter-listing-tenders', require('./components/FilterListingTenders').default);
Vue.component('artworks-map', require('./components/ArtworksMap').default);
Vue.component('button-copy', require('./components/atoms/ButtonCopy').default);
Vue.component('swiper-posts', require('./components/SwiperPosts').default);

Vue.use(VueMapbox, { mapboxgl: Mapbox });

const app = new Vue({
    el: '#app'
})
