<template>
  <section class="mt-20">
    <slot name="before-list" />
    <radio-button
      v-for="option in options"
      :key="option.key"
      v-model="selectedOption"
      :option="option"
    />
    <transition
      name="items-list"
      mode="out-in"
    >
      <div
        :key="selectedOption.key"
        class="mt-10"
      >
        <div
          v-for="(item, index) in items.filter(it => it.filterTags.includes(selectedOption.key))"
          :key="index"
        >
          <slot
            name="list-item"
            :item="item"
          />
        </div>
      </div>
    </transition>
    <slot name="after-list" />
  </section>
</template>

<script>
import RadioButton from './atoms/RadioButton'

export default {
  components: {
    RadioButton
  },
  props: {
    options: {
      type: Array,
      required: true
    },
    items: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      selectedOption: this.options[0]
    }
  },
  computed: {
    resultsList () {
      return [this.options.find(option => option.key === this.selectedOption.key)]
    }
  }
}
</script>

<style>
.items-list-leave-active {
    @apply transition duration-200 ease-in;
}

.items-list-enter-active {
    @apply transition duration-300 ease-out;
}

.items-list-leave-to {
    @apply opacity-0 transform -translate-x-8
}

.items-list-enter {
    @apply opacity-0 transform translate-x-8
}
</style>
