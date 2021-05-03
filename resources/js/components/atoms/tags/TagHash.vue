<template>
    <a
        class="px-1 mr-4 hover:text-blue flex items-center"
        :href="tag.url"
    >
        ❪<span class="text-sm">#{{ tag.title }}</span>❫
    </a>
</template>

<script>
  export default {
      props: {
          tag: {
              type: Object,
              required: true
          }
      }
  }
</script>
