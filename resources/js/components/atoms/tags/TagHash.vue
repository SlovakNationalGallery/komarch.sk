<template>
    <a
        class="px-1 mr-4 hover:text-blue flex items-center"
        :href="tagUrl"
    >
        ❪<span class="text-sm">#{{ tag.name }}</span>❫
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
            return `${window.location.origin}/spravy?categories[]=${this.tag.name}`;
          }
      }
  }
</script>
