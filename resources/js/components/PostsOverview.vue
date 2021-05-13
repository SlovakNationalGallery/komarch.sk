<template>
    <div>
        <div class="flex flex-wrap">
            <radio-button
                v-for="option in options"
                :key="option.key"
                :option="option"
                v-model="selectedOption"
                class="mr-12"
            />
        </div>
        <button
            @click="onCancel"
            v-show="selectedOption.key"
            class="mt-10 focus:outline-none"
        >
            Zrušiť filter
        </button>
    </div>
</template>

<script>
    import RadioButton from "./atoms/RadioButton";

  export default {
    components: {
        RadioButton
    },
      data() {
          return {
              selectedOption: {},
          }
      },
      props: {
          options: {
              type: Array,
              default: () => [
                  { key: 'important', title: 'Dôležité', params: '?featured' },
                  { key: 'tenders', title: 'Súťaže', params: '' },
                  { key: 'info', title: 'Správy', params: '' },
                  { key: 'education', title: 'Vzdelávanie', params: '' },
                  { key: 'cezaar', title: 'CE ZA AR', params: '' },
              ]
          }
      },
      methods: {
        onCancel () {
            this.selectedOption = {}
        }
      }
  }
</script>
