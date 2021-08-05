<template>
  <FilterListing
    v-model="selectedOption"
    :fetched-option="fetchedOption"
    :options="options"
    :items="contests"
  >
    <template #before-list>
      <h2 class="text-xl mb-10">
        <LinkArrow url="/sutaze">
          Súťaže
        </LinkArrow>
      </h2>
    </template>

    <template #empty-list>
      <p class="py-10">
        Nenašli sa žiadne súťaže.
      </p>
    </template>

    <template #list-item="{ item }">
      <TeaserTender :tender="item" />
    </template>

    <template #after-list>
      <LinkArrow url="/sutaze">
        Viac súťaží
      </LinkArrow>
    </template>
  </FilterListing>
</template>

<script>
import TeaserTender from './TeaserTender'
import LinkArrow from './atoms/links/LinkArrow'
import FilterListing from './FilterListing'

export default {
  components: {
    FilterListing,
    LinkArrow,
    TeaserTender
  },
  props: {
    options: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      selectedOption: this.options[0],
      contests: [],
      fetchedOption: null
    }
  },
  watch: {
    selectedOption (value) {
      this.fetch()
    }
  },
  created () {
    this.fetch()
  },
  methods: {
    async fetch () {
      const response = await axios.get('/api/contests', { params: { states: [this.selectedOption.key] } })
      this.fetchedOption = this.selectedOption.key
      this.contests = response.data.data
    }
  }
}
</script>
