<template>
  <a
    :href="url"
    class="group block leading-relaxed flex items-center hover:text-blue"
  >
    <slot />
    <span
      class="transform group-hover:translate-x-2 ml-2 duration-200"
      :class="external ? 'icon-arrow-r' : 'icon-arrow-r-long'"
    />
  </a>
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true
    },
    external: {
      type: Boolean,
      default: false
    }
  }
}
</script>
