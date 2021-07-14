import Vue from 'vue'
import VueMapbox from 'vue-mapbox'
import Mapbox from 'mapbox-gl'
import vClickOutside from 'v-click-outside'
import { Lang } from 'laravel-vue-lang'

require('./bootstrap')

Vue.component('NavigationToggle', require('./components/NavigationToggle').default)
Vue.component('FilterListingPosts', require('./components/FilterListingPosts').default)
Vue.component('FilterListingTenders', require('./components/FilterListingTenders').default)
Vue.component('WorksMap', require('./components/WorksMap').default)
Vue.component('ButtonCopy', require('./components/atoms/buttons/ButtonCopy').default)
Vue.component('SwiperPosts', require('./components/SwiperPosts').default)
Vue.component('PostsOverview', require('./components/PostsOverview').default)
Vue.component('DocumentsOverview', require('./components/documents-overview/DocumentsOverview').default)
Vue.component('ContestsOverview', require('./components/contests-overview/ContestsOverview').default)
Vue.component('WorksOverview', require('./components/works-overview/WorksOverview').default)
Vue.component('ImageGallery', require('./components/ImageGallery').default)
Vue.component('Clock', require('./components/Clock').default)

Vue.use(VueMapbox, { mapboxgl: Mapbox })
Vue.use(Lang)
Vue.use(vClickOutside)

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  el: '#app'
})
