<template>
  <div>
    <div class="flex flex-wrap">
      <radio-button
        v-for="option in options"
        :key="option.key"
        v-model="selectedOption"
        :option="option"
        class="mr-12"
      />
    </div>
    <button
      v-show="selectedOption.key"
      class="mt-10 focus:outline-none"
      @click="onCancel"
    >
      Zrušiť filter
    </button>
  </div>
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
      default: () => [
        { key: 'important', title: 'Dôležité', params: '?featured' },
        { key: 'tenders', title: 'Súťaže', params: '' },
        { key: 'info', title: 'Správy', params: '' },
        { key: 'education', title: 'Vzdelávanie', params: '' },
        { key: 'cezaar', title: 'CE ZA AR', params: '' }
      ]
    }
  },
  data () {
    return {
      selectedOption: {}
    }
  },
  methods: {
    onCancel () {
      this.selectedOption = {}
    }
  }
}
</script>
