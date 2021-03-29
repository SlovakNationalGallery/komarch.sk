<template>
    <button
        type="button"
        aria-label="Toggle navigation"
        class="w-full md:hidden px-4 py-2 focus:outline-none"
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

              if (navContent) {
                  navContent.classList.contains('max-h-navigation')
                      ? navContent.classList.remove('max-h-navigation')
                      : navContent.classList.add('max-h-navigation')
              }
          }
      },
  }
</script>
