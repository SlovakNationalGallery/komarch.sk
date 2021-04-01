<template>
    <article class="py-10">
        <span class="text-sm">#{{ skaInformation.hashTag }}</span>
        <span class="text-sm ml-2">{{ skaInformation.date }}</span>
        <h3 class="mt-1 text-xl">
            <a :href="skaInformation.url" class="hover:underline">{{ skaInformation.title }}</a>
        </h3>
    </article>
</template>

<script>
export default {
    props: {
        skaInformation: {
            type: Object,
            required: true
        }
    }
}
</script>
