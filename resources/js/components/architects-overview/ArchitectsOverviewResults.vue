<template>
  <div
    v-if="results.length > 0"
    class="mt-16"
  >
    <div class="lg:hidden">
      <div
        v-for="architect in results"
        :key="architect.id"
        class="border-b py-3 flex items-start justify-between"
      >
        <div>
          <div>
            {{ architect.last_name }}
          </div>
          <div>
            {{ architect.first_name }}
          </div>
          <div>
            {{ architect.location_city }}
          </div>
        </div>
      </div>
    </div>
    <table class="hidden lg:table w-full text-left">
      <thead>
        <tr>
          <th>
            <ButtonSortable
              v-model="sortingLastName"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('architects.last_name') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingFirstName"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('architects.first_name') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingLocationCity"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('architects.location_city') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingWorksCount"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('architects.works_count') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingAwardsCount"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('architects.awards_count') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingContestsCount"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('architects.contests_count') }}
            </ButtonSortable>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="architect in results"
          :key="architect.id"
          class="border-b"
        >
          <td class="py-1">
            <LinkArrowHover :url="architect.url">
              {{ architect.last_name }}
            </LinkArrowHover>
          </td>
          <td class="py-1">
            {{ architect.first_name }}
          </td>
          <td class="py-1">
            {{ architect.location_city }}
          </td>
          <td class="py-1">
            {{ architect.works_count }}
          </td>
          <td class="py-1">
            {{ architect.awards_count }}
          </td>
          <td class="py-1">
            {{ architect.contests_count }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div
    v-else
    class="mt-16"
  >
    {{ __('architects.no_results') }}
  </div>
</template>

<script>
import ButtonSortable from '../atoms/buttons/ButtonSortable'
import LinkArrowHover from '../atoms/links/LinkArrowHover'
export default {
  components: {
    ButtonSortable,
    LinkArrowHover
  },
  props: {
    value: {
      type: Object,
      required: true
    },
    results: {
      type: Array,
      required: true
    }
  },
  computed: {
    sortingLastName: {
      get () {
        return this.value.last_name
      },
      set (newValue) {
        this.$emit('input', {
          last_name: newValue
        })
      }
    },
    sortingFirstName: {
      get () {
        return this.value.first_name
      },
      set (newValue) {
        this.$emit('input', {
          first_name: newValue
        })
      }
    },
    sortingLocationCity: {
      get () {
        return this.value.location_city
      },
      set (newValue) {
        this.$emit('input', {
          location_city: newValue
        })
      }
    },
    sortingWorksCount: {
      get () {
        return this.value.works_count
      },
      set (newValue) {
        this.$emit('input', {
          works_count: newValue
        })
      }
    },
    sortingAwardsCount: {
      get () {
        return this.value.awards_count
      },
      set (newValue) {
        this.$emit('input', {
          awards_count: newValue
        })
      }
    },
    sortingContestsCount: {
      get () {
        return this.value.contests_count
      },
      set (newValue) {
        this.$emit('input', {
          contests_count: newValue
        })
      }
    }
  }
}
</script>
