import './bootstrap';

import Flickity from 'flickity';
import Alpine from 'alpinejs';
import { carousel, carouselFilter } from './carousel.js';



window.Alpine = Alpine;
window.Flickity = Flickity;
window.carousel = carousel;
window.carouselFilter = carouselFilter;

Alpine.start();

console.log('Hello World from app.js!');
