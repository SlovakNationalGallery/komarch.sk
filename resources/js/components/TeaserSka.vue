<template>
  <article class="py-10 grid grid-cols-2 place-items-start items-center">
    <TagHash
      v-if="post.tags[0]"
      :url="tagUrl"
    >
      {{ post.tags[0].name }}
    </TagHash>
    <TagDate>{{ post.date }}</TagDate>
    <h3 class="mt-1 text-xl col-span-2 tracking-tight">
      <LinkTitle :url="post.url">
        {{ post.title }}
      </LinkTitle>
    </h3>
  </article>
</template>

<script>
import TagHash from './atoms/tags/TagHash'
import TagDate from './atoms/tags/TagDate'
import LinkTitle from './atoms/links/LinkTitle'

export default {
  components: {
    LinkTitle,
    TagDate,
    TagHash
  },
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  computed: {
    tagUrl () {
      return `${window.location.origin}/spravy?categories[]=${this.post.tags[0].name}`
    }
  }
}
</script>
