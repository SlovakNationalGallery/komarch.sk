<template>
    <a
        class="text-sm border-l border-r px-2 py-1 rounded-lg"
        :href="tag.url"
    >
        #{{ tag.title }}
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
