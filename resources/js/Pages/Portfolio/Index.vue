<template>
  <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-12">ADAM HALEY - Case Studies</h1>
    
    <div class="space-y-24">
      <ProjectSection 
        v-for="(project, index) in projects" 
        :key="project.id" 
        :project="project"
        :reverse="index % 2 !== 0"
      />
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import ProjectSection from '@/Components/Portfolio/ProjectSection.vue'

const props = defineProps({
  projects: {
    type: Array,
    required: true
  }
})
</script> 