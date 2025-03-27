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
          class="w-full h-full object-cover"
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
      <div v-if="project.video" class="aspect-video">
        <video 
          controls 
          class="w-full h-full"
        >
          <source :src="project.video" type="video/mp4">
          Your browser does not support the video tag.
        </video>
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
</script> 