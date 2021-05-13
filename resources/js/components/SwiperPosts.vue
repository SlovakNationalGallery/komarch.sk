<template>
    <div>
        <div class="flex justify-between">
            <button
                @click="onPrev"
                class="text-xl icon-arrow-l-long focus:outline-none hover:text-blue"
                :class="{ 'hidden': isBeginning }"
            />
            <button
                @click="onNext"
                class="text-xl icon-arrow-r-long focus:outline-none hover:text-blue ml-auto"
                :class="{ 'hidden': isEnd }"
            />
        </div>
        <Swiper :options="swiperOptions" :ref="swiperRef">
            <SwiperSlide v-for="(post, index) in posts" :key="index">
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
        data () {
            return {
                posts: [],
                isBeginning: false,
                isEnd: false,
                swiperOptions: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    breakpoints: {
                        // when window width is >= 640px
                        640: {
                            slidesPerView: 1.5,
                            spaceBetween: 30,
                        },
                        // when window width is >= 1024px
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        }
                    }
                }
            }
        },
        computed: {
          swiperRef () {
              return 'swiperPosts'
          }
        },
        async created () {
            const response = await axios.get(`/api/related-posts?locale=${document.documentElement.lang}`)
            this.posts = response.data.data
            await this.$nextTick()
            this.updateControls()
        },
        mounted () {
            this.swiper = this.$refs[this.swiperRef].$swiper
            this.swiper.on('slideChange', this.updateControls)
        },
        methods: {
            updateControls () {
                const { isBeginning, isEnd } = this.swiper
                this.isBeginning = isBeginning
                this.isEnd = isEnd
            },
            onPrev() {
                this.swiper.slidePrev()
            },
            onNext() {
                this.swiper.slideNext()
            }
        }
    }
</script>

<style>
@import "../../../node_modules/swiper/css/swiper.css";
</style>
