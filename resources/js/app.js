import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

console.log('Hello World from app.js!');

$('.navlink').onmouseenter(function(){
    $('.heading').html('Hello World');
});

$('.navlink').onmouseleave(function(){
    $('.heading').html('Goodbye World');
});
