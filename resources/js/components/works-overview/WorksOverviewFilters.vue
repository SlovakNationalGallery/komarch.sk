<template>
  <div class="md:flex items-start">
    <InputCheckboxGroup
      v-if="filters.awards && filters.awards.length > 0"
      :filters="filters.awards"
      :value="value"
      :title="`${__('works.awards')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      v-if="filters.investors && filters.investors.length > 0"
      :filters="filters.investors"
      :value="value"
      :title="`${__('works.investor')}:`"
      @input="onInput"
    />
  </div>
</template>

<script>
import InputCheckboxGroup from '../atoms/InputCheckboxGroup'

export default {
  components: {
    InputCheckboxGroup
  },
  props: {
    value: {
      type: Array,
      required: true
    },
    filters: {
      type: Object,
      required: true
    }
  },
  methods: {
    onInput (newValue) {
      this.$emit('input', newValue)
    }
  }
}
</script>
