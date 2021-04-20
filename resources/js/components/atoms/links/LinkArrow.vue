<template>
    <a :href="url" class="group block leading-loose flex items-center hover:text-blue">
        <slot></slot>
        <span class="transform group-hover:translate-x-2 duration-200">
            →
        </span>
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
