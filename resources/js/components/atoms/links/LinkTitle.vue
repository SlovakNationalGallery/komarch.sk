<template>
  <a
    :href="url"
    class="block leading-snug hover:text-blue cursor-pointer"
  >
    <slot />
  </a>
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true
    }
  }
}
</script>
