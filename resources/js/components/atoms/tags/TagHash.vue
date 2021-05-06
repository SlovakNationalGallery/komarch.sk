<template>
    <a
        class="text-sm border-l border-r px-2 py-1 mr-4 rounded-lg hover:text-blue"
        :href="tagUrl"
    >
        #{{ tag.name }}
    </a>
</template>

<script>
  export default {
      props: {
          tag: {
              type: Object,
              required: true
          }
      },
      computed: {
          tagUrl() {
            return 'spravy?category[]' + this.tag.slug;
          }
      }
  }
</script>
