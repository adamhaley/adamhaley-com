<template>
  <div class="flex flex-col md:flex-row items-center gap-8" 
       :class="{ 'md:flex-row-reverse': reverse }">
    <!-- Media Section (Image) -->
    <div class="w-full md:w-1/2">
      <div 
        class="relative aspect-video rounded-lg overflow-hidden shadow-xl cursor-pointer transform transition hover:scale-[1.02]"
        @click="openModal"
      >
        <img 
          :src="project.image" 
          :alt="project.title"
          class="w-full h-full object-contain"
        />
      </div>
    </div>

    <!-- Content Section -->
    <div class="w-full md:w-1/2 space-y-6">
      <h2 class="text-3xl font-bold text-gray-900">{{ project.title }}</h2>
      <div class="text-lg text-gray-600">Client: {{ project.client }}</div>
      <p class="text-lg text-gray-600">{{ project.description }}</p>
      
      <!-- Technologies -->
      <div class="flex flex-wrap gap-2">
        <span 
          v-for="tech in project.technologies" 
          :key="tech"
          class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
        >
          {{ tech }}
        </span>
      </div>
    </div>

    <!-- Modal -->
    <Modal :is-open="isModalOpen" @close="closeModal">
      <div class="aspect-video">
        <template v-if="isYoutubeVideo(project.video)">
          <iframe
            class="w-full h-full"
            :src="getYoutubeEmbedUrl(project.video)"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
          ></iframe>
        </template>
        <template v-else-if="project.video">
          <video 
            controls 
            autoplay
            class="w-full h-full"
          >
            <source :src="project.video" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </template>
      </div>
      <div v-else-if="project.carousel" class="aspect-video">
        <!-- Add carousel component here if needed -->
        <ImageCarousel :images="project.carousel" />
      </div>
    </Modal>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'

const props = defineProps({
  project: {
    type: Object,
    required: true
  },
  reverse: {
    type: Boolean,
    default: false
  }
})

const isModalOpen = ref(false)

const openModal = () => {
  isModalOpen.value = true
}

const closeModal = () => {
  isModalOpen.value = false
}

const isYoutubeVideo = (url) => {
  if (!url) return false
  return url.includes('youtube.com') || url.includes('youtu.be')
}

const getYoutubeEmbedUrl = (url) => {
  try {
    let videoId = ''
    
    if (url.includes('youtube.com/watch')) {
      const urlParams = new URLSearchParams(new URL(url).search)
      videoId = urlParams.get('v')
    } else if (url.includes('youtu.be')) {
      videoId = url.split('/').pop()
    }
    
    if (!videoId) return null
    
    return `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`
  } catch (error) {
    console.error('Error parsing YouTube URL:', error)
    return null
  }
}
</script> 