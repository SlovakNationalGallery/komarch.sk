<template>
  <button
    class="group w-20 flex justify-center items-center cursor-pointer hover:text-blue focus:outline-none"
    @click="onClick"
  >
    <span class="group-hover:hidden text-xl icon-link" />
    <span class="hidden group-hover:block">{{ copied ? copiedText : copyText }}</span>
  </button>
</template>

<script>
let feedbackTimeout

export default {
  props: {
    copyText: {
      type: String,
      required: true
    },
    copiedText: {
      type: String,
      required: true
    },
    copyContent: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      copied: false
    }
  },
  methods: {
    onClick () {
      clearTimeout(feedbackTimeout)
      navigator.clipboard.writeText(this.copyContent)
      this.copied = true

      feedbackTimeout = setTimeout(() => {
        this.copied = false
      }, 1500)
    }
  }
}
</script>
