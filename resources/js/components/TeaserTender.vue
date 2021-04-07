<template>
    <article class="py-10">
        <TagDate>{{ tender.date }}</TagDate>
        <TagDate>{{ tender.days }}</TagDate>
        <h3 class="mt-1 text-xl">
            <LinkUnderline :url="tender.url">
                {{ tender.title }}
            </LinkUnderline>
        </h3>
    </article>
</template>

<script>
import TagDate from "./atoms/tags/TagDate";
import LinkUnderline from "./atoms/links/LinkUnderline";

export default {
    components: {
        LinkUnderline,
      TagDate
    },
    props: {
        tender: {
            type: Object,
            required: true
        }
    }
}
</script>
