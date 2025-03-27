<template>
  <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-start mb-12">
      <div>
        <h1 class="text-4xl font-bold text-gray-900 mb-6">ADAM HALEY: Case Studies</h1>
        <p class="text-lg text-gray-600 max-w-3xl">
          Full stack web developer with over 15 years of experience building interactive web applications. 
          Specializing in JavaScript, PHP, and modern frameworks like Vue and Laravel. 
          Passionate about creating elegant solutions to complex problems.
          Let's talk about how I can help bring your ideas to life.
        </p>
      </div>
      
      <!-- Contact Card -->
      <div class="ml-8 bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
        <img 
          :src="asset('storage/ah.jpg')" 
          alt="Adam Haley"
          class="w-32 h-32 rounded-lg object-cover shadow-md mb-4"
        />
        <div class="text-center">
          <div class="flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
              <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
            </svg>
            <a href="mailto:adam@adamhaley.com" class="text-gray-700 hover:text-gray-900">
              adam@adamhaley.com
            </a>
          </div>
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
            </svg>
            <a href="tel:+13233843493" class="text-gray-700 hover:text-gray-900">
              (323) 384-3493
            </a>
          </div>
        </div>
      </div>
    </div>
    
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

// Helper function to use Laravel's asset() in Vue
const asset = (path) => {
  return window.location.origin + '/' + path
}
</script> 