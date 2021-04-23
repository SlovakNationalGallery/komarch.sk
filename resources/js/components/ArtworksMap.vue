<template>
    <div class="mt-10">
        <div class="flex">
            <button>+</button>
            <button>-</button>
            <LinkArrow url="#">
                Zobraz celú mapu
            </LinkArrow>
        </div>
        <div class="relative w-100 h-64">
            <MglMap :accessToken="accessToken" :map-style="mapStyle" />
        </div>
    </div>
</template>

<script>
import LinkArrow from "./atoms/links/LinkArrow";
import { MglMap } from "vue-mapbox";

export default {
    components: {
        LinkArrow,
        MglMap
    },
    data () {
        return {
            accessToken: process.env.MIX_MAPBOX_TOKEN,
            mapStyle: 'mapbox://styles/mapbox/light-v10'
        };
    }
}
</script>
