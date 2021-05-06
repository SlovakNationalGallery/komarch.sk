<template>
    <article class="py-10 grid grid-cols-2 place-items-start">
        <TagHash :tag="skaInformation.hashTags[0]"></TagHash>
        <TagDate>{{ skaInformation.date }}</TagDate>
        <h3 class="mt-1 text-xl col-span-2 tracking-tight">
            <LinkTitle :url="skaInformation.url">
                {{ skaInformation.title }}
            </LinkTitle>
        </h3>
    </article>
</template>

<script>
import TagHash from "./atoms/tags/TagHash";
import TagDate from "./atoms/tags/TagDate";
import LinkTitle from "./atoms/links/LinkTitle";

export default {
    components: {
        LinkTitle,
        TagDate,
        TagHash,
    },
    props: {
        skaInformation: {
            type: Object,
            required: true
        }
    }
}
</script>
