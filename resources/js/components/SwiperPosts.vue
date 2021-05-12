<template>
    <div>
        <div class="flex justify-between">
            <button
                @click="onPrev"
                class="text-xl icon-arrow-l-long focus:outline-none"
                :class="{ 'hidden': isBeginning }"
            />
            <button
                @click="onNext"
                class="text-xl icon-arrow-r-long focus:outline-none ml-auto"
                :class="{ 'hidden': isEnd }"
            />
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
      components: {
          Swiper,
          SwiperSlide,
          TeaserPostBig
      },
      props: {
          posts: {
              type: Array,
              default: []
          },
      },
      data () {
          return {
              isBeginning: false,
              isEnd: false,
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
      mounted () {
          this.$refs[this.swiperRef].$swiper.on('slideChange', this.updateBounds)
      },
      methods: {
          updateBounds () {
              const { isBeginning, isEnd } = this.$refs[this.swiperRef].$swiper
              this.isBeginning = isBeginning
              this.isEnd = isEnd
          },
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
