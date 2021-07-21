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
      filters: [
        {
          key: 'featured',
          title: 'Dôležité',
          queryName: 'featured',
          queryValue: 1
        }
      ],
      posts: [],
      hasNextPage: true
    }
  },
  computed: {
    activeFilter () {
      if (this.$route.query.featured !== undefined) {
        return this.filters[0]
      }

      if (this.$route.query.categories) {
        return this.filters.find(({ queryValue }) => queryValue === this.$route.query.categories)
      }

      return {}
    },
    pageNumber () {
      return parseInt(this.$route.query.page || 1)
    }
  },
  watch: {
    $route (to, from) {
      if (to.query.featured !== from.query.featured ||
          to.query.categories !== from.query.categories ||
          to.query.page !== from.query.page
      ) {
        this.fetchPosts()
      }
    }
  },
  async created () {
    const { categories } = await this.axiosGet('posts-filters')
    for (const category in categories) {
      this.filters.push({
        key: category,
        title: category,
        queryName: 'categories',
        queryValue: category
      })
    }
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
          categories: filter.queryName === 'categories' ? filter.queryValue : undefined,
        }
      })
    },
    async fetchPosts () {
      const url = new URL('/posts', window.location.origin)
      url.searchParams.append('page', this.pageNumber)

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
