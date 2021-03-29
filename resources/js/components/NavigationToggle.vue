<template>
    <button
        type="button"
        aria-label="Toggle navigation"
        class="w-full md:hidden py-4"
        @click="onClicked"
    >
        Menu
    </button>
</template>

<script>
  export default {
      methods: {
          onClicked () {
              const navContent = document.querySelector('#nav-content')

              if (!navContent) {
                  return
              }

              navContent.classList.contains('hidden')
                  ? navContent.classList.remove('hidden')
                  : navContent.classList.add('hidden')
          }
      },
  }
</script>
