import Vue from 'vue';

Vue.component('navigation-toggle', require('./components/NavigationToggle').default);
Vue.component('filter-listing-ska', require('./components/FilterListingSka').default);
Vue.component('filter-listing-tenders', require('./components/FilterListingTenders').default);
Vue.component('artworks-map', require('./components/ArtworksMap').default);

const app = new Vue({
    el: '#app'
})
