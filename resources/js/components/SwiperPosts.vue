<template>
    <Swiper :options="swiperOptions">
        <SwiperSlide v-for="post in posts">
            <TeaserPostBig :post="post" />
        </SwiperSlide>
    </Swiper>
</template>

<script>
    import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
    import TeaserPostBig from "./TeaserPostBig";

  export default {
      components: { Swiper, SwiperSlide, TeaserPostBig },
      props: {
          posts: {
              type: Array,
              default: []
          },
      },
      data () {
          return {
              swiperOptions: {
                  slidesPerView: 3,
                  spaceBetween: 30
              }
          }
      }
  }
</script>

<style>
@import "../../../node_modules/swiper/swiper-bundle.css";
</style>
