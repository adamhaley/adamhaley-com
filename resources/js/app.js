import './bootstrap';

/**/import Flickity from 'flickity';
import Alpine from 'alpinejs';
import { carousel, carouselFilter } from './carousel.js';

Alpine.start();



window.Alpine = Alpine;
window.carousel = carousel;
window.carouselFilter = carouselFilter;


console.log('Hello World from app.js!');
