<template>
  <article class="py-10 grid grid-cols-2 place-items-start group">
    <TagHash v-if="post.tags[0]" :url="tagUrl">{{ post.tags[0].name }}</TagHash>
    <TagDate>{{ post.date }}</TagDate>
    <h3 class="mt-2 text-2xl col-span-2 tracking-tight leading-snug">
      <LinkTitle :url="post.url">
        {{ post.title }}
      </LinkTitle>
    </h3>
    <p class="mt-5 col-span-2 leading-snug">
      {{ post.perex }}
    </p>
    <a :href="post.url" class="w-full d-block col-span-2">
      <img
        v-if="post.cover_image"
        :srcset="post.cover_image.srcset"
        :alt="post.title"
        sizes="1px"
        :src="post.cover_image.url"
        class="my-5 rounded-2xl col-span-2 group-hover:rounded-none transition"
        :width="post.cover_image.width"
        :height="post.cover_image.height"
        ref="img"
        @load="onImgLoad"
      />
      <NoImage class="my-5" v-else></NoImage>
    </a>
  </article>
</template>

<script>
import TagHash from "./atoms/tags/TagHash";
import TagDate from "./atoms/tags/TagDate";
import LinkTitle from "./atoms/links/LinkTitle";
import NoImage from "./atoms/NoImage";

export default {
  components: {
    TagHash,
    TagDate,
    LinkTitle,
    NoImage
  },
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  computed: {
    tagUrl() {
      return `${window.location.origin}/spravy?categories=${this.post.tags[0].name}`;
    }
  },
  methods: {
    onImgLoad() {
      const size = this.$refs.img.getBoundingClientRect().width;
      this.$refs.img.sizes = Math.ceil((size / window.innerWidth) * 100) + "vw";
      this.$refs.img.src = this.post.cover_image.url; 
    }
  }
};
</script>
