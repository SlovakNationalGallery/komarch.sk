<template>
    <button
        type="button"
        aria-label="Toggle navigation"
        class="w-full md:hidden p-4 focus:outline-none"
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

              navContent.classList.contains('max-h-screen')
                  ? navContent.classList.remove('max-h-screen')
                  : navContent.classList.add('max-h-screen')
          }
      },
  }
</script>
