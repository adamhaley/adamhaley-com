<template>
  <div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <!-- Project Image -->
    <div class="relative aspect-video">
      <img 
        v-if="project.image"
        :src="project.image" 
        :alt="project.title"
        class="w-full h-full object-cover"
      />
      <video 
        v-if="project.video"
        class="w-full h-full object-cover"
        controls
      >
        <source :src="project.video" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>

    <!-- Project Info -->
    <div class="p-6">
      <h3 class="text-xl font-semibold text-gray-900">{{ project.title }}</h3>
      <p class="mt-2 text-gray-600">{{ project.description }}</p>
      
      <!-- Technologies -->
      <div class="mt-4 flex flex-wrap gap-2">
        <span 
          v-for="tech in project.technologies" 
          :key="tech"
          class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
        >
          {{ tech }}
        </span>
      </div>

      <!-- Links -->
      <div class="mt-6 flex space-x-4">
        <a
          v-if="project.github"
          :href="project.github"
          target="_blank"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800"
        >
          GitHub
        </a>
        <a
          v-if="project.live_demo"
          :href="project.live_demo"
          target="_blank"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
        >
          Live Demo
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  project: {
    type: Object,
    required: true
  }
})
</script> 