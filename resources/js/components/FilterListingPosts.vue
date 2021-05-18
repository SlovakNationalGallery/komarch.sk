<template>
  <section class="mt-20">
    <h2 class="text-xl mb-10">
      <LinkArrow url="/spravy">
        Informácie SKA
      </LinkArrow>
    </h2>

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
        :key="displayOption.key"
        class="mt-10"
      >
        <template v-if="posts.length > 0">
          <div
            v-for="(post, index) in posts"
            :key="index"
          >
            <TeaserSka :post="post" />
          </div>
        </template>
        <p
          v-else
          class="py-10"
        >
          Nenašli sa žiadne články.
        </p>
      </div>
    </transition>

    <LinkArrow url="/spravy">
      Informácie SKA
    </LinkArrow>
  </section>
</template>

<script>
import LinkArrow from './atoms/links/LinkArrow'
import TeaserSka from './TeaserSka'
import RadioButton from './atoms/RadioButton'

export default {
  components: {
    TeaserSka,
    LinkArrow,
    RadioButton
  },
  props: {
    options: {
      type: Array,
      default: () => [
        { key: 'newest', title: 'Najnovšie', params: '' },
        { key: 'important', title: 'Dôležité', params: '?featured' },
        { key: 'COVID-19', title: 'COVID-19', params: '?categories=COVID-19' }
      ]
    }
  },
  data () {
    return {
      posts: [],
      selectedOption: this.options[0],
      displayOption: this.options[0]
    }
  },
  watch: {
    selectedOption: {
      immediate: true,
      async handler (newValue) {
        const response = await axios.get(`./api/posts${newValue.params}`)
        this.displayOption = newValue
        this.posts = response.data.data
      }
    }
  }
}
</script>
