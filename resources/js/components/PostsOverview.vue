<template>
  <div>
    <div class="mt-24 md:flex flex-wrap">
      <radio-button
        v-for="filter in filters"
        :key="filter.key"
        v-model="activeFilter"
        :disabled="fetchState.isFetching"
        :option="filter"
        class="mr-12 py-2"
      />
    </div>
    <div class="h-10 md:h-20">
      <ButtonClearFilters
        v-show="activeFilter.key"
        @click="onCancel"
      />
    </div>
    <isotope :options="getIsotopeOptions()" :list="posts" class="lg:-mx-3">
      <TeaserPostBig
        v-for="post in posts"
        :key="post.id"
        :post="post"
        class="lg:w-1/3 lg:p-3 mt-12"
        data-grid-item
      />
    </isotope>
    <p
      v-if="posts.length === 0"
      class="py-10"
    >
      {{ __('posts.no_posts') }}.
    </p>
    <ButtonLoadMore
      v-if="hasNextPage"
      @click="onLoadMore"
    />
  </div>
</template>

<script>
import RadioButton from './atoms/RadioButton'
import TeaserPostBig from './TeaserPostBig'
import ButtonLoadMore from './atoms/buttons/ButtonLoadMore'
import ButtonClearFilters from './atoms/buttons/ButtonClearFilters'
import axiosGet from './axiosGetMixin'
import isotope from 'vueisotope'

export default {
  components: {
    ButtonClearFilters,
    ButtonLoadMore,
    RadioButton,
    TeaserPostBig,
    isotope
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: [],
      activeFilter: {},
      posts: [],
      page: 1,
      hasNextPage: true
    }
  },
  watch: {
    activeFilter: {
      immediate: true,
      handler () {
        this.fetchPage(1)
      }
    }
  },
  // TODO: refactor using proper axios parameters
  async created () {
    const { categories } = await this.axiosGet('posts-filters')

    const importantFilter = { key: 'Dôležité', title: 'Dôležité', params: '&featured' }

    const filters = [
      importantFilter
    ]

    for (const key in categories) {
      if (key !== importantFilter.key) {
        filters.push({ key: key, title: key, params: `&categories=${key}` })
      }
    }

    this.filters = filters
  },
  methods: {
    onLoadMore () {
      this.fetchPage(this.page + 1)
    },
    onCancel () {
      this.activeFilter = {}
    },
    async fetchPage (pageNumber) {
      const { data, meta } = await this.axiosGet(`posts?page=${pageNumber}${this.activeFilter.params || ''}`)

      if (pageNumber === 1) {
        this.posts = data
      } else {
        this.posts.push(...data)
      }

      this.page = meta.current_page
      this.hasNextPage = meta.current_page < meta.last_page
    },
    getIsotopeOptions() {
      return {
        itemSelector: '[data-grid-item]',
        percentPosition: true,
      };
    },
  }
}
</script>
