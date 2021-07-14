<template>
  <!-- TODO: Implement a nice spinner for loading state -->
  <div>
    <ContestsOverviewFilters
      v-model="selectedFilters"
      :filters="filters"
    />
    <InputSearch
      v-model="searchTerm"
      class="mt-16 md:mt-8 md:max-w-sm"
      :placeholder="__('documents.search_placeholder')"
    />
    <ContestsOverviewResults
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
import ContestsOverviewResults from './ContestsOverviewResults'
import ContestsOverviewFilters from './ContestsOverviewFilters'
import ButtonLoadMore from '../atoms/buttons/ButtonLoadMore'
import InputSearch from '../atoms/InputSearch'
import axiosGet from '../axiosGetMixin'

const FILTER_TYPOLOGIES = 'typologies'

export default {
  components: {
    InputSearch,
    ContestsOverviewFilters,
    ContestsOverviewResults,
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
        announcedAt: null,
        finishedAt: null,
        resultsPublishedAt: null,
        title: null
      },
      results: [],
      page: 1,
      hasNextPage: true
    }
  },
  computed: {
    filterParams () {
      const params = {
        typologies: this.selectedFilters.filter(filter => filter.type === FILTER_TYPOLOGIES).map(filter => filter.title)
      }

      if (this.sorting.title) {
        params.sortby = 'title'
        params.direction = this.sorting.title
      }

      if (this.sorting.announcedAt) {
        params.sortby = 'announced_at'
        params.direction = this.sorting.announcedAt
      }

      if (this.sorting.finishedAt) {
        params.sortby = 'finished_at'
        params.direction = this.sorting.finishedAt
      }

      if (this.sorting.resultsPublishedAt) {
        params.sortby = 'results_published_at'
        params.direction = this.sorting.resultsPublishedAt
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
      const [contestsResponse, filtersResponse] = await Promise.all([
        this.axiosGet('contests', this.filterParams),
        this.axiosGet('contests-filters', this.filterParams)
      ])

      const typologies = []

      for (const key in filtersResponse.typologies) {
        typologies.push({ key: key, title: key, items: filtersResponse.typologies[key], type: FILTER_TYPOLOGIES })
      }

      this.filters = {
        typologies
      }

      this.results = contestsResponse.data
      this.hasNextPage = contestsResponse.meta.current_page < contestsResponse.meta.last_page
    },
    async onLoadMore () {
      const params = {
        ...this.filterParams,
        page: this.page + 1
      }

      const contestsResponse = await this.axiosGet('contests', params)

      this.page = contestsResponse.meta.current_page
      this.hasNextPage = contestsResponse.meta.current_page < contestsResponse.meta.last_page
      this.results.push(...contestsResponse.data)
    }
  }
}
</script>
