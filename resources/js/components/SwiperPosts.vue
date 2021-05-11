<template>
    <div>
        <TeaserPostBig v-for="post in posts" :post="post" />
    </div>
</template>

<script>
  import TeaserPostBig from "./TeaserPostBig";

  export default {
      components: { TeaserPostBig },
      props: {
          posts: {
              type: Array,
              default: []
          },
      },
  }
</script>
