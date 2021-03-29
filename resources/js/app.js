import Vue from 'vue';

Vue.component('navigation-toggle', require('./components/NavigationToggle').default);

const app = new Vue({
    el: '#app'
})
