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
    <div class="h-10 md:h-20">
      <button
        v-show="selectedOption.key"
        class="mt-5 focus:outline-none hover:text-blue"
        @click="onCancel"
      >
        <span class="icon-close text-lg mr-1" />
        {{ __('post.cancel_filters') }}
      </button>
    </div>
    <transition-group
      name="posts-overview"
      mode="out-in"
      class="lg:flex flex-wrap items-start lg:-ml-3"
    >
      <TeaserPostBig
        v-for="post in posts"
        :key="post.id"
        :post="post"
        class="lg:w-1/3 lg:p-3 mt-12"
      />
    </transition-group>
    <p
      v-if="posts.length === 0"
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
        { key: 'tenders', title: 'Súťaže', params: '&categories=Súťaže' },
        { key: 'info', title: 'Správy', params: '&categories=Správy' },
        { key: 'education', title: 'Vzdelávanie', params: '&categories=Vzdelávanie' },
        { key: 'cezaar', title: 'CE ZA AR', params: '&categories=CE ZA AR' }
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
      handler () {
        this.fetchPage(1)
      }
    }
  },
  methods: {
    onLoadMore () {
      this.fetchPage(this.page + 1)
    },
    onCancel () {
      this.selectedOption = {}
    },
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
    async fetchPage (pageNumber) {
      const { data, meta } = await this.fetchUrl(`${window.location.origin}/api/posts?page=${pageNumber}${this.selectedOption.params || ''}`)

      if (pageNumber === 1) {
        this.posts = data
      } else {
        this.posts.push(...data)
      }

      this.page = meta.current_page
      this.hasNextPage = meta.current_page < meta.last_page
    }
  }
}
</script>

<style>
.posts-overview-enter-active {
  @apply transition-all duration-700;
}

.posts-overview-enter {
  @apply transform opacity-0 translate-y-5;
}
</style>
