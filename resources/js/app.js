import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
document.addEventListener('DOMContentLoaded', () => {
  const swiper = new Swiper('.swiper-hero', {
    loop: true,
    autoplay: {
      delay: 5000,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
});