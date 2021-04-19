<template>
    <a :href="url" class="block hover:text-blue">
        <slot></slot>
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
