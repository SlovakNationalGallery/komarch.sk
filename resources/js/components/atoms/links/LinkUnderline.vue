<template>
    <a :href="url" class="block hover:underline">
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
