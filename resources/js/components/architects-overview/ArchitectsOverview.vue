<template>
  <!-- TODO: Implement a nice spinner for loading state -->
  <div>
    <ArchitectsOverviewFilters
      v-model="selectedFilters"
      :filters="filters"
    />
    <InputSearch
      v-model="searchTerm"
      class="mt-16 md:mt-8 md:max-w-sm"
      :placeholder="__('documents.search_placeholder')"
    />
    <ArchitectsOverviewResults
      v-model="sorting"
      :results="results"
    />
    <ButtonLoadMore
      v-if="hasNextPage"
      class="md:mt-24"
      @click="onLoadMore"
    />
  </div>
</template>

<script>
import ArchitectsOverviewResults from './ArchitectsOverviewResults'
import ArchitectsOverviewFilters from './ArchitectsOverviewFilters'
import ButtonLoadMore from '../atoms/buttons/ButtonLoadMore'
import InputSearch from '../atoms/InputSearch'
import axiosGet from '../axiosGetMixin'

const FILTER_AUTHORIZATIONS = 'authorizationsIn'

export default {
  components: {
    InputSearch,
    ArchitectsOverviewFilters,
    ArchitectsOverviewResults,
    ButtonLoadMore
  },
  mixins: [
    axiosGet
  ],
  props: {
    authorizationLabels: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      filters: {},
      selectedFilters: [],
      searchTerm: null,
      sorting: {},
      results: [],
      page: 1,
      hasNextPage: true
    }
  },
  computed: {
    filterParams () {
      return {
        authorizationsIn: this.selectedFilters.filter(filter => filter.type === FILTER_AUTHORIZATIONS).map(filter => filter.key),
        sortby: this.sorting.name,
        direction: this.sorting.direction,
        q: this.searchTerm
      }
    }
  },
  watch: {
    searchTerm () {
      const debounceTime = 300
      clearTimeout(this.searchTermDebounceTimeout)

      this.searchTermDebounceTimeout = setTimeout(() => {
        this.fetchData()
      }, debounceTime)
    },
    sorting () {
      this.fetchData()
    },
    selectedFilters () {
      this.fetchData()
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    async fetchData () {
      const [architectsResponse, filtersResponse] = await Promise.all([
        this.axiosGet('architects', this.filterParams),
        this.axiosGet('architects-filters', this.filterParams)
      ])

      const authorizationsIn = []

      for (const key in filtersResponse.authorizationsIn) {
        authorizationsIn.push({
          key: key,
          title: this.authorizationLabels[key] || key,
          items: filtersResponse.authorizationsIn[key],
          type: FILTER_AUTHORIZATIONS
        })
      }
      this.filters = {
        authorizationsIn
      }

      this.results = architectsResponse.data
      this.hasNextPage = architectsResponse.meta.current_page < architectsResponse.meta.last_page
    },
    async onLoadMore () {
      const params = {
        ...this.filterParams,
        page: this.page + 1
      }

      const architectsResponse = await this.axiosGet('architects', params)

      this.page = architectsResponse.meta.current_page
      this.hasNextPage = architectsResponse.meta.current_page < architectsResponse.meta.last_page
      this.results.push(...architectsResponse.data)
    }
  }
}
</script>
