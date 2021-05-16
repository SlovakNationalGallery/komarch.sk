<template>
  <label
    class="py-1 flex items-center"
    :class="{'group cursor-pointer hover:text-blue': !isChecked}"
  >
    <input
      type="radio"
      v-bind="$attrs"
      :value="option.key"
      :checked="isChecked"
      class="cursor-pointer h-5 w-5 border border-black rounded-full bg-white checked:bg-black appearance-none focus:outline-none"
      :class="{'group-hover:border-blue group-hover:border-2': !isChecked}"
      @change="$emit('input', option)"
    >
    <span class="ml-4">
      {{ option.title }}
    </span>
  </label>
</template>

<script>
export default {
  props: {
    value: {
      type: Object,
      required: true
    },
    option: {
      type: Object,
      required: true
    }
  },
  computed: {
    isChecked () {
      return this.value.key === this.option.key
    }
  }
}
</script>
