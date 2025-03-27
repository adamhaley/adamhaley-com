<template>
  <div class="relative">
    <img 
      :src="images[currentIndex]" 
      class="w-full h-full object-cover"
      :alt="`Slide ${currentIndex + 1}`"
    />
    
    <!-- Navigation buttons -->
    <button 
      @click="prev" 
      class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/75"
    >
      <ChevronLeftIcon class="h-6 w-6" />
    </button>
    <button 
      @click="next" 
      class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/75"
    >
      <ChevronRightIcon class="h-6 w-6" />
    </button>

    <!-- Dots -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
      <button 
        v-for="(_, index) in images" 
        :key="index"
        @click="currentIndex = index"
        class="w-2 h-2 rounded-full"
        :class="index === currentIndex ? 'bg-white' : 'bg-white/50'"
      />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
  images: {
    type: Array,
    required: true
  }
})

const currentIndex = ref(0)

const next = () => {
  currentIndex.value = (currentIndex.value + 1) % props.images.length
}

const prev = () => {
  currentIndex.value = currentIndex.value === 0 
    ? props.images.length - 1 
    : currentIndex.value - 1
}
</script> 