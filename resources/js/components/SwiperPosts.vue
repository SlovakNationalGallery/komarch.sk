<template>
    <div>
        <div class="flex justify-between">
            <button @click="onPrev" class="text-xl icon-arrow-l-long focus:outline-none"></button>
            <button @click="onNext" class="text-xl icon-arrow-r-long focus:outline-none"></button>
        </div>
        <Swiper :options="swiperOptions" :ref="swiperRef">
            <SwiperSlide v-for="post in posts">
                <TeaserPostBig :post="post" />
            </SwiperSlide>
        </Swiper>
    </div>
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
                  spaceBetween: 30,
              }
          }
      },
      computed: {
        swiperRef () {
            return 'swiperPosts'
        }
      },
      methods: {
          onPrev() {
              this.$refs[this.swiperRef].$swiper.slidePrev()
          },
          onNext() {
              this.$refs[this.swiperRef].$swiper.slideNext()
          }
      }
  }
</script>

<style>
@import "../../../node_modules/swiper/swiper-bundle.css";
</style>
