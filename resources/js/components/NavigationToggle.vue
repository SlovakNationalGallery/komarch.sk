<template>
  <button
    type="button"
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
        navContent.classList.contains('nav-menu-expanded')
          ? navContent.classList.remove('nav-menu-expanded')
          : navContent.classList.add('nav-menu-expanded')
      }
    }
  }
}
</script>
