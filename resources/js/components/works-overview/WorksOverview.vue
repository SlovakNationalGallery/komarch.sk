<template>
  <div>
    <WorksOverviewFilters
      v-model="selectedFilters"
      :filters="filters"
    />
    <div class="md:flex flex-wrap items-center">
      <div class="flex-1 md:max-w-sm">
        <div class="mb-6">
          {{ `${__('works.realisation_year')}:` }}
        </div>
        <RangeSlider
          v-model="yearRange"
          :min="minYear"
          :max="maxYear"
        />
      </div>
      <InputSearch
        v-model="searchTerm"
        class="mt-16 md:mt-8 pb-1 md:ml-24 md:max-w-sm flex-1"
        :placeholder="__('works.search_placeholder')"
      />
    </div>
    <div class="h-24 flex items-center">
      <ButtonClearFilters
        v-show="areFiltersApplied"
        class="mt-4"
        @click="onClearFilters"
      />
    </div>
    <WorksOverviewResults
      v-model="sorting"
      :results="results"
      :total="total"
    />
    <p
      v-if="results.length === 0"
      class="py-10"
    >
      {{ __('works.no_works') }}.
    </p>
    <ButtonLoadMore
      v-if="hasNextPage"
      class="md:mt-24"
      @click="onLoadMore"
    />
  </div>
</template>

<script>
import axiosGet from '../axiosGetMixin'
import WorksOverviewFilters from './WorksOverviewFilters'
import WorksOverviewResults from './WorksOverviewResults'
import ButtonLoadMore from '../atoms/buttons/ButtonLoadMore'
import InputSearch from '../atoms/InputSearch'
import RangeSlider from '../atoms/RangeSlider'
import ButtonClearFilters from '../atoms/buttons/ButtonClearFilters'

const FILTER_AWARDS = 'awards'
const FILTER_INVESTOR = 'has_public_investor'

export default {
  components: {
    RangeSlider,
    WorksOverviewFilters,
    WorksOverviewResults,
    ButtonLoadMore,
    InputSearch,
    ButtonClearFilters
  },
  mixins: [
    axiosGet
  ],
  data () {
    return {
      filters: {},
      selectedFilters: [],
      yearRange: [1900, 2021],
      minYear: 1900,
      maxYear: 2021,
      searchTerm: null,
      results: [],
      sorting: {
        name: null,
        year: null
      },
      total: 0,
      page: 1,
      hasNextPage: true
    }
  },
  computed: {
    filterParams () {
      const params = {
        awards: this.selectedFilters.filter(filter => filter.type === FILTER_AWARDS).map(filter => filter.title),
        has_public_investor: this.selectedFilters.filter(filter => filter.type === FILTER_INVESTOR).map(filter => filter.title)
      }

      if (this.sorting.name) {
        params.sortby = 'name'
        params.direction = this.sorting.name
      }

      if (this.sorting.year) {
        params.sortby = 'created_at'
        params.direction = this.sorting.year
      }

      if (this.searchTerm) {
        params.q = this.searchTerm
      }

      if (this.yearRange) {
        params.year_from = this.yearRange[0]
        params.year_until = this.yearRange[1]
      }

      return params
    },
    areFiltersApplied () {
      return this.selectedFilters.length > 0 || this.searchTerm || this.yearRange[0] !== 1900 || this.yearRange[1] !== 2021
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
    yearRange () {
      const debounceTime = 300
      clearTimeout(this.yearRangeDebounceTimeout)

      this.yearRangeDebounceTimeout = setTimeout(() => {
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
      const [worksResponse, filtersResponse] = await Promise.all([
        this.axiosGet('works', this.filterParams),
        this.axiosGet('works-filters', this.filterParams)
      ])

      const awards = []
      const investors = []

      for (const key in filtersResponse.awards) {
        awards.push({ key: key, title: key, items: filtersResponse.awards[key], type: FILTER_AWARDS })
      }

      for (const key in filtersResponse.has_public_investor) {
        investors.push({ key: key, title: key, items: filtersResponse.has_public_investor[key], type: FILTER_INVESTOR })
      }

      this.filters = {
        awards,
        investors
      }

      this.results = worksResponse.data
      this.total = worksResponse.meta.total
      this.hasNextPage = worksResponse.meta.current_page < worksResponse.meta.last_page
    },
    async onLoadMore () {
      const params = {
        ...this.filterParams,
        page: this.page + 1
      }

      const worksResponse = await this.axiosGet('works', params)

      this.page = worksResponse.meta.current_page
      this.hasNextPage = worksResponse.meta.current_page < worksResponse.meta.last_page
      this.results.push(...worksResponse.data)
    },
    onClearFilters () {
      this.selectedFilters = []
      this.yearRange = [1900, 2021]
      this.searchTerm = null
    }
  }
}
</script>
