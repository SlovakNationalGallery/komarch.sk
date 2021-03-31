<template>
    <article class="py-10">
        <span class="text-sm">{{ tender.date }}</span>
        <span class="text-sm ml-2">{{ tender.days }}</span>
        <h3 class="mt-1 text-xl">
            <a :href="tender.url" class="hover:underline">{{ tender.title }}</a>
        </h3>
    </article>
</template>

<script>
export default {
    props: {
        tender: {
            type: Object,
            required: true
        }
    }
}
</script>
