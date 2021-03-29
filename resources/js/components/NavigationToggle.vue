<template>
    <button @click="toggled = !toggled">
        {{ toggled ? 'Toggled' : 'Not Toggled'}}
    </button>
</template>

<script>
  export default {
      data() {
          return {
              toggled: false
          }
      },
  }
</script>
