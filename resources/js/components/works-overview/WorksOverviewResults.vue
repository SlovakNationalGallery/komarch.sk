<template>
  <div class="mt-16 md:mt-32">
    <div class="flex flex-wrap">
      <span class="w-full mb-4 sm:mb-0 sm:w-32 text-sm">
        {{ count }}
      </span>
      <ButtonSortable
        v-model="sortingName"
        class="sm:ml-8 text-sm"
      >
        {{ __('generic.name') }}
      </ButtonSortable>
      <ButtonSortable
        v-model="sortingYear"
        class="sm:ml-16 text-sm"
      >
        {{ __('generic.year') }}
      </ButtonSortable>
    </div>
    <isotope :options="getIsotopeOptions()" :list="results" class="md:-mx-5">
      <TeaserWorkBig
        v-for="item in results"
        :key="item.id"
        :item="item"
        class="md:p-5 md:w-1/4"
        data-grid-item
      />
    </isotope>
  </div>
</template>

<script>
import ButtonSortable from '../atoms/buttons/ButtonSortable'
import TeaserWorkBig from '../TeaserWorkBig'
import isotope from 'vueisotope'

export default {
  components: {
    ButtonSortable,
    TeaserWorkBig,
    isotope
  },
  props: {
    value: {
      type: Object,
      required: true
    },
    results: {
      type: Array,
      required: true
    },
    total: {
      type: Number,
      required: true
    }
  },
  computed: {
    count () {
      let localizedObjectsLabel = 'works.objects_plural'

      if (this.total === 1) {
        localizedObjectsLabel = 'works.objects_one'
      }

      if (this.total > 1 && this.total < 5) {
        localizedObjectsLabel = 'works.objects_few'
      }

      return `(${this.total}) ${this.__(localizedObjectsLabel)}`
    },
    sortingName: {
      get () {
        return this.value.name
      },
      set (newValue) {
        this.$emit('input', {
          name: newValue
        })
      }
    },
    sortingYear: {
      get () {
        return this.value.year
      },
      set (newValue) {
        this.$emit('input', {
          year: newValue
        })
      }
    }
  },
  methods: {
    getIsotopeOptions() {
      return {
        itemSelector: '[data-grid-item]',
        percentPosition: true,
      };
    },
  }
}
</script>
