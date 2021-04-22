<template>
    <div class="mt-10">
        <div class="flex">
            <button>+</button>
            <button>-</button>
            <LinkArrow url="#">
                Zobraz celú mapu
            </LinkArrow>
        </div>
        <div>
            This is a map
        </div>
    </div>
</template>

<script>
import LinkArrow from "./atoms/links/LinkArrow";

export default {
    components: { LinkArrow }
}
</script>
