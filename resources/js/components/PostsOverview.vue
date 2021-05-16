<template>
  <div>
    <div class="flex flex-wrap">
      <radio-button
        v-for="option in options"
        :key="option.key"
        v-model="selectedOption"
        :option="option"
        class="mr-12 py-2"
      />
    </div>
    <div class="h-20">
      <button
        v-show="selectedOption.key"
        class="mt-5 focus:outline-none hover:text-blue"
        @click="onCancel"
      >
        <span class="icon-close text-lg mr-1" />
        Zrušiť filter
      </button>
    </div>

    <div
      v-if="posts.length > 0"
      class="lg:flex flex-wrap items-start lg:-ml-3"
    >
      <TeaserPostBig
        v-for="(post, index) in posts"
        :key="index"
        :post="post"
        class="lg:w-1/3 lg:p-3"
      />
    </div>
    <p
      v-else
      class="py-10"
    >
      Nenašli sa žiadne články.
    </p>
    <ButtonArrow class="text-xl mt-10">
      Načítať ďalšie
    </ButtonArrow>
  </div>
</template>

<script>
import RadioButton from './atoms/RadioButton'
import TeaserPostBig from './TeaserPostBig'
import ButtonArrow from './atoms/buttons/ButtonArrow'

export default {
  components: {
    ButtonArrow,
    RadioButton,
    TeaserPostBig
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
      posts: [],
      selectedOption: {}
    }
  },
  watch: {
    selectedOption: {
      immediate: true,
      async handler (newValue) {
        const response = await axios.get(`./api/posts${newValue.params || ''}`)
        this.posts = response.data.data
      }
    }
  },
  methods: {
    onCancel () {
      this.selectedOption = {}
    }
  }
}
</script>
