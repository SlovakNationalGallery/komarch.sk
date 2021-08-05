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
              :value="getSortingDirectionFor('last_name')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSorting('last_name', $event)"
            >
              {{ __('architects.last_name') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortingDirectionFor('first_name')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSorting('first_name', $event)"
            >
              {{ __('architects.first_name') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortingDirectionFor('location_city')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSorting('location_city', $event)"
            >
              {{ __('architects.location_city') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortingDirectionFor('works_count')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSorting('works_count', $event)"
            >
              {{ __('architects.works_count') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortingDirectionFor('awards_count')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSorting('awards_count', $event)"
            >
              {{ __('architects.awards_count') }}
            </ButtonSortable>
          </th>
          <th>
            <ButtonSortable
              :value="getSortingDirectionFor('contests_count')"
              style="min-width: 200px"
              class="pb-10 text-sm"
              @input="setSorting('contests_count', $event)"
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
  methods: {
    getSortingDirectionFor (name) {
      if (this.value.name === name) return this.value.direction
      return null
    },
    setSorting (name, direction) {
      this.$emit('input', { name, direction })
    }
  }
}
</script>
