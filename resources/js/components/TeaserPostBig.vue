<template>
    <article class="py-10 grid grid-cols-2 place-items-start items-center">
        <TagHash :tag="post.tags[0]" v-if="post.tags[0]"></TagHash>
        <TagDate>{{ post.date }}</TagDate>
        <h3 class="mt-2 text-xl col-span-2 tracking-tight leading-snug">
            <LinkTitle :url="post.url">
                {{ post.title }}
            </LinkTitle>
        </h3>
        <p class="mt-5 col-span-2 leading-snug">{{ post.perex }}</p>
        <!-- TODO: add images when available -->
    </article>
</template>

<script>
import TagHash from "./atoms/tags/TagHash";
import TagDate from "./atoms/tags/TagDate";
import LinkTitle from "./atoms/links/LinkTitle";

  export default {
      components: {
          TagHash,
          TagDate,
          LinkTitle
      },
      props: {
          post: {
              type: Object,
              required: true
          }
      }
  }
</script>
