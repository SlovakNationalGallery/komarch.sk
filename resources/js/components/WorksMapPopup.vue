<template>
  <div
    v-if="artwork && artwork.properties"
    class="bg-white rounded-xl shadow-xl"
  >
    <img
      v-if="coverImage"
      ref="img"
      :srcset="coverImage.srcset"
      :alt="artwork.properties.title"
      class="rounded-t-xl"
      sizes="1px"
      :src="coverImage.url"
      :width="coverImage.width"
      :height="coverImage.height"
      @load="onImgLoad"
    >
    <div class="p-4">
      <h3>
        {{ artwork.properties.title }}
      </h3>
      <span
        v-for="architect in JSON.parse(artwork.properties.architects)"
        class="group inline-block leading-relaxed mr-2"
      >
        {{ architect }}
      </span>

      <LinkArrow
        :url="artwork.properties.url"
        class="mt-3"
      >
        {{ __('buildings.building_more') }}
      </LinkArrow>
    </div>
  </div>
</template>

<script>
import LinkArrow from './atoms/links/LinkArrow'

export default {
  components: {
    LinkArrow
  },
  props: {
    artwork: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      imgIsLoaded: false
    }
  },
  computed: {
    coverImage: function () {
      return JSON.parse(this.artwork.properties.cover_image)
    }
  },
  methods: {
    onImgLoad () {
      if (!this.imgIsLoaded) {
        this.imgIsLoaded = true
        const size = this.$refs.img.getBoundingClientRect().width
        this.$refs.img.sizes =  Math.ceil(size / window.innerWidth * 100) + 'vw'
      }
    }
  }
}
</script>
