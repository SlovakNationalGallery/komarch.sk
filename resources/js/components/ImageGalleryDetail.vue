<template>
  <div>
    <img
      :src="image.url"
      :srcset="image.srcset"
      :alt="image.alt"
      class="h-80 mx-auto cursor-zoom-in"
      @click="isDetailOpen = true"
    >
    <transition
      name="image-fade"
      mode="in-out"
    >
      <div
        v-if="isDetailOpen"
        class="fixed inset-0 z-10 flex items-center justify-center p-6"
      >
        <div
          class="bg-black opacity-70 absolute inset-0 cursor-zoom-out"
          @click="isDetailOpen = false"
        />
        <div class="max-w-screen-lg max-h-full w-full relative">
          <img
            :alt="image.alt"
            :srcset="image.srcset"
            :src="image.url"
            sizes="1px"
            :width="image.width"
            :height="image.height"
            onload="window.requestAnimationFrame(function(){if(!(size=getBoundingClientRect().width))return;onload=null;sizes=Math.ceil(size/window.innerWidth*100)+'vw';});"
          >
          <button
            class="w-14 h-14 absolute top-0 right-0 focus:outline-none flex items-center justify-center"
            @click="isDetailOpen = false"
          >
            <span class="icon-close text-2xl text-white" />
          </button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    image: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      isDetailOpen: false
    }
  }
}
</script>

<style>
.image-fade-enter-active,
.image-fade-leave-active {
  transition: opacity 300ms;
}

.image-fade-enter,
.image-fade-leave {
  opacity: 0
}
</style>
