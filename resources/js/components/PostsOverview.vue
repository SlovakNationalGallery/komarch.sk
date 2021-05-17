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
      v-if="hasNextPage"
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
        { key: 'important', title: 'Dôležité', params: '&featured' },
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
      page: 1,
      hasNextPage: true,
      isLoading: false,
      isError: false
    }
  },
  watch: {
    selectedOption: {
      immediate: true,
      async handler (newValue) {
        const { data, meta } = await this.fetchUrl(`./api/posts?per_page=6&page=1${newValue.params || ''}`)
        this.posts = data
        this.page = meta.current_page
        this.hasNextPage = meta.current_page < meta.last_page
      }
    }
  },
  methods: {
    async fetchUrl (url) {
      try {
        this.isLoading = true
        const response = await axios.get(url)

        if (response.status !== 200) {
          this.isError = true
          return
        }

        return response.data
      } catch (error) {
        this.isError = true
      } finally {
        this.isLoading = false
      }
    },
    async onLoadMore () {
      const { data, meta } = await this.fetchUrl(`./api/posts?per_page=6&page=${this.page + 1}${this.selectedOption.params || ''}`)
      this.posts.push(...data)
      this.page = meta.current_page
      this.hasNextPage = meta.current_page < meta.last_page
    },
    onCancel () {
      this.selectedOption = {}
    }
  }
}
</script>
