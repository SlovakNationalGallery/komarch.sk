<template>
    <article class="py-10 grid grid-cols-2 place-items-start items-center">
        <TagHash :tag="post.tags[0]"></TagHash>
        <TagDate>{{ post.dateFormatted }}</TagDate>
        <h3 class="mt-1 text-xl col-span-2 tracking-tight">
            <LinkTitle :url="post.slug">
                {{ post.title.sk }}
            </LinkTitle>
        </h3>
        <p class="mt-4 col-span-2">{{ post.perex.sk }}</p>
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
          },
      },
  }
</script>
