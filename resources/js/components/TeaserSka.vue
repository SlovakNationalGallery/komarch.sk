<template>
    <article class="py-10 grid grid-cols-2 place-items-start">
        <TagHash :tag="skaInformation.hashTags[0]"></TagHash>
        <TagDate>{{ skaInformation.date }}</TagDate>
        <h3 class="mt-1 text-xl col-span-2">
            <LinkUnderline :url="skaInformation.url">
                {{ skaInformation.title }}
            </LinkUnderline>
        </h3>
    </article>
</template>

<script>
import TagHash from "./atoms/tags/TagHash";
import TagDate from "./atoms/tags/TagDate";
import LinkUnderline from "./atoms/links/LinkUnderline";

export default {
    components: {
        LinkUnderline,
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
