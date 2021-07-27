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
  data () {
    return {
      filters: {},
      selectedFilters: [],
      searchTerm: null,
      sorting: {
        last_name: null,
        first_name: null,
        location_city: null,
        works_count: null,
        awards_count: null,
        contests_count: null
      },
      results: [],
      page: 1,
      hasNextPage: true
    }
  },
  computed: {
    filterParams () {
      const params = {
        authorizationsIn: this.selectedFilters.filter(filter => filter.type === FILTER_AUTHORIZATIONS).map(filter => filter.title),
      }

      if (this.sorting.last_name) {
        params.sortby = 'last_name'
        params.direction = this.sorting.last_name
      }

      if (this.sorting.first_name) {
        params.sortby = 'first_name'
        params.direction = this.sorting.first_name
      }

      if (this.sorting.location_city) {
        params.sortby = 'location_city'
        params.direction = this.sorting.location_city
      }

      if (this.sorting.works_count) {
        params.sortby = 'works_count'
        params.direction = this.sorting.works_count
      }

      if (this.sorting.awards_count) {
        params.sortby = 'awards_count'
        params.direction = this.sorting.awards_count
      }

      if (this.sorting.contests_count) {
        params.sortby = 'contests_count'
        params.direction = this.sorting.contests_count
      }

      if (this.searchTerm) {
        params.q = this.searchTerm
      }

      return params
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
        authorizationsIn.push({ key: key, title: key, items: filtersResponse.authorizationsIn[key], type: FILTER_AUTHORIZATIONS })
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
