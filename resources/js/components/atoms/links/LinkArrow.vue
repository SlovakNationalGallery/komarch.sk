<template>
    <a :href="url" class="group block leading-loose flex items-center hover:text-blue">
        <slot></slot>
        <span class="transform group-hover:translate-x-2 ml-2 duration-200">
            {{ external ? '→' : '->' }}
        </span>
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
