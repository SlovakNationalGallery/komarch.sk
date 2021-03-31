import Vue from 'vue';

Vue.component('navigation-toggle', require('./components/NavigationToggle').default);
Vue.component('filter-listing-tenders', require('./components/FilterListingTenders').default);

const app = new Vue({
    el: '#app'
})
