<template>
    <div class="relative w-100 map-artworks mt-5">
        <MglMap
            :accessToken="accessToken"
            :map-style="mapStyle"
            :center="center"
            :zoom="zoom"
            :attribution-control="false"
        >
            <MglNavigationControl position="top-left" :show-compass="false" />
            <MglAttributionControl position="bottom-right" />
        </MglMap>
    </div>
</template>

<script>
import LinkArrow from "./atoms/links/LinkArrow";
import { MglMap, MglNavigationControl, MglAttributionControl } from "vue-mapbox";

export default {
    components: {
        LinkArrow,
        MglMap,
        MglNavigationControl,
        MglAttributionControl
    },
    props: {
        center: {
          type: Array,
          default: () => [19.696058, 48.6737532],
        },
        zoom: {
            type: Number,
            default: 6
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

<style>
    @import "../../css/mapbox.css";
</style>
