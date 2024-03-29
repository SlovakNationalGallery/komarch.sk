<template>
  <div>
    <div class="mt-24 md:flex flex-wrap">
      <radio-button
        v-for="filter in filters"
        :key="filter.key"
        :value="activeFilter"
        :disabled="fetchState.isFetching"
        :option="filter"
        name="filter"
        class="mr-12 py-2"
        @input="onFilterChange"
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

const staticFilters = []

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
      dynamicFilters: [],
      posts: [],
      hasNextPage: true
    }
  },
  computed: {
    activeFilter () {
      if (this.$route.query.categories) {
        return this.filters.find(({ queryValue }) => queryValue === this.$route.query.categories) || {}
      }

      return {}
    },
    pageNumber () {
      return parseInt(this.$route.query.page || 1)
    },
    filters () {
      return [...staticFilters, ...this.dynamicFilters]
    }
  },
  watch: {
    activeFilter (to, from) {
      if (to.key !== from.key) this.fetchPosts()
    },
    pageNumber () {
      this.fetchPosts()
    }
  },
  async created () {
    const { categories } = await this.axiosGet('posts-filters')
    this.dynamicFilters = Object.keys(categories).map(category => ({
      key: category,
      title: category,
      queryName: 'categories',
      queryValue: category
    }))
  },
  mounted () {
    this.fetchPosts()
  },
  methods: {
    onLoadMore () {
      this.$router.push({
        query: {
          ...this.$route.query,
          page: this.pageNumber + 1
        }
      })
    },
    onCancel () {
      this.$router.push({
        query: {
          ...this.$route.query,
          page: undefined,
          featured: undefined,
          categories: undefined
        }
      })
    },
    onFilterChange (filter) {
      this.$router.push({
        query: {
          ...this.$route.query,
          page: undefined,
          featured: filter.queryName === 'featured' ? null : undefined,
          categories: filter.queryName === 'categories' ? filter.queryValue : undefined
        }
      })
    },
    async fetchPosts () {
      const url = new URL('/posts', window.location.origin)
      url.searchParams.append('page', this.pageNumber)

      if (this.$route.query.search) {
        url.searchParams.append('q', this.$route.query.search)
      }

      if (this.activeFilter.queryName) {
        url.searchParams.append(this.activeFilter.queryName, this.activeFilter.queryValue)
      }

      const { data, meta } = await this.axiosGet(`posts${url.search}`)

      if (this.pageNumber === 1) {
        this.posts = data
      } else {
        this.posts.push(...data)
      }

      this.page = meta.current_page
      this.hasNextPage = meta.current_page < meta.last_page
    },
    getIsotopeOptions () {
      return {
        itemSelector: '[data-grid-item]',
        percentPosition: true
      }
    }
  }
}
</script>
