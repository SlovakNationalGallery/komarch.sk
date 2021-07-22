<template>
  <div class="md:flex items-start">
    <InputCheckboxGroup
      v-if="filters.states && filters.states.length > 0"
      :filters="filters.states"
      :value="value"
      :title="`${__('contests.state')}:`"
      @input="onInput"
    />
    <InputCheckboxGroup
      v-if="filters.typologies && filters.typologies.length > 0"
      :filters="filters.typologies"
      :value="value"
      :title="`${__('contests.typology')}:`"
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
