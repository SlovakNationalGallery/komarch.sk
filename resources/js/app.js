import Vue from 'vue'
import VueMapbox from 'vue-mapbox'
import Mapbox from 'mapbox-gl'
import vClickOutside from 'v-click-outside'
import { Lang } from 'laravel-vue-lang'

require('./bootstrap')

Vue.component('NavigationToggle', require('./components/NavigationToggle').default)
Vue.component('FilterListingPosts', require('./components/FilterListingPosts').default)
Vue.component('FilterListingTenders', require('./components/FilterListingTenders').default)
Vue.component('ArtworksMap', require('./components/ArtworksMap').default)
Vue.component('ButtonCopy', require('./components/atoms/buttons/ButtonCopy').default)
Vue.component('SwiperPosts', require('./components/SwiperPosts').default)
Vue.component('PostsOverview', require('./components/PostsOverview').default)
Vue.component('DocumentsOverview', require('./components/documents-overview/DocumentsOverview').default)
Vue.component('WorksOverview', require('./components/works-overview/WorksOverview').default)

Vue.use(VueMapbox, { mapboxgl: Mapbox })
Vue.use(Lang)
Vue.use(vClickOutside)

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  el: '#app'
})
