<template>
    <div class="mt-10">
        <div class="flex">
            <button>+</button>
            <button>-</button>
            <LinkArrow url="#">
                Zobraz celú mapu
            </LinkArrow>
        </div>
        <div class="relative w-100 map-artworks mt-5">
            <MglMap
                :accessToken="accessToken"
                :map-style="mapStyle"
                :center="center"
                :zoom="zoom"
            />
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
    props: {
        center: {
          type: Array,
          default: [19.696058, 48.6737532],
        },
        zoom: {
            type: Number,
            default: 7
        }
    },
    data () {
        return {
            accessToken: process.env.MIX_MAPBOX_TOKEN,
            mapStyle: 'mapbox://styles/mapbox/light-v10',
        };
    }
}
</script>
