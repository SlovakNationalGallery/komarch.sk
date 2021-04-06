<template>
    <article class="py-10">
        <HashTag :tag="skaInformation.hashTags[0]"></HashTag>
        <span class="text-sm ml-2">{{ skaInformation.date }}</span>
        <h3 class="mt-1 text-xl">
            <a :href="skaInformation.url" class="block hover:underline">{{ skaInformation.title }}</a>
        </h3>
    </article>
</template>

<script>
import HashTag from "./atoms/HashTag";

export default {
    components: {
        HashTag,
    },
    props: {
        skaInformation: {
            type: Object,
            required: true
        }
    }
}
</script>
