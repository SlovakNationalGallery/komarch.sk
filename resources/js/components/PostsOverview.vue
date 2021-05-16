<template>
  <div>
    <div class="mt-24 md:flex flex-wrap">
      <radio-button
        v-for="option in options"
        :key="option.key"
        v-model="selectedOption"
        :disabled="isLoading"
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
      {{ __('post.no_posts') }}.
    </p>
    <div
      v-if="posts.length > 0"
      class="mt-10 h-20 flex items-center"
    >
      <ButtonArrow
        v-if="!isLoading"
        class="text-xl"
        @click="onLoadMore"
      >
        {{ __('post.load_more') }}
      </ButtonArrow>
      <p v-else>
        {{ __('post.loading_more') }}
      </p>
    </div>
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
      selectedOption: {},
      isLoading: false,
      isError: false
    }
  },
  watch: {
    selectedOption: {
      immediate: true,
      async handler (newValue) {
        this.posts = await this.fetchUrl(`./api/posts${newValue.params || ''}`)
      }
    }
  },
  methods: {
    async fetchUrl (url) {
      try {
        const response = await axios.get(url)

        if (response.status !== 200) {
          this.isError = true
          this.isLoading = false
          return
        }

        this.isLoading = false
        return response.data.data
      } catch (error) {
        this.isError = true
        this.isLoading = false
      }
    },
    onLoadMore () {
      this.isLoading = true
      setTimeout(() => {
        this.isLoading = false
      }, 300)
    },
    onCancel () {
      this.selectedOption = {}
    }
  }
}
</script>
