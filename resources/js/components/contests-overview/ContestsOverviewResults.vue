<template>
  <div
    v-if="results.length > 0"
    class="mt-16"
  >
    <div class="lg:hidden">
      <div
        v-for="contest in results"
        :key="contest.id"
        class="border-b py-3 flex items-start justify-between"
      >
        <div>
          <div>
            {{ contest.created_at }}
          </div>
          <div>
            {{ contest.title }}
          </div>
        </div>
      </div>
    </div>
    <table class="hidden lg:table w-full text-left">
      <thead>
        <tr>
          <th>
            <ButtonSortable
              v-model="sortingAnnounced"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.announced_at') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingFinished"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.finished_at') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingResultsPublished"
              style="min-width: 200px"
              class="pb-10 text-sm"
            >
              {{ __('generic.results_published_at') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              v-model="sortingTitle"
              class="pb-10 text-sm"
            >
              {{ __('generic.title') }}
            </ButtonSortable>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="contest in results"
          :key="contest.id"
          class="border-b"
        >
          <td class="py-1">
            {{ contest.announced_at }}
          </td>
          <td class="py-1">
            {{ contest.finished_at }}
          </td>
          <td class="py-1">
            {{ contest.results_published_at }}
          </td>
          <td class="py-1">
            {{ contest.title }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div
    v-else
    class="mt-16"
  >
    {{ __('contests.no_results') }}
  </div>
</template>

<script>
import ButtonSortable from '../atoms/buttons/ButtonSortable'

export default {
  components: {
    ButtonSortable
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
    sortingTitle: {
      get () {
        return this.value.title
      },
      set (newValue) {
        this.$emit('input', {
          title: newValue
        })
      }
    },
    sortingAnnounced: {
      get () {
        return this.value.announcedAt
      },
      set (newValue) {
        this.$emit('input', {
          announcedAt: newValue
        })
      },
    },
    sortingFinished: {
      get () {
        return this.value.finishedAt
      },
      set (newValue) {
        this.$emit('input', {
          finishedAt: newValue
        })
      }
    },
    sortingResultsPublished: {
      get () {
        return this.value.resultsPublishedAt
      },
      set (newValue) {
        this.$emit('input', {
          resultsPublishedAt: newValue
        })
      }
    }
  }
}
</script>
