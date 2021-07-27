<template>
  <div class="md:flex items-start">
    <InputCheckboxGroup
      v-if="filters.authorizationsIn && filters.authorizationsIn.length > 0"
      :filters="filters.authorizationsIn"
      :value="value"
      :title="`${__('architects.authorization')}:`"
      @input="onInput"
    />
    <ButtonClearFilters
      v-show="value && value.length > 0"
      @click="onCancel"
    />
  </div>
</template>

<script>
import ButtonClearFilters from '../atoms/buttons/ButtonClearFilters'
import InputCheckboxGroup from './../atoms/InputCheckboxGroup'

export default {
  components: {
    InputCheckboxGroup,
    ButtonClearFilters
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
    onCancel () {
      this.$emit('input', [])
    },
    onInput (newValue) {
      this.$emit('input', newValue)
    }
  }
}
</script>
