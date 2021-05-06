<template>
    <div class="relative w-100 map-artworks mt-4">
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

export const SVK_CENTER_LONGITUDE = 19.696058
export const SVK_CENTER_LATITUDE = 48.6737532

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
          default: () => [SVK_CENTER_LONGITUDE, SVK_CENTER_LATITUDE],
        },
        zoom: {
            type: Number,
            default: 6
        },
        // https://docs.mapbox.com/api/maps/styles/
        mapStyle: {
            type: String,
            default: 'mapbox://styles/mapbox/streets-v11'
        }
    },
    computed: {
        accessToken () {
            return process.env.MIX_MAPBOX_TOKEN
        }
    }
}
</script>

<style>
@import "../../css/mapbox.css";

.mapboxgl-ctrl-zoom-out {
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E %3Cpath style='fill:%23333333;' d='m 7,9 c -0.554,0 -1,0.446 -1,1 0,0.554 0.446,1 1,1 l 6,0 c 0.554,0 1,-0.446 1,-1 0,-0.554 -0.446,-1 -1,-1 z'/%3E %3C/svg%3E");
}

.mapboxgl-ctrl-zoom-in {
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E %3Cpath style='fill:%23333333;' d='M 10 6 C 9.446 6 9 6.4459904 9 7 L 9 9 L 7 9 C 6.446 9 6 9.446 6 10 C 6 10.554 6.446 11 7 11 L 9 11 L 9 13 C 9 13.55401 9.446 14 10 14 C 10.554 14 11 13.55401 11 13 L 11 11 L 13 11 C 13.554 11 14 10.554 14 10 C 14 9.446 13.554 9 13 9 L 11 9 L 11 7 C 11 6.4459904 10.554 6 10 6 z'/%3E %3C/svg%3E");
}
</style>
