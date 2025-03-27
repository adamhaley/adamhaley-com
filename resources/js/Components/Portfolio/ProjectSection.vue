<template>
  <div class="flex flex-col md:flex-row items-center gap-8" 
       :class="{ 'md:flex-row-reverse': reverse }">
    <!-- Media Section (Image/Video) -->
    <div class="w-full md:w-1/2">
      <div class="relative aspect-video rounded-lg overflow-hidden shadow-xl">
        <video 
          v-if="project.video"
          class="w-full h-full object-cover"
          controls
        >
          <source :src="project.video" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <img 
          v-else-if="project.image"
          :src="project.image" 
          :alt="project.title"
          class="w-full h-full object-cover"
        />
      </div>
    </div>

    <!-- Content Section -->
    <div class="w-full md:w-1/2 space-y-6">
      <h2 class="text-3xl font-bold text-gray-900">{{ project.title }}</h2>
      
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

      <!-- Links -->
      <div class="flex gap-4 pt-4">
        <a
          v-if="project.live_demo"
          :href="project.live_demo"
          target="_blank"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors"
        >
          <ExternalLinkIcon class="h-5 w-5 mr-2" />
          Live Demo
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import ExternalLinkIcon from '@/Components/Icons/ExternalLinkIcon.vue'

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
</script> 