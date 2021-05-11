<template>
    <div>
        {{ posts }}
    </div>
</template>

<script>
  export default {
      props: {
          posts: {
              type: Array,
              default: []
          },
      },
  }
</script>
