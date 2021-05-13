<template>
  <article class="py-10 grid grid-cols-2 place-items-start items-center">
    <TagDate>{{ tender.date }}</TagDate>
    <TagDate class="h-6 flex items-center">
      <span class="icon-clock mr-1" />
      {{ tender.days }}
    </TagDate>
    <h3 class="mt-1 text-xl col-span-2 tracking tight">
      <LinkTitle :url="tender.url">
        {{ tender.title }}
      </LinkTitle>
    </h3>
  </article>
</template>

<script>
import TagDate from './atoms/tags/TagDate'
import LinkTitle from './atoms/links/LinkTitle'

export default {
  components: {
    LinkTitle,
    TagDate
  },
  props: {
    tender: {
      type: Object,
      required: true
    }
  }
}
</script>
